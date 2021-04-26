<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    //use HasFactory;
    protected $fillable = [
        // para inserir no banco
        'id',
        'name',
        'latitude',
        'longitude',
        'gmt',
    ];
}
