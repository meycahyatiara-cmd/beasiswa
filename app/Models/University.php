<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'acronym', 'logo', 'color', 'website', 
        'description', 'rank', 'is_active'
    ];

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' (' . $this->acronym . ')';
    }
}