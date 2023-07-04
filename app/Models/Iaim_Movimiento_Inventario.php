<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iaim_Movimiento_Inventario extends Model
{
    
    use HasFactory;

    protected $table = 'iaim_movimiento_inventarios';

    protected $fillable = [
        'articulo_id',
        'codigo',
        'codigo_ot',
        'descripcion',
        'categoria',
        'entrada',
        'salida',
        'fecha_entrada',
        'fecha_salida',
        'tipo_mov',
        'usuario_responsable',

    ];

}
