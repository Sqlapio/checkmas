<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iaim_Articulo extends Model
{
    use HasFactory;

    protected $table = 'iaim_articulos';

    protected $fillable = [
        'descripcion',
        'codigo',
        'categoria',
        'proveedor',
        'precio_unitario',
        'cantidad_minima',
        'usuario_responsable',

    ];
    

}
