<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $universities = University::withCount('scholarships')
            ->where('is_active', true)
            ->orderBy('rank')
            ->get();

        $featuredScholarships = Scholarship::with('university')
            ->where('is_active', true)
            ->where('deadline', '>=', now())
            ->orderBy('deadline')
            ->take(6)
            ->get();

        return view('home', compact('universities', 'featuredScholarships'));
    }
}