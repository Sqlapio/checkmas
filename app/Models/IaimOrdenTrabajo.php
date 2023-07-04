<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaimOrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'iaim_orden_trabajos';

    protected $fillable = [
        'codigo_ot',
        'aeropuerto',
        'area',
        'fecha_ot',
        'reportado_por',
        'divicion',
        'coordinacion',
        'descripcion_general',
        'usr_res_nombre',
        'usr_res_cedula',
        'usr_res_cargo',
        'usr_res_firma',
        'usr_res_correo',
        'valor_urgencia',
        'valor_obra',
        'otras_diviciones',
        'otra_divicion',
        'recomendaciones',
        'status',
        'aprobada_por',
        'fecha_aprobacion',

    ];
}
