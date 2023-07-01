<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaimCertificacionOrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'iaim_certificacion_orden_trabajos';

    protected $fillable = [
        'ot_id',
        'codigo_ot',
        'fecha_inicio_ot',
        'fecha_fin_ot',
        'fecha_cer_ot',
        'usr_cer_nombre',
        'usr_cer_cedula',
        'usr_cer_cargo',
        'usr_cer_firma',
        'usr_cer_correo',
        'usr_cer_division',
        'usr_cer_coordinacion',
        'can_dias',
        'can_trabajadores',
        'foto_antes_1',
        'foto_antes_2',
        'foto_antes_3',
        'foto_durante_1',
        'foto_durante_2',
        'foto_durante_3',
        'foto_des_1',
        'foto_des_2',
        'foto_des_3',
        'observaciones',

    ];

}
