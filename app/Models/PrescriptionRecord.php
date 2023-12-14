<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionRecord extends Model
{
    use HasFactory;

    protected $table = 'prescription_records';
    protected $fillable = ['appointment_id', 'patient_id', 'service_id', 'result'];
}
