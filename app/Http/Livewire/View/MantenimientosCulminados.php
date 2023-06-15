<?php

namespace App\Http\Livewire\View;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MantenimientosCulminados extends Component
{
    public $buscar;

    public function render()
    {
        return view('livewire.view.mantenimientos-culminados',  [
            'data' => Bitacora::orderBy('id', 'desc')
            ->orWhere('nro_ot', 'like', "%{$this->buscar}%")
            ->orWhere('agencia', 'like', "%{$this->buscar}%")
            ->orWhere('estado', 'like', "%{$this->buscar}%")
            ->paginate(2)
        ]);
    }
}
