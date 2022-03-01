<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
        'city_id',
        'long',
        'lat',
        'weather',
        'temprature',
        'feels_like',
        'humidity',
        'wind_speed',
    ];
}
