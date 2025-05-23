<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bp_monitoring extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_number',
        'resident_name',
        'age',
        'date_of_birth',   // ✅ added
        'gender',          // ✅ added
        'bp',
        'level',
        'date',
        'phone_number',
        'status',
          'status',
        'is_desease'
    ];

}
