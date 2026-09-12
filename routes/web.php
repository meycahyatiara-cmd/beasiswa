<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');

// Universities
Route::get('/universities', [UniversityController::class, 'index'])->name('universities.index');
Route::get('/universities/{id}', [UniversityController::class, 'show'])->name('university.show');

// Scholarships
Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{id}', [ScholarshipController::class, 'show'])->name('scholarship.show');

// Subscribe
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');