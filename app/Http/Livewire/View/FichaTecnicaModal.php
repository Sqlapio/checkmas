<?php

namespace App\Http\Livewire\View;

use App\Models\Agencia;
use App\Models\Estado;
use App\Models\FichaTecnica;
use Livewire\Component;

class FichaTecnicaModal extends Component
{
    public $atr_showModal = 'hidden';
    public $agencia;
    public $estado;
    public $oficina;
    public $piso;
    public $btu;
    public $tipoSistema;
    public $qrConden;
    public $qrEvaporador;

    protected $listeners = [
        'showFichaModal'
    ];

    public function closeModal(){
        $this->atr_showModal = 'hidden';
    }

    public function showFichaModal($equipoUid){

        $this->atr_showModal = '';

        $data = FichaTecnica::where('uid', $equipoUid)->get();

        foreach($data as $item)
        {
            $agencia    = $item->agencia;
            $estado     = $item->estado;
            $oficina    = $item->oficina;
            $piso       = $item->piso;
            $btu        = $item->btu;
            $tipoSistema    = $item->tipoConden;
            $qrConden       = $item->qrConden;
            $qrEvaporador   = $item->qrEvaporador;

        }

        $this->agencia = $agencia;
        $this->estado = $estado;
        $this->oficina = $oficina;
        $this->piso = $piso;
        $this->btu = $btu;
        $this->tipoSistema = $tipoSistema;
        $this->qrConden = $qrConden;
        $this->qrEvaporador = $qrEvaporador;


    }

    public function render()
    {
        return view('livewire.view.ficha-tecnica-modal');
    }
}
