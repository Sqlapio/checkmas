<?php

namespace App\Http\Livewire\Iaim;

use App\Models\Iaim_Articulo as ModelsArticulo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use WireUi\Traits\Actions;
use Livewire\Component;
use Livewire\WithPagination;

class Articulo extends Component
{
    use WithPagination;

    use Actions;

    public $categoria;
    public $descripcion;
    public $proveedor;
    public $precio_unitario;
    public $cantidad_minima;

    public $buscar;

    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [

        'descripcion'       => 'required',
        'categoria'         => 'required',
        'proveedor'         => 'required',
        'precio_unitario'   => 'required',
        'cantidad_minima'   => 'required',


    ];

    protected $messages = [

        'descripcion'       => 'Campo requerido',
        'categoria'         => 'Campo requerido',
        'proveedor'         => 'Campo requerido',
        'precio_unitario'   => 'Campo requerido',
        'cantidad_minima'   => 'Campo requerido',

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
        
            $articulo = new ModelsArticulo();
            $articulo->descripcion = $this->descripcion;
            $articulo->categoria = $this->categoria;
            $articulo->proveedor = $this->proveedor;
            $articulo->precio_unitario = $this->precio_unitario;
            $articulo->codigo = rand(10000000,99999999);
            $articulo->cantidad_minima = $this->cantidad_minima;
            $articulo->usuario_responsable = $user->nombre.' '.$user->apellido;

            /**
             * @param $duplicado
             * Se agrega para evitar que el articulo sea guardado varias veces.
             */
            $duplicado = ModelsArticulo::where('descripcion', $this->descripcion)->get();
            if(count($duplicado) >= 1)
            {
                $this->notification()->error(
                    $title = 'Articulo duplicado!',
                    $description = 'El articulo ya se encuentra registrado'
                );
            }else{

                $articulo->save();

                $this->reset();

                $this->notification()->success(
                    $title = 'Articulo Creado!',
                    $description = 'El articulo '.$articulo->codigo.' fue creado correctamente'
                );

            }

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function render()
    {
        return view('livewire.iaim.articulo' , [
            'data' => ModelsArticulo::orderBy('id', 'desc')
                ->orWhere('descripcion', 'like', "%{$this->buscar}%")
                ->orWhere('categoria', 'like', "%{$this->buscar}%")
                ->orWhere('proveedor', 'like', "%{$this->buscar}%")                                      
                ->orWhere('codigo', 'like', "%{$this->buscar}%")
                ->paginate(5)
        ]);
    }
}
