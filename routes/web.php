<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('layout.home');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', function () {
    return view('emails.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('layout.home');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('layout.app');
    })->name('dashboard');

    Route::resource('stagiaire', StagiaireController::class);
    Route::get('/stagiaire/{stagiaire}/attestation/download', [StagiaireController::class, 'generatePdf'])
        ->name('stagiaire.attestation.download');
    Route::get('/stagiaire/{stagiaire}/attestation/print', [StagiaireController::class, 'print'])
        ->name('stagiaire.attestation.print');
    
    Route::post('/stagiaire/{stagiaire}/documents', [StagiaireController::class, 'storeDocument'])
        ->name('stagiaire.documents.store');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])
        ->name('documents.destroy');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/attestation/download/{stagiaire}', [StagiaireController::class, 'generatePdf'])
//         ->name('stagiaire.attestation.download');
// });
