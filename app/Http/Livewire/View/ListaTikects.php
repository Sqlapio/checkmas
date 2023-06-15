<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Tikect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use WireUi\Traits\Actions;

class ListaTikects extends Component
{
    use Actions;

    public $buscar;
    public $campo = 'id';
    public $filtro_estatus;
    public $atr_tabla_ticket = '';
    public $atr_form_otsTicket = 'hidden';
    public $atr_form = 'hidden';
    public $nro_ticket;
    public $observaciones_cierre;

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'filtro'
    ]; 

    public function updateStatusTikect($id, $btr){

        try { 
                $data = Tikect::find($id)->status_tikect;
                    if ($data == '0' && $btr == '1') {
                        $this->nro_ticket = Tikect::find($id)->tikect_uid;
                        $this->atr_form = '';
                        $this->atr_tabla_ticket = 'hidden';
                    }

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Function updateStatusTikect().ListaTikects'
            );
        }
    }

    public function validateData()
    {
        $this->validate([
            'nro_ticket'   => 'required',
            'observaciones_cierre'=> 'required',
        ]);
    }

    protected $messages = [

        'nro_ticket.required'    => 'Campo Requerido',
        'observaciones_cierre.required' => 'Campo requerido',

    ];

    public function actualiza_estatus()
    {

        $this->validateData();

        try {

            DB::table('tikects')
                ->where('tikect_uid', $this->nro_ticket)
                ->update([
                    'status_tikect' => 1,
                    'fecha_fin' => date('d-m-Y'),
                    'observaciones_cierre' => $this->observaciones_cierre,
                ]);
            
            $data = Tikect::where('tikect_uid', $this->nro_ticket)->get();
            foreach($data as $item){
                $estado = $item->estado;
            }

            /**
             * @method total_ticket_abiertos
             * @param $estado
             * @param $estatus 0 -> Abierto , 1-> cerrado
             * Logica para guardar el acumulado de ticket creados
             */
            UtilsController::total_ticket($estado, 1);

                $this->reset();

                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'El ticket fue cerrado con éxito'
                );

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Function actualiza_estatus() - livewire.ListaTikects'
            );
        }
    }

    public function eliminar($id)
    {
        try {
                DB::table('tikects')
                ->where('id', $id)
                ->update([
                    'status_tikect' => 3,
                ]);
                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'El ticket Nro ***-***-.'.$id.' fue eliminado con existo'
                );

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function filtro($value)
    {
        $this->campo = $value;
    }

    public function CrearOt($id)
    {
        if(Tikect::find($id)->status_tikect == '1'){
            $this->notification()->error(
                $title = 'NOTIFICACIÓN!',
                $description = 'La Orden de Trabajo no puede ser generada. El Tikect debe estar en estatus Abierto.'
            );
        }else{
            $this->emit('showFormOts', $id);
            $this->atr_form_otsTicket = '';
            $this->atr_tabla_ticket = 'hidden';

        }
    
    }

    public function render()
    {
        return view('livewire.view.lista-tikects', [
            'data' => Tikect::whereIn('status_tikect', ['0','1'])
                ->orderBy($this->campo, 'desc')
                ->paginate(5)
        ]);
    }
}
