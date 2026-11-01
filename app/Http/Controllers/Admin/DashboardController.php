<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Scholarship;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUniversities = University::count();
        $totalScholarships = Scholarship::count();
        $totalUsers = User::count();
        $recentScholarships = Scholarship::with('university')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUniversities', 
            'totalScholarships', 
            'totalUsers', 
            'recentScholarships'
        ));
    }
}