<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    use HasFactory;

    protected $table = 'estadisticas';

    protected $fillable = [
        'total_ticket_abiertos',
        'total_ticket_cerrados',
        'total_ot_mc_creada',
        'total_ot_mc_aprobada',
        'total_ot_mc_ejecucion',
        'total_ot_mc_supervicion',
        'total_ot_mc_finalizada',
        'total_inversion_mc',
        'total_ot_mp_creada',
        'total_ot_mp_aprobada',
        'total_ot_mp_ejecucion',
        'total_ot_mp_supervicion',
        'total_ot_mp_finalizada',
        'total_inversion_mp',
        'estado',
        'color',
    ];
}
