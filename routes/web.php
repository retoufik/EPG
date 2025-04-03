<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import/process', [ImportController::class, 'process'])->name('import.process');
    Route::get('/export/{type}', [ImportController::class, 'export'])->name('import.export');

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
