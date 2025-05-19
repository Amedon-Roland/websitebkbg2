<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:2000',
        ], [
            'fullname.required' => 'Votre nom est requis',
            'email.required' => 'Votre email est requis',
            'email.email' => 'Veuillez fournir un email valide',
            'message.required' => 'Votre message est requis',
        ]);

        try {
            // Envoi de l'email
            Mail::to(config('mail.admin_address', 'contact@hotelbkbg.cm'))
                ->send(new ContactFormMail($validated));
            
            // Journal pour débogage
            Log::info('Contact form submitted', [
                'name' => $validated['fullname'],
                'email' => $validated['email']
            ]);
            
            // Redirection avec message de succès
            return back()->with('contact_success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
        } catch (\Exception $e) {
            // Journal d'erreur
            Log::error('Contact form error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Redirection avec message d'erreur
            return back()->withInput()->with('error', "Une erreur est survenue lors de l'envoi du message. Veuillez réessayer ultérieurement.");
        }
    }
}
