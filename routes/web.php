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
    
    Route::get('/stagiaire/{stagiaire}/attestation/download', [StagiaireController::class, 'generatePdf'])
        ->name('stagiaire.attestation.download');
    Route::get('/stagiaire/{stagiaire}/attestation/print', [StagiaireController::class, 'print'])
        ->name('stagiaire.attestation.print');
    Route::post('/stagiaire/{stagiaire}/documents', [StagiaireController::class, 'storeDocument'])
        ->name('stagiaire.documents.store');
    Route::resource('documents', DocumentController::class)->only(['destroy']);
    
    Route::get('/stagiaire/{stagiaire}/download-attestation', [StagiaireController::class, 'generatePdf'])
        ->name('stagiaire.attestation.download');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/attestation/download/{stagiaire}', [StagiaireController::class, 'generatePdf'])
        ->name('stagiaire.attestation.download');
});
