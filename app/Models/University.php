<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [];

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function institute()
    {
        return $this->hasMany(Institute::class);
    }
}
