<?php

namespace App\Http\Livewire\View;

use App\Models\FichaTecnica;
use Livewire\Component;
use Livewire\WithPagination;

class Equipos extends Component
{
    use WithPagination;

    public $buscar;
    
    public function render()
    {
        return view('livewire.view.equipos', [
            'data' => FichaTecnica::where('uid', 'like', "%{$this->buscar}%")
                ->orWhere('qrConden', 'like', "%{$this->buscar}%")
                ->orWhere('qrEvaporador', 'like', "%{$this->buscar}%")
                ->orWhere('agencia', 'like', "%{$this->buscar}%")
                ->orWhere('estado', 'like', "%{$this->buscar}%")
                ->orderBy('id', 'desc')
                ->paginate(5)
        ]);
    }
}
