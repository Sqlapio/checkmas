<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaimMaterialOrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'iaim_material_orden_trabajos';

    protected $fillable = [
        'codigo_ot',
        'codigo_producto',
        'descripcion',
        'categoria',
        'cantidad',
        'existencia_total',
        'usuario_responsable',

    ];
}
