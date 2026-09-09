<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function show($id)
    {
        $university = University::with(['scholarships' => function($query) {
            $query->where('is_active', true)
                ->where('deadline', '>=', now());
        }])->findOrFail($id);

        return view('university-detail', compact('university'));
    }
}