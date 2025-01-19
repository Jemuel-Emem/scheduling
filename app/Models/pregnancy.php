<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pregnancy extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'date_of_birth',
        'age',
        'family_no',
        'zone',
        'mobile_number',
        'estimated_due_date',
        'last_checkup',
        'child_name',
    ];

    protected $casts = [
        'estimated_due_date' => 'date', // This will cast the field to a Carbon instance
    ];
}
