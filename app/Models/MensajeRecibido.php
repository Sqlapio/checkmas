<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeRecibido extends Model
{
    use HasFactory;

    protected $table = 'mensaje_recibidos';

    protected $fillable = [
        'receptor',
        'emisor',
        'fecha_recibido',
        'fecha_respuesta',
        'asunto',
        'mensaje',
        'estatus'
    ];
}
