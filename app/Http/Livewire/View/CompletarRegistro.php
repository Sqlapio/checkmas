<?php

namespace App\Http\Livewire\View;

use Livewire\Component;

class CompletarRegistro extends Component
{
    public $telefono;
    public $hola ='hola';

    public function render()
    {
        return view('livewire.view.completar-registro');
    }
}
