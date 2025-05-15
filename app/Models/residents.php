<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class residents extends Model
{
    use HasFactory;
    protected $fillable = [
        'surname',
        'first_name',
        'middle_name',
        'date_of_birth',
        'age',
        'gender',
        'place_of_birth',
        'relationship_with_family_head',
        'civil_status',
        'occupation',
        'religion',
        'citizenship',
        'family_number',
        'zone_or_purok',
        'phone_number',
        'status',
        'is_desease'
    ];
}
