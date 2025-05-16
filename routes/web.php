<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationPdfController;
use Illuminate\Http\Request;

// Routes publiques - Accessibles à tous
Route::get('/', function () {
    return view('acceuil');
})->name('acceuil');

Route::get('/explorer', function () {
    return view('explorer');
})->name('explorer');

Route::get('/chambres', [RoomController::class, 'index'])->name('chambres');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contacts');
})->name('contact');

// Routes de réservation - Protection contre le spam et les abus
Route::middleware(['web', 'throttle:60,1'])->group(function () {
    Route::get('/reservation', [ReservationController::class, 'index'])
        ->name('reservations.index');
    
    Route::post('/reservation/create', [ReservationController::class, 'create'])
        ->name('reservations.create')
        ->middleware([\App\Http\Middleware\ValidateReservation::class]);
    
    Route::post('/reservation', [ReservationController::class, 'store'])
        ->name('reservations.store')
        ->middleware([\App\Http\Middleware\ValidateReservation::class]);
});

// Routes protégées pour les confirmations - Nécessite validation du propriétaire
Route::middleware(['web', \App\Http\Middleware\ValidateReservationOwner::class])->group(function () {
    Route::get('/reservation/confirmation/{reservation:uuid}', [ReservationController::class, 'confirmation'])
        ->name('reservations.confirmation');
});

// Route pour télécharger le PDF - Protection par signature URL et propriétaire
Route::get('reservations/{reservation:uuid}/pdf', [ReservationPdfController::class, 'download'])
    ->name('reservations.pdf.download')
    ->middleware(['signed', \App\Http\Middleware\ValidateReservationOwner::class]);

Route::post('/contact-submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

