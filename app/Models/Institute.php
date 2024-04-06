<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [];

    public function university()
    {
        return $this->hasOne(University::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
