<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bp_monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_name',
        'age',
        'bp',
        'level',
        'date',
        'phone_number',
    ];
}
