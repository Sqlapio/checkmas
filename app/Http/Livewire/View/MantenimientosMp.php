<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Ot;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MantenimientosMp extends Component
{
    use WithPagination;

    public $buscar;
    public $atr = 'text-gray-400';

    public function showFicha($id, $equipoUid)
    {
        $this->emit('showFichaModal', $equipoUid);
        // dd($id, $equipoUid);
    }

    public function updateStatusAdmin($id, $btr){
        $data = ot::where('id', $id)->get();
        foreach ($data as $item) {
            $statusOts = $item->statusOts;
            $estado = $item->estado;
            $pre_cli = $item->costo_preCli;
        }

        if($statusOts == '1' && $btr == '2'){
            DB::table('ots')
                ->where('id', $id)
                ->update(['statusOts' => 2]);
        }
        UtilsController::total_ot_mp_estatus($estado, 2);

    }

    public function updateStatusSupervisor($id, $btr){
        $data = ot::find($id)->statusOts;

        if($data == '2' && $btr == '3'){
            DB::table('ots')
                ->where('id', $id)
                ->update(['statusOts' => 3]);
            $this->atr = 'text-green-700';
        }
        if($data == '3' && $btr == '4'){
            DB::table('ots')
                ->where('id', $id)
                ->update(['statusOts' => 4]);
        }
        if($data == '4' && $btr == '5'){
            DB::table('ots')
                ->where('id', $id)
                ->update(['statusOts' => 5]);
        }

    }

    public function render()
    {
        $data = Ot::where('tipoMantenimiento', 'MP')->get();
        return view('livewire.view.mantenimientos-mp', [
            'dataMp' => Ot::where('tipoMantenimiento', 'MP')
                ->Where('otUid', 'like', "%{$this->buscar}%")
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        ]);
    }
}
