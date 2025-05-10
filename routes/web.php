<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController; // Ajoutez cette ligne

// Route pour la page d'accueil
Route::get('/', function () {
    return view('acceuil');
})->name('acceuil');

// Route pour la page Explorer
Route::get('/explorer', function () {
    return view('explorer');
})->name('explorer');

// Route pour la page Chambres

Route::get('/chambres', [App\Http\Controllers\RoomController::class, 'index'])->name('chambres');

// Route pour la page À propos
Route::get('/about', function () {
    return view('about');
})->name('about');

// Route pour la page Contacts
Route::get('/contact', function () {
    return view('contacts');
})->name('contact');

// Ajouter ces routes à votre fichier routes/web.php

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservations.index');
Route::post('/reservation/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservation/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');

