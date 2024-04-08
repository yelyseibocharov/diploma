<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Professor extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticableTrait;

    protected $guarded = [];

    protected $hidden = [
        'password'
    ];

    public function university()
    {
        $this->hasOne(University::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function documents()
    {
        return $this->hasMany(Passport::class);
    }
}
