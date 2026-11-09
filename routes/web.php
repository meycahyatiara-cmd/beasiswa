<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ApplicantController; // TAMBAHAN BARU UNTUK CV
use App\Http\Controllers\Admin\ScholarshipController as AdminScholarshipController;
use App\Http\Controllers\Admin\UniversityController as AdminUniversityController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

// ==========================================
// HALAMAN PUBLIK
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Universities
Route::get('/universities', [UniversityController::class, 'index'])->name('universities.index');
Route::get('/universities/{id}', [UniversityController::class, 'show'])->name('university.show');

// Scholarships
Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{id}', [ScholarshipController::class, 'show'])->name('scholarship.show');

// Subscribe
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

// ==========================================
// FITUR BUAT CV & SURAT PERMOHONAN (TAMBAHAN BARU)
// ==========================================
Route::get('/buat-cv', [ApplicantController::class, 'create'])->name('cv.create');
Route::post('/buat-cv', [ApplicantController::class, 'store'])->name('cv.store');
Route::get('/preview-cv/{id}', [ApplicantController::class, 'preview'])->name('cv.preview');

// ==========================================
// RUTE ADMIN
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Rute Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); 
    
    // Rute Resource
    Route::resource('scholarships', AdminScholarshipController::class);
    Route::resource('universities', AdminUniversityController::class); 
});