<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacoras';

    protected $fillable = [
        'nro_ot',
        'tipo_fotos',
        'foto1_antes',
        'foto2_antes',
        'foto1_despues',
        'foto2_despues',
        'tecnico',
        'observaciones'
    ];
}
