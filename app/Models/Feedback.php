<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = ['user_id', 'comments', 'star_rating', 'status'];
}
    // Define relationship with User model

