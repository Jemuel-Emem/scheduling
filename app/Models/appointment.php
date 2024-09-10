<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'phone', 'age', 'address', 'purpose', 'date_schedule', 'reschedule_option',
        'reschedule_date', 'time_schedule', 'health_condition', 'health_status', 'blood_pressure'
    ];
}
