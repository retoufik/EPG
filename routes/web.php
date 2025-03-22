<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
Route::get('/home', function () {
        return view('layout.app');
    })->name('home');

Route::resource('stagiaire', StagiaireController::class);
});
Route::resource('stagiaire', StagiaireController::class);
Route::post('/stagiaire/{stagiaire}/documents', [StagiaireController::class, 'storeDocument'])
    ->name('stagiaire.documents.store');
Route::get('/stagiaire/{id}', [StagiaireController::class, 'generatePdf'])
    ->name('stagiaire.pdf');
Route::resource('documents', DocumentController::class)->only(['destroy']);
Route::get('/stagiaire/{stagiaire}/print', [StagiaireController::class, 'print'])->name('stagiaire.print');
