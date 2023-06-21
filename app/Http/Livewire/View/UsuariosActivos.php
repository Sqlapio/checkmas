<?php

namespace App\Http\Livewire\View;

use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class UsuariosActivos extends Component
{

    use WithPagination;

    public $buscar;


    public function render()
    {
        $empresa = Auth::User()->empresa;

        return view('livewire.view.usuarios-activos', [
            'data' => User::orderBy('created_at', 'desc')
                ->Where('empresa', $empresa)
                ->when($this->buscar, function($query, $buscar) 
            {
                return $query->where('nombre', 'like', "%{$this->buscar}%");
            })
            ->paginate(5)
        ]);

    }
}
