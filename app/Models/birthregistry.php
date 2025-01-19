<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class birthregistry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_of_child',
        'name_of_parent',
        'date_of_birth',
        'family_no',
        'zone',
        'gender',
        'birth_weight',
        'place_of_birth',
        'is_registered',
    ];
}
