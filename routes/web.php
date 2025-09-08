<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\RiadController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\AdminReservationController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

// Chambres Routes - Updated to use id_chambre parameter
Route::get('/chambres', [ChambreController::class, 'index'])->name('chambres.index');
Route::get('/chambres/{id_chambre}', [ChambreController::class, 'show'])->name('chambres.show');
Route::get('/chambres-disponibles', [ChambreController::class, 'disponibles'])->name('chambres.disponibles');

// Riads Routes
Route::get('/riads', [RiadController::class, 'index'])->name('riads.index');
Route::get('/riads/{id}', [RiadController::class, 'show'])->name('riads.show');

// Services Routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');

// Reservations Routes (Public - No Authentication Required)
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservation/create/{chambre_id?}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservation/{id}/confirmation', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');
Route::get('/reservation/{id}', [ReservationController::class, 'show'])->name('reservations.show');

// Admin Routes (Protected)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdministrateurController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdministrateurController::class, 'logout'])->name('admin.logout');
    
    // Admin Reservations
    Route::get('/admin/reservations', [AdministrateurController::class, 'reservations'])->name('admin.reservations');
    Route::put('/admin/reservations/{id}/status', [AdminReservationController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
    
    // Admin Clients
    Route::get('/admin/clients', [AdministrateurController::class, 'clients'])->name('admin.clients');
    
    // Admin Chambres - Updated to use id_chambre parameter
    Route::get('/admin/chambres', [AdministrateurController::class, 'chambres'])->name('admin.chambres');
    Route::get('/admin/chambres/create', [ChambreController::class, 'create'])->name('admin.chambres.create');
    Route::post('/admin/chambres', [ChambreController::class, 'store'])->name('admin.chambres.store');
    Route::get('/admin/chambres/{id_chambre}/edit', [ChambreController::class, 'edit'])->name('admin.chambres.edit');
    Route::put('/admin/chambres/{id_chambre}', [ChambreController::class, 'update'])->name('admin.chambres.update');
    Route::delete('/admin/chambres/{id_chambre}', [ChambreController::class, 'destroy'])->name('admin.chambres.destroy');
    
    // Admin Services
    Route::get('/admin/services', [ServiceController::class, 'adminIndex'])->name('admin.services');
    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/admin/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/admin/services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
    
    // Admin Riads
    Route::post('/admin/riads', [RiadController::class, 'store'])->name('admin.riads.store');
    Route::put('/admin/riads/{id}', [RiadController::class, 'update'])->name('admin.riads.update');
    Route::delete('/admin/riads/{id}', [RiadController::class, 'destroy'])->name('admin.riads.destroy');

    // Direct admin login route (if needed for direct access)
    Route::get('/admin/login', function() {
        return view('auth.admin-login');
    })->name('admin.login')->withoutMiddleware(['auth:admin']);
    
    Route::post('/admin/login', [AdministrateurController::class, 'login'])
        ->name('admin.login.post')->withoutMiddleware(['auth:admin']);
});