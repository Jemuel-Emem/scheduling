<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class o71months extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_of_child',
        'name_of_parent',
        'date_of_birth',
        'age_in_month',
        'weight',
        'height',
        'family_no',
        'zone',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
