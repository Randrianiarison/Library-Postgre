<?php

use App\Http\Controllers\AuteurController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/etudiants', [UtilisateurController::class, 'index'])->name('etudiants.index');
Route::post('/utilisateurs', [UtilisateurController::class, 'store'])->name('utilisateurs.store');
Route::put('/utilisateurs/{user}', [UtilisateurController::class, 'update'])->name('utilisateurs.update');
Route::delete('/utilisateurs/{utilisateur}', [UtilisateurController::class, 'destroy'])->name('utilisateurs.destroy');


Route::get('/auteurs', [AuteurController::class, 'index'])->name('auteurs.index');
Route::post('/auteurs', [AuteurController::class, 'store'])->name('auteurs.store');



Route::get('/livres', [LivreController::class, 'index'])->name('livre.index');
Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
Route::delete('/livres/{id}', [LivreController::class, 'destroy'])->name('livres.destroy');
Route::put('/livres/{id}', [LivreController::class, 'update'])->name('livres.update');
Route::get('/livres/search', [LivreController::class, 'search'])->name('livres.search');


Route::get('/generate-pdf', [pdfController::class, 'generatePdf']);

