<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraccion extends Model
{
    use HasFactory;

    protected $table = "infraccion";

    protected $fillable = [
        'dni',
        'fecha',
        'placa',
        'infraccion',
        'descripcion'
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

}
