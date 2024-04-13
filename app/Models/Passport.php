<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    protected $table = 'documents_information';

    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = false;

}
