<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::latest()->paginate(10);
        return view('admin.universities.index', compact('universities'));
    }

    public function create()
    {
        return view('admin.universities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:20',
            'logo' => 'nullable|string', // Asumsi pakai URL atau nama file
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        University::create($request->all());

        return redirect()->route('admin.universities.index')->with('success', 'Data Kampus berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $university = University::findOrFail($id);
        return view('admin.universities.edit', compact('university'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:20',
            'logo' => 'nullable|string',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $university = University::findOrFail($id);
        $university->update($request->all());

        return redirect()->route('admin.universities.index')->with('success', 'Data Kampus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        University::findOrFail($id)->delete();
        return redirect()->route('admin.universities.index')->with('success', 'Data Kampus berhasil dihapus!');
    }
}