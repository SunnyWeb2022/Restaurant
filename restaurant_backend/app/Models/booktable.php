<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booktable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'persons',
        'date'
    ];
}
