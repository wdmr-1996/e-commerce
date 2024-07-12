<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Especifica el nombre de la tabla

    protected $fillable = [
        'sabor',
        'descripcion',
        'material',
        'capacidad',
        'unidades',
        'tipoBebida',
        'marca',
        'existencias',
        'precioCompra',
        'precioVenta',
        'imagen',
    ];
}
