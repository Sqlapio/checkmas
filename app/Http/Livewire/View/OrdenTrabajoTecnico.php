<?php

namespace App\Http\Livewire\View;

use Livewire\Component;

class OrdenTrabajoTecnico extends Component
{

    public $ot_id;
    public $otUid_id;
    public $fechaEjecucion;
    public $tipoMantenimiento;
    public $limConden;
    public $limEva;
    public $lecAmpComp;
    public $lecPreAlta;
    public $lecPreBaja;
    public $observacionesMp;
    public $listaMateriales;
    public $fotoMpAntes1;
    public $fotoMpAntes2;
    public $fotoMpDesp1;
    public $fotoMpDesp2;
    public $fotoMcAntes1;
    public $fotoMcAntes2;
    public $fotoMcDesp1;
    public $fotoMcDesp2;
    public $observacionesMc;

    



    public function render()
    {
        return view('livewire.view.orden-trabajo-tecnico');
    }
}
