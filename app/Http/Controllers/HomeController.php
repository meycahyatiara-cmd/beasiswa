<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Tampilkan 12 kampus di halaman utama
        $universities = University::withCount('scholarships')
            ->where('is_active', true)
            ->orderBy('rank')
            ->take(12)
            ->get();

        // Tampilkan 10 beasiswa terbaru di halaman utama
        $featuredScholarships = Scholarship::with('university')
            ->where('is_active', true)
            ->where('deadline', '>=', now())
            ->orderBy('deadline')
            ->take(10)
            ->get();

        return view('home', compact('universities', 'featuredScholarships'));
    }
}