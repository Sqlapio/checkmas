<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Queue\Listener;
use Livewire\Component;

class RegistroIndex extends Component
{
    public $tipoEmpresa;

    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [
        'tipoEmpresa'    => 'required',
    ];

    protected $messages = [
        'tipoEmpresa.required'  => 'Debe seleccionar una empresa',

    ];

    public function updated($propertyName)
    {

        
        $this->validateOnly($propertyName);
    }

    public function verRegistro()
    {
        $this->validate();

        if($this->tipoEmpresa == 'BANCO DEL TESORO'){
            redirect()->to('/registro-banco');
        }
        if($this->tipoEmpresa == 'TRX'){
            redirect()->to('/registro-trx');
        }
        if($this->tipoEmpresa == 'IAIM'){
            redirect()->to('/registro-iaim');
        }
    }

    public function render()
    {
        return view('livewire.auth.registro-index');
    }
}
