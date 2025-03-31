<?php

use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('acceuil');
})->name('acceuil');

// Route pour la page Explorer
Route::get('/explorer', function () {
    return view('explorer');
})->name('explorer');

// Route pour la page Chambres
Route::get('/chambres', function () {
    return view('chambres');
})->name('chambres');

// Route pour la page À propos
Route::get('/about', function () {
    return view('about');
})->name('about');

// Route pour la page Contacts
Route::get('/contact', function () {
    return view('contacts');
})->name('contact');

