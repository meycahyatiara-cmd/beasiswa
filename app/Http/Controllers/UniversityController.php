<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    // Daftar semua kampus
    public function index(Request $request)
    {
        $query = University::withCount('scholarships')
            ->where('is_active', true);

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('acronym', 'LIKE', "%{$search}%");
            });
        }

        $universities = $query->orderBy('rank')->paginate(16);

        return view('universities', compact('universities'));
    }

    // Detail kampus
    public function show($id)
    {
        $university = University::with(['scholarships' => function($query) {
            $query->where('is_active', true)
                ->where('deadline', '>=', now());
        }])->findOrFail($id);

        return view('university-detail', compact('university'));
    }
}