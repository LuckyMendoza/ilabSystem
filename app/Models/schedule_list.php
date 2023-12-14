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

    public function patient()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function prescription()
    {
        return $this->hasOne(PrescriptionRecord::class, 'appointment_id', 'id');
    }

    public function services()
    {
        return $this->hasOne(service_offers::class, 'id', 'service');
    }
}

