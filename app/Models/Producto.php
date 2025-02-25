<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre_producto',
        'descripcion',
        'cantidad_en_stock',
        'precio',
        'foto',
    ];
}
