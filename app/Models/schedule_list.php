<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule_list extends Model{
    use HasFactory;

    protected $table = 'schedule_lists';
    protected $fillable = [
        'user_id',
        'schedule_date',
        'time_from',
        'time_to',
        'doctor',
        'service',
        'status'
    ];
}

