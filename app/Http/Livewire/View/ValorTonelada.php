<?php

namespace App\Http\Livewire\View;

use App\Models\Configuracion;
use Livewire\Component;
use Livewire\WithPagination;

class ValorTonelada extends Component
{

    use WithPagination;

    public $costo_climatizacion;
    public $costo_chiller;
    // public $valor.'-';

    public $atr_botton_actualizar = 'hidden';
    public $atr_botton_editar = '';
    public $input_climatizacion = 'hidden';
    public $input_chiller = 'hidden';

    public function editar($valor)
    {
        if($valor == 'climatizacion'){
            $this->input_climatizacion = '';
            $this->atr_botton_editar = 'hidden';
        }

        if($valor == 'chiller'){
            $this->input_chiller = '';
        $this->atr_botton_editar = 'hidden';
        }
        
    }

    public function actualizar($valor)
    {
        dd($valor);

        // DB::table('configuracions')
        //     ->where('id', $id)
        //     ->update(['statusOts' => 2]);
    }

    public function render()
    {
        return view('livewire.view.valor-tonelada', [
            'data' => Configuracion::orderBy('created_at', 'asc')
            ->paginate(5)
        ]);
    }
}
