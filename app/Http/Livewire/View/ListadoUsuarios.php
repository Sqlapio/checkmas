<?php

namespace App\Http\Livewire\View;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ListadoUsuarios extends Component
{

    use WithPagination;

    public $buscar;

    public function updateStatusRegistro($id, $status)
    {
        $data = User::find($id)->status_registro;
        if($data == '0' && $status == '1'){
            DB::table('users')
                ->where('id', $id)
                ->update(['status_registro' => 1]);
        }
        if($data == '1' && $status == '2'){
            DB::table('users')
                ->where('id', $id)
                ->update(['status_registro' => 2]);
        }
        if($data == '2' && $status == '3'){
            DB::table('users')
                ->where('id', $id)
                ->update(['status_registro' => 1]);
        }
    }

    public function render()
    {
        $empresa = Auth::User()->empresa;

        return view('livewire.view.listado-usuarios', [
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