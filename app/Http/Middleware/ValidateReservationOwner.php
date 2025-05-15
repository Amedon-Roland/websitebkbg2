<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateReservationOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reservation = $request->route('reservation');
        
        // Si la réservation n'est pas trouvée
        if (!$reservation) {
            abort(404, 'Réservation non trouvée');
        }
        
        // Vérifier si l'email de session correspond à celui de la réservation
        // OU si c'est une route signée (pour les PDF)
        if (session('reservation_email') !== $reservation->email && !$request->hasValidSignature()) {
            // Stocker l'URL actuelle pour y revenir après vérification
            session(['intended_url' => $request->url()]);
            
            // Rediriger vers une page de vérification d'accès
            return redirect()->route('reservations.verify-access', ['uuid' => $reservation->uuid])
                ->with('warning', 'Veuillez confirmer votre adresse email pour accéder à cette réservation');
        }

        return $next($request);
    }
}
