<?php

namespace App\Http\Livewire\View;

use App\Models\User;
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
        // $data = User::where('empresa', $empresa)->get();
        // dd($data);

        if($empresa == 'Trx'){
            return view('livewire.view.usuarios-activos', [
                'data' => User::orderBy('activo', 'desc')
                    ->orWhere('nombre', 'like', "%{$this->buscar}%")
                    ->orWhere('apellido', 'like', "%{$this->buscar}%")
                    ->orWhere('ci_rif', 'like', "%{$this->buscar}%")                                      
                    ->orWhere('telefono', 'like', "%{$this->buscar}%")
                    ->orWhere('email', 'like', "%{$this->buscar}%")
                    ->orWhere('cargo', 'like', "%{$this->buscar}%")
                    ->orWhere('status_registro', 'like', "%{$this->buscar}%")
                    ->orWhere('empresa', 'like', "%{$this->buscar}%")
                    ->paginate(5)
            ]);

        }else{
            return view('livewire.view.usuarios-activos', [
                'data' => User::where('empresa', $empresa)
                    ->where('nombre', 'like', "%{$this->buscar}%")
                    ->where('apellido', 'like', "%{$this->buscar}%")
                    ->orderBy('id', 'desc')
                    ->paginate(5)
            ]);

        }

    }
}
