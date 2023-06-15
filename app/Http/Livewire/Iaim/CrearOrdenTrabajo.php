<?php

namespace App\Http\Livewire\Iaim;

use App\Http\Controllers\UtilsController;
use App\Models\IaimMaterialOrdenTrabajo;
use App\Models\IaimOrdenTrabajo;
use Barryvdh\Debugbar\Facades\Debugbar;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class CrearOrdenTrabajo extends Component
{
    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $fecha_ot;
    public $aeropuerto;
    public $area;
    public $codigo_producto;
    public $reportado_por;
    public $descripcion_general;
    public $cantidad;
    public $codigo_ot;
    public $prefijo = 'IAIM';
    public $parte2;
    public $parte3;
    public $parte4;

    public $grid = 'hidden';
    public $area_n = 'hidden';
    public $area_i = 'hidden';
    public $area_es = 'hidden';
    public $botton_grid = 'hidden';
    public $save = '';

    protected $listeners = ['aero_selected'];

    /**
     * Reglas de validación para validar
     * el formulario de la Orden de trabajo
     */
    public function validateDataOt()
    {
        $this->validate([
            'reportado_por'         => 'required',
            'aeropuerto'            => 'required',
            'area'                  => 'required',
            'descripcion_general'   => 'required',

        ]);
    }

    /**
     * Reglas de validación para validar
     * el formulario de los materiales que se
     * agregan a la orden de trabajo
     */
    public function validateDataMateriales()
    {
        $this->validate([
            'cantidad'         => 'required|numeric|min:1',
            'codigo_producto'  => 'required',

        ]);
    }

    /**
     * Mensajes de validacion
     */
    protected $messages = [

        'reportado_por.required'       => 'Campo Requerido',
        'aeropuerto.required'          => 'Campo Requerido',
        'area.required'                => 'Campo Requerido',
        'descripcion_general.required' => 'Campo Requerido',
        'cantidad.required'            => 'Campo Requerido',
        'codigo_producto.required'     => 'Campo Requerido',
        'cantidad.numeric'             => 'El campo solo admite caracteres numericos',

    ];

    public function aero_selected($value)
    {
        if($value == 'nacional'){
            $this->area_n = '';
            $this->area_i = 'hidden';
            $this->area_es = 'hidden';
        }
        if($value == 'internacional'){
            $this->area_n = 'hidden';
            $this->area_i = '';
            $this->area_es = 'hidden';
        }
        if($value == 'edif_sede'){
            $this->area_n = 'hidden';
            $this->area_i = 'hidden';
            $this->area_es = '';
        }
    }

    public function mostrar_grid()
    {
        $this->grid = '';
    }

    public function eliminar_materiales($id)
    {
        DB::table('iaim_material_orden_trabajos')->where('codigo_producto', $id) ->where('codigo_ot', $this->codigo_ot)->delete();
        $this->reset(['codigo_producto', 'cantidad']);
        $this->notification()->error(
            $title = 'NOTIFICACION!',
            $description = 'El producto No '.$id.' fue eliminado de forma correcta'
        );
       
        
    }

    public function store_ot()
    {
        $this->validateDataOt();

        try {

            $user = Auth::user();

            $ot = new IaimOrdenTrabajo();
            $ot->fecha_ot = date('d-m-Y');
            $ot->codigo_ot = UtilsController::crear_codigo_ot($this->aeropuerto, $this->area);
            $ot->aeropuerto = $this->aeropuerto;
            $ot->area = $this->area;
            $ot->reportado_por = $this->reportado_por;
            $ot->division = $user->division;
            $ot->coordinacion = $user->coordinacion;
            $ot->descripcion_general = $this->descripcion_general;
            $ot->usr_res_nombre = $user->nombre.' '.$user->apellido;
            $ot->usr_res_cedula = $user->ci_rif;
            $ot->usr_res_cargo = $user->cargo;
            $ot->usr_res_correo = $user->email;
            $ot->save();

            $this->botton_grid = '';

            $this->codigo_ot = $ot->codigo_ot;

            $this->notification()->success(
                $title = 'Exito!',
                $description = 'La Orden de trabajo fue creada con exito'
            );


        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function agregar_materiales()
    {

        $this->validateDataMateriales();

        try {
            
            $res = DB::table('iaim_orden_trabajos')->where('codigo_ot', $this->codigo_ot)->get();
            foreach($res as $item){
                $usuario_responsable = $item->usr_res_nombre;
            }

            $res_prod = DB::table('iaim_articulos')->where('codigo', $this->codigo_producto)->get();
            foreach($res_prod as $item){
                $descripcion = $item->descripcion;
                $categoria = $item->categoria;
            }

            $existencia = UtilsController::total_existe($this->codigo_producto);

            $materiales = New IaimMaterialOrdenTrabajo();
            $materiales->codigo_ot = $this->codigo_ot;
            $materiales->codigo_producto = $this->codigo_producto;
            $materiales->descripcion = $descripcion;
            $materiales->categoria = $categoria;
            $materiales->existencia_total = $existencia;
            $materiales->cantidad = $this->cantidad;
            $materiales->usuario_responsable = $usuario_responsable;

            if($materiales->existencia_total == 0)
            {
                $this->notification()->error(
                    $title = 'NOTIFICACION!',
                    $description = 'El producto No '.$materiales->codigo_producto.' tiene existencia cero(0). No puede ser cargado en la orden de trabajo'
                );
                $this->reset(['codigo_producto', 'cantidad']);

            }
            elseif($materiales->cantidad >= $materiales->existencia_total)
            {
                $this->notification()->error(
                    $title = 'NOTIFICACION!',
                    $description = 'El la cantidad solicitada no puede ser igual o mayor a la existencia total'
                );
                $this->reset(['codigo_producto', 'cantidad']);
            }
            else
            {
                $materiales->save();
                $this->notification()->success(
                    $title = 'NOTIFICACION!',
                    $description = 'El producto No '.$materiales->codigo_producto.' fue agregado a la orden de trabajo'
                );
                $this->reset(['codigo_producto', 'cantidad']);
            }

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function render()
    {
        $this->fecha_ot = date('d-m-Y h:m:s a');
        return view('livewire.iaim.crear-orden-trabajo', [
            'data' => IaimMaterialOrdenTrabajo::where('codigo_ot', $this->codigo_ot)
            ->paginate(4)
        ]);
    }
}
