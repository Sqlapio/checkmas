<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeEnviado extends Model
{
    use HasFactory;

    protected $table = 'mensaje_enviados';

    protected $fillable = [
        'emisor',
        'receptor',
        'asunto',
        'mensaje',
        'fecha_envio',
        'fecha_leido',
        'fecha_respuesta',
        'estatus',
        'respuesta',
    ];

}
