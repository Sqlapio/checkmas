<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Ot;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use WireUi\Traits\Actions;

class MantenimientosMc extends Component
{
    use Actions;

    use WithPagination;

    public $buscar;
    public $atr = 'text-gray-400';

    public function showFicha($id, $equipoUid)
    {
        $this->emit('showFichaModal', $equipoUid);
        // dd($id, $equipoUid);
    }

    public function updateStatusAdmin($id, $btr){

        try {
            if (ot::find($id)->statusOts_banco == 1) {
                $this->notification()->error(
                    $title = 'NOTIFICACIÓN',
                    $description = 'Acción No Valida!, El cliente debe aprobar la orden de trabajo para luego usted pueda realizar la Aprobación respectiva.'
                );
            } else {
    
                $data = ot::where('id', $id)->get();
                    foreach ($data as $item) {
                        $statusOts = $item->statusOts;
                        $estado = $item->estado;
                        $pre_cli = $item->costo_preCli;
                    }
                
                if ($statusOts == '1' && $btr == '2') {
                    DB::table('ots')
                        ->where('id', $id)
                        ->update(['statusOts' => 2]);
                }
                UtilsController::total_ot_mc_estatus($estado, 2);
                UtilsController::total_inversion_mc($pre_cli, $estado);
            }
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
        
        
    }

    public function updateStatusBanco($id, $btr){

        try {

            if(Auth::User()->rol == '2'){
                $data = ot::find($id)->statusOts_banco;

                if ($data == '1' && $btr == '1') {
                    DB::table('ots')
                        ->where('id', $id)
                        ->update(['statusOts_banco' => 2]);
                }
            }else{
                $this->notification()->error(
                    $title = 'NOTIFICACIÓN',
                    $description = 'Usted no tiene permitido realizar esta operación'
                );
            }
            
        } catch (\Throwable $th) {
            dd($th);
        }  

    }

    public function eliminar($id){

        try {

            $data = Ot::where('id', $id)->get();

            foreach ($data as $item) {
                    $estado = $item->estado;
                    $costo_preCli = $item->costo_preCli;
                    $statusOts = $item->statusOts;
                    $statusOts_banco = $item->statusOts_banco;
                }
            
            if($statusOts == '1' && $statusOts_banco == '1')
            {

                DB::table('ots')
                ->where('id', $id)
                ->update(['statusOts' => 6]);

                UtilsController::actualiza_total_inversion_mc($costo_preCli, $estado);

                $this->notification()->success(
                    $title = 'NOTIFICACIÓN',
                    $description = 'La Ots fue eliminada con exito'
                );
                
            }

            if($statusOts_banco == '2')
            {

                $this->notification()->error(
                    $title = 'NOTIFICACIÓN',
                    $description = 'La Ots no puede ser eliminada ya que se encuentra aprobada por parte del banco'
                );
                
            } 
            
        } catch (\Throwable $th) {
            dd($th);
        }

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
        // return view('livewire.view.mantenimientos-mc');
        return view('livewire.view.mantenimientos-mc', [
            'data' => Ot::where('tipoMantenimiento', 'MC')
                ->WhereIn('statusOts', ['1','2','3','4','5'])
                ->Where('otUid', 'like', "%{$this->buscar}%")
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        ]);
    }
}
