<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'name',
        'type',
        'description',
        'stocks',
        'expiration_date',
        'expiration_month'
    ];
}
