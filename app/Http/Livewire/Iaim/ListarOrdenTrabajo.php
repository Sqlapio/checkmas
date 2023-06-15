<?php

namespace App\Http\Livewire\Iaim;

use App\Models\IaimMaterialOrdenTrabajo;
use App\Models\IaimOrdenTrabajo;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ListarOrdenTrabajo extends Component
{
    use WithPagination;

    use Actions;

    public $codigo_ot;
    public $valor_urgencia;
    public $valor_obra;
    public $recomendaciones;
    public $otras_diviciones;
    public $mostrar = 'hidden';

    public function validateData()
    {
        $this->validate([
            'valor_urgencia'    => 'required',
            'valor_obra'        => 'required',
            'otras_diviciones'  => 'required',
        ]);
    }


    public function aprobar($id)
    {
        $codigo = IaimOrdenTrabajo::where('id', $id)->get();
        foreach($codigo as $item){
            $codigo_ot = $item->codigo_ot;
        }
        Debugbar::info($codigo);
        $this->mostrar = '';
        $this->codigo_ot = $codigo_ot;

    }

    public function imprimir($id)
    {
        redirect()->to('/reporte/ot/'.$id);

    }

    public function guardar_aprobacion()
    {
        $this->validateData();

        try {
            $user = Auth::user();
            DB::table('iaim_orden_trabajos')
                    ->where('codigo_ot', $this->codigo_ot)
                    ->update([
                        'valor_urgencia'    => $this->valor_urgencia,
                        'valor_obra'        => $this->valor_obra,
                        'otras_diviciones'  => $this->otras_diviciones,
                        'recomendaciones'   => $this->recomendaciones,
                        'status'   => '2',
                        'aprobada_por'   => $user->nombre.' '.$user->apellido,
                        'fecha_aprobacion'   => date('d-m-Y')
                    ]);
            $this->notification()->success(
                $title = 'EXITO!',
                $description = 'El estatus de la orden fue actualizado con exito'
            );
            $this->reset();
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function eliminar_materiales($codigo)
    {
        DB::table('iaim_material_orden_trabajos')->where('codigo_producto', $codigo) ->where('codigo_ot', $this->codigo_ot)->delete();
        $this->notification()->error(
            $title = 'NOTIFICACION!',
            $description = 'El producto No '.$codigo.' fue eliminado de forma correcta'
        );
    }
    
    public function render()
    {
        return view('livewire.iaim.listar-orden-trabajo', [
            'data' => IaimOrdenTrabajo::orderBy('id', 'desc')
            ->paginate(5),
            'materiales' => IaimMaterialOrdenTrabajo::where('codigo_ot', $this->codigo_ot)
            ->paginate(5),

        ]);
    }
}
