<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = "movies";
    public $timestamps = false;
    protected $fillable = ['title', 'director', 'genre', 'description', 'year_release', 'image', 'trailer_link'];
}
