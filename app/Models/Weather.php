<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'country',
        'date',
        'day',
        'evening',
        'night',
        'morning',
        'description',
        'icon',
    ];

}
