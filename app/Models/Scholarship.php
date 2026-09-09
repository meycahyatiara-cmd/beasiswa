<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id', 'title', 'description', 'type', 
        'level', 'field_of_study', 'deadline', 'link', 
        'requirements', 'quota', 'is_active'
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function getTypeLabelAttribute()
    {
        return $this->type == 'full' ? 'Beasiswa Penuh' : 'Beasiswa Parsial';
    }

    public function getStatusLabelAttribute()
    {
        if (!$this->is_active) return 'Tidak Aktif';
        return $this->deadline->isPast() ? 'Kadaluarsa' : 'Aktif';
    }
}