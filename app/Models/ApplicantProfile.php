<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfile extends Model
{
    use HasFactory;

    // INI DAFTAR PUTIH KOLOM YANG BOLEH DIISI
    protected $fillable = [
        'full_name',
        'nim',
        'university',
        'major',
        'semester',
        'gpa',
        'phone',
        'address',
        'skills',
        'experiences',
        'motivation',
    ];
}