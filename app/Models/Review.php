<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";
    public $timestamps = false;
    protected $fillable = ['user_id', 'user_name', 'movie_id', 'movie_name', 'review_headline', 'rating', 'review'];
}
