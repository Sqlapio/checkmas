<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    use HasFactory;

    protected $table = 'ficha_tecnicas';

    protected $fillable = [
        'uid',
        'qrConden',
        'tipoConden',
        'voltaje',
        'phases',
        'tipoRefri',
        'btu',
        'costo',
        'tipoCompresor',
        'marcaCompresor',
        'ampCompresor',
        'imgPlacaCompresor',
        'tipoVentilador',
        'imgEtiqVentilador',
        'compreCorriente',
        'qrEvaporador',
        'imgEvaporador',
        'oficina',
        'piso',
        'agencia',
        'estado',

    ];
}
