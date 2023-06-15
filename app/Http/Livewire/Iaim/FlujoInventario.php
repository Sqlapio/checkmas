<?php

namespace App\Http\Livewire\Iaim;

use Livewire\Component;
use App\Models\Iaim_Movimiento_Inventario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class FlujoInventario extends Component
{
    use WithPagination;

    use Actions;

    public $buscar;

    public function render()
    {
        return view('livewire.iaim.flujo-inventario' , [
            'data' => Iaim_Movimiento_Inventario::orderBy('id', 'desc')
                ->orWhere('descripcion', 'like', "%{$this->buscar}%")                                   
                ->orWhere('codigo', 'like', "%{$this->buscar}%")
                ->paginate(5)
        ]);
    }
}
