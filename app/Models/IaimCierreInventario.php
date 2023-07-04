<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaimCierreInventario extends Model
{
    use HasFactory;

    protected $table = 'iaim_cierre_inventarios';

    protected $fillable = [
        'codigo',
        'descripcion',
        'total_mov_ent',
        'total_mov_sal',
        'Total_existencia',
        'fecha_cierre',

    ];
}
