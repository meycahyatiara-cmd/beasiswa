<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::with('university')
            ->where('is_active', true)
            ->where('deadline', '>=', now());

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has('level') && $request->level != '') {
            $query->where('level', $request->level);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('field_of_study', 'LIKE', "%{$search}%")
                  ->orWhereHas('university', function($u) use ($search) {
                      $u->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('acronym', 'LIKE', "%{$search}%");
                  });
            });
        }

        $scholarships = $query->orderBy('deadline')->paginate(12);
        
        if ($request->ajax()) {
            return response()->json($scholarships);
        }

        return view('scholarships', compact('scholarships'));
    }

    public function show($id)
    {
        $scholarship = Scholarship::with('university')->findOrFail($id);
        return view('scholarship-detail', compact('scholarship'));
    }
}