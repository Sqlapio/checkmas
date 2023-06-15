<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Agencia;
use App\Models\Estadistica;
use App\Models\Estado;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tikect as ModelTikect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class CrearTikect extends Component
{

    use Actions;

    use WithPagination;

    use WithFileUploads;


    public $tikect_uid;
    public $tipoServicio;
    public $oficina;
    public $piso;
    public $estado;
    public $agencia;
    public $observaciones;
    public $owner;
    public $owner_email;
    public $status_tikect;
    public $des_status;

    public $atr_otro_servicio = 'hidden';
    public $atr_select_servicio = '';
    public $otroServicio;


    protected $rules = [
        'tipoServicio'    => 'required',
        'oficina'         => 'required',
        'piso'            => 'required',
        'estado'          => 'required',
        'agencia'         => 'required',
        'observaciones'   => 'required',

    ];

    protected $messages = [
        'tipoServicio.required' => 'Campo Requerido',
        'oficina.required'      => 'Campo Requerido',
        'piso.required'         => 'Campo Requerido',
        'estado.required'       => 'Campo Requerido',
        'agencia.required'      => 'Campo Requerido',
        'observaciones.required' => 'Campo Requerido',

    ];

    protected $listeners = [
        'otro_servicio'
    ];

    public function otro_servicio($value)
    {
        if ($value == 'otro') {
            $this->atr_otro_servicio = '';
            $this->atr_select_servicio = 'hidden';
        } else {
            $this->atr_otro_servicio = 'hidden';
            $this->atr_select_servicio = '';
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {

        $this->validate();

        try {

            $user = Auth::user();

            $desEstado = Estado::where('codigo', $this->estado)->get();
            foreach ($desEstado as $item) {
                $estadoDes = $item->descripcion;
                $color = $item->color;
            }

            $desAgencia = Agencia::where('codigo', $this->agencia)->get();
            foreach ($desAgencia as $item) {
                $agenciaDes = $item->descripcion;
            }

            /**
             * Owner tikect
             */
            $owner = $user->nombre . ' ' . $user->apellido;
            $owner_email = $user->email;

            $creaTikect = new ModelTikect();

            /**
             * Logica para formar el
             * correlativo del tikect
             */
            $uid = DB::table('tikects')->latest("id")->first();

            if ($uid == NULL) {
                $creaTikect->tikect_uid = $this->agencia . '-' . $this->estado . '-1';
            } else {
                $tercerTer = $uid->id + 1;
                $creaTikect->tikect_uid = $this->agencia . '-' . $this->estado . '-' . $tercerTer;
            }

            if (isset($this->otroServicio)) {
                $creaTikect->tipoServicio   = $this->otroServicio;
                $servicio = new Servicio();
                $servicio->descripcion = $creaTikect->tipoServicio;
                $servicio->save();

            } else {
                $creaTikect->tipoServicio   = $this->tipoServicio;
            }
            $creaTikect->piso           = $this->piso;
            $creaTikect->oficina        = $this->oficina;
            $creaTikect->agencia        = $agenciaDes;
            $creaTikect->estado         = $estadoDes;
            $creaTikect->color          = $color;
            $creaTikect->observaciones  = $this->observaciones;
            $creaTikect->owner          = $owner;
            $creaTikect->owner_email    = $owner_email;
            /**
             * Status Tikect
             * 0 -> registrado
             * 1 -> aprobado
             * 2 -> anulado
             */
            $creaTikect->status_tikect  = '0';
            $creaTikect->des_status  = 'abierto';
            $creaTikect->save();

            /**
             * @method total_ticket_abiertos
             * @param $estado
             * @param $estatus 0 -> Abierto , 1-> cerrado
             * Logica para guardar el acumulado de ticket creados
             */
            UtilsController::total_ticket($creaTikect->estado, 0);

            $this->reset();

            $this->notification()->success(
                $title = 'ÉXITO!',
                $description = 'La Tikect fue registrado con éxito'
            );

            $this->emitTo('lista-tikects', 'refreshComponent');

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Se ha producido un error al intentar guardar el Tikect.'
            );
        }
    }

    public function render()
    {
        return view('livewire.view.crear-tikect');
    }
}
