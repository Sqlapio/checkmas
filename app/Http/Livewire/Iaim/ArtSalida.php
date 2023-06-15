<?php

namespace App\Http\Livewire\Iaim;

use App\Models\Iaim_Articulo;
use Livewire\Component;
use App\Models\Iaim_Movimiento_Inventario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class ArtSalida extends Component
{
    use WithPagination;

    use Actions;

    public $articulo_id;
    public $salida;
    public $codigo_ot;

    public $buscar;

    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [

        'articulo_id'       => 'required',
        'salida'           => 'required',
        'codigo_ot'           => 'required',

    ];

    protected $messages = [

        'articulo_id'       => 'Campo requerido',
        'salida'           => 'Campo requerido',
        'codigo_ot'           => 'Campo requerido',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        try {
            $user = Auth::user();

            $articulo = Iaim_Articulo::findOrFail($this->articulo_id);
            $id = $articulo->id;
            $codigo = $articulo->codigo;
            $descripcion = $articulo->descripcion;
            $salida = $this->salida;
            $fecha_salida = date('d-m-Y');
            $tipo_mov = 2;
            $usuario_responsable = $user->nombre.' '.$user->apellido;


            $movimientos = new Iaim_Movimiento_Inventario();
            $movimientos->articulo_id = $id;
            $movimientos->codigo = $codigo;
            $movimientos->descripcion = $descripcion;
            $movimientos->categoria = $articulo->categoria;
            $movimientos->salida = $salida;
            $movimientos->fecha_salida = $fecha_salida;
            $movimientos->codigo_ot = $this->codigo_ot;
            $movimientos->usuario_responsable = $usuario_responsable;
            $movimientos->tipo_mov = $tipo_mov;
            $movimientos->save();

            $this->reset();

            $this->notification()->success(
                $title = 'Exito!',
                $description = 'La carga de inventario fue realizada correctamente'
            );
           
        } catch (\Throwable $th) {
            dd($th);
        }

    }


    public function render()
    {

        return view('livewire.iaim.art-salida' , [
            'data' => DB::table('iaim_movimiento_inventarios')
                ->where('tipo_mov', 2)
                ->where('codigo', 'like', "%{$this->buscar}%")
                ->paginate(5)
        ]);
    }
}
