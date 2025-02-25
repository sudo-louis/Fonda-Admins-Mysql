<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;
    protected $table = 'sucursales';

    protected $fillable = [
        'foto',
        'nombre_sucursal',
        'direccion',
        'codigo_postal',
        'horario',
    ];
}
