<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantProfile;

class ApplicantController extends Controller
{
    public function create()
    {
        return view('applicant.cv-form');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'full_name' => 'required',
            'nim' => 'required',
            'university' => 'required',
            'major' => 'required',
            'semester' => 'required',
            'gpa' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'skills' => 'required',
            'experiences' => 'required',
            'motivation' => 'required',
        ]);

        // SIMPAN DATA: Gunakan except('_token') agar token keamanan tidak ikut tersimpan
        $profile = ApplicantProfile::create($request->except('_token'));

        // Alihkan ke halaman preview dengan membawa ID data yang baru dibuat
        return redirect()->route('cv.preview', $profile->id);
    }

    public function preview($id)
    {
        // Ambil data berdasarkan ID
        $profile = ApplicantProfile::findOrFail($id);
        
        // Tampilkan halaman preview
        return view('applicant.cv-preview', compact('profile'));
    }
}