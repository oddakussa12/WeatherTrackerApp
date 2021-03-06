<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'name_am'
    ];

    public function questions(){
        return $this->belongsToMany('App\Models\Question');
    }
    public function blogs(){
        return $this->belongsToMany('App\Models\Blog');
    }
}
