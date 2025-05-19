<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use PDF;

class ReservationPdfController extends Controller
{
    public function download(Reservation $reservation, Request $request)
    {
        // Valider le token pour la sécurité
        if (!$request->hasValidSignature()) {
            abort(401, 'Lien invalide ou expiré');
        }
        
        $pdf = PDF::loadView('pdfs.reservation', compact('reservation'));
        
        return $pdf->download('reservation-' . str_pad($reservation->id, 5, '0', STR_PAD_LEFT) . '.pdf');
    }
}