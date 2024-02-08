<?php

namespace App\Models;

// use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = ['user_id', 'comments', 'star_rating', 'status'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
    // Define relationship with User model


