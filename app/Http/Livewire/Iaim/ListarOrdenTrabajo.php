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

    public $buscar;
    public $fil_status;
    public $fil_cod_ot;
    public $fil_hoy;
    public $fil_semana;

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
                $title = 'ÉXITO!',
                $description = 'El estatus de la orden fue actualizado con éxito'
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
            $title = 'NOTIFICACIÓN!',
            $description = 'El producto No '.$codigo.' fue eliminado de forma correcta'
        );
    }
    
    public function render()
    {

        $data = IaimOrdenTrabajo::where('status','<', 3)
            ->when($this->buscar, function($query, $aeropuerto) 
            {
                return $query->where('codigo_ot', 'like', "%{$this->buscar}%")
                            ->orWhere('aeropuerto', 'like', "%{$this->buscar}%")
                            ->orWhere('area', 'like', "%{$this->buscar}%");
            })
            ->when($this->fil_status, function($query, $status) 
            {
                return $query->where('status' , $this->fil_status);
            })
            ->when($this->fil_hoy, function($query, $hoy) 
            {
                return $query->where('fecha_ot' , date_format(now(), 'd-m-Y'));
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        $materiales = IaimMaterialOrdenTrabajo::where('codigo_ot', $this->codigo_ot)->paginate(5);

        return view('livewire.iaim.listar-orden-trabajo', compact('data','materiales'));
    }
}
