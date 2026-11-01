<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\University;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::with('university')->latest()->paginate(10);
        return view('admin.scholarships.index', compact('scholarships'));
    }

    public function create()
    {
        $universities = University::all();
        return view('admin.scholarships.create', compact('universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:full,partial',
            'level' => 'required|string',
            'field_of_study' => 'required|string',
            'deadline' => 'required|date',
            'requirements' => 'required|string',
            'quota' => 'required|integer',
        ]);

        Scholarship::create($request->all());

        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $universities = University::all();
        return view('admin.scholarships.edit', compact('scholarship', 'universities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:full,partial',
            'level' => 'required|string',
            'field_of_study' => 'required|string',
            'deadline' => 'required|date',
            'requirements' => 'required|string',
            'quota' => 'required|integer',
        ]);

        $scholarship = Scholarship::findOrFail($id);
        $scholarship->update($request->all());

        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Scholarship::findOrFail($id)->delete();
        return redirect()->route('admin.scholarships.index')->with('success', 'Beasiswa berhasil dihapus!');
    }
}