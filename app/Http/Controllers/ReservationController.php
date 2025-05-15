<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\ReservationConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $roomCategories = RoomCategory::orderBy('price', 'desc')->get();
        
        // Récupérer la catégorie présélectionnée s'il y en a une
        $preselectedCategory = null;
        if ($request->has('preselected_category')) {
            $preselectedCategoryId = $request->input('preselected_category');
            $preselectedCategory = RoomCategory::find($preselectedCategoryId);
        }
        
        return view('reservations.index', compact('roomCategories', 'preselectedCategory'));
    }
    
    public function create(Request $request)
    {
        // Validation des données du formulaire index avec tous les champs
        $validated = $request->validate([
            'room_category_id' => 'required|exists:room_categories,id',
            'guests' => 'required|integer|min:1|max:5',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            // Champs personnels
            'title' => 'nullable|string',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            // Options
            'special_requests' => 'nullable|string',
            'breakfast' => 'nullable',
            'late_checkout' => 'nullable',
            'airport_transfer' => 'nullable',
            'terms_accepted' => 'nullable',
        ]);
        
        $roomCategory = RoomCategory::findOrFail($validated['room_category_id']);
        
        // Vérifier si des chambres existent dans cette catégorie
        if ($roomCategory->rooms()->count() === 0) {
            return back()->withInput()->with('error', 'Désolé, il n\'y a pas encore de chambres disponibles dans cette catégorie.');
        }
        
        // Rechercher les chambres disponibles
        $availableRooms = $roomCategory->getAvailableRoomsForDates($validated['check_in_date'], $validated['check_out_date']);
            
        if ($availableRooms->isEmpty()) {
            // Aucune chambre disponible, chercher la prochaine date disponible
            $nextAvailableDate = $roomCategory->getNextAvailableDate($validated['check_in_date'], $validated['check_out_date']);
            
            if ($nextAvailableDate) {
                return back()->withInput()->with('error', 'Désolé, aucune chambre n\'est disponible aux dates sélectionnées. La prochaine date disponible est le ' . $nextAvailableDate->format('d/m/Y') . '.');
            } else {
                return back()->withInput()->with('error', 'Désolé, toutes les chambres sont réservées pour les 60 prochains jours.');
            }
        }
            
        return view('reservations.create', compact('validated', 'roomCategory', 'availableRooms'));
    }

    public function store(Request $request)
    {
        try {
            // Validation complète
            $validated = $request->validate([
                'title' => 'required|string|max:10',
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'room_category_id' => 'required|exists:room_categories,id',
                'guests' => 'required|integer|min:1|max:5',
                'check_in_date' => 'required|date|after_or_equal:today',
                'check_out_date' => 'required|date|after:check_in_date',
                'terms_accepted' => 'required|accepted',
                // Champs optionnels
                'room_id' => 'nullable|exists:rooms,id',
                'address' => 'nullable|string|max:255',
                'special_requests' => 'nullable|string',
                'payment_method' => 'required|in:credit_card,bank_transfer,cash',
                'breakfast' => 'nullable|boolean',
                'pets' => 'nullable|boolean',
                'late_checkout' => 'nullable|boolean',
                'airport_transfer' => 'nullable|boolean',
            ]);
            
            $roomCategory = RoomCategory::findOrFail($validated['room_category_id']);
            
            // Trouver une chambre disponible si non spécifiée
            if (empty($validated['room_id'])) {
                $availableRooms = $roomCategory->getAvailableRoomsForDates(
                    $validated['check_in_date'],
                    $validated['check_out_date']
                );
                
                if ($availableRooms->isEmpty()) {
                    return back()->withInput()->with('error', 
                        'Désolé, aucune chambre n\'est disponible pour les dates sélectionnées.');
                }
                
                $room = $availableRooms->first();
                $validated['room_id'] = $room->id;
            } else {
                // Vérifier si la chambre spécifiée est bien disponible
                $room = Room::findOrFail($validated['room_id']);
                
                if (!$room->isAvailableForDates($validated['check_in_date'], $validated['check_out_date'])) {
                    return back()->withInput()->with('error', 
                        'Désolé, cette chambre n\'est plus disponible pour les dates sélectionnées.');
                }
            }
            
            // Création de la réservation
            $reservation = new Reservation();
            $reservation->fill($validated);
            $reservation->status = 'pending';
            
            // Ajouter les services supplémentaires
            $reservation->breakfast = isset($validated['breakfast']);
            $reservation->pets = isset($validated['pets']);
            $reservation->late_checkout = isset($validated['late_checkout']);
            $reservation->airport_transfer = isset($validated['airport_transfer']);
            $reservation->tax_amount = 1000; // Taxe fixe
            
            // Sauvegarder d'abord pour avoir l'ID
            $reservation->save();
            
            // Calculer et stocker le prix total
            $reservation->calculateTotalPrice();
            $reservation->save();
            
            // Stocker l'email de la réservation en session pour l'authentification future
            session(['reservation_email' => $reservation->email]);
            
            // Générer un lien signé pour le téléchargement du PDF
            $pdfUrl = URL::temporarySignedRoute(
                'reservations.pdf.download',
                now()->addDays(30), // Le lien expire dans 30 jours
                ['reservation' => $reservation->uuid]
            );
            
            // Envoyer l'email de confirmation
            Mail::to($reservation->email)
                ->send(new ReservationConfirmation($reservation, $pdfUrl));
            
            return redirect()->route('reservations.confirmation', ['reservation' => $reservation->uuid])
                ->with('success', 'Votre réservation a été effectuée avec succès! Un email de confirmation a été envoyé.');
                
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la réservation: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }
    
    public function confirmation(Reservation $reservation)
    {
        return view('reservations.confirmation', compact('reservation'));
    }
}