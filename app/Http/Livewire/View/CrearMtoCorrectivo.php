<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Agencia;
use App\Models\FichaTecnica;
use App\Models\Ot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class CrearMtoCorrectivo extends Component
{

    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $otUid;
    public $fechaInicio;
    public $tecRespondable;
    public $equipoUid;
    public $costo_oper;
    public $costo_preCli;
    public $pdf_pre_oper;
    public $pdf_pre_preCli;
    public $porcen = '';


    protected $listeners = [
        'formatMonto',
        'calc',
    ];


    /**
     * Reglas de validación para todos los campos del formulario
     */
    public function validateData()
    {
        $this->validate([
            'fechaInicio'       => 'required',
            'tecRespondable'    => 'required',
            'equipoUid'         => 'required',
        ]);

    }


    protected $messages = [
        'fechaInicio.required'       => 'Campo Requerido',
        'tecRespondable.required'    => 'Campo Requerido',
        'equipoUid.required'         => 'Campo Requerido',
        'costo_oper.required'        => 'Campo Requerido',
        'costo_preCli.required'      => 'Campo Requerido',
        'pdf_pre_oper.required'      => 'Documento Requerido',
        'pdf_pre_preCli.required'    => 'Documento Requerido',
        'pdf_pre_oper.mimes'        => 'El formato del documento es incorrecto',
        'pdf_pre_preCli.mimes'      => 'El formato del documento es incorrecto',
        'pdf_pre_oper.max'          => 'El tamaño del documento no esta permitido',
        'pdf_pre_preCli.max'        => 'El tamaño del documento no esta permitido',

    ];


    public function datosTecRes()
    {
        $datos = User::where('email', $this->tecRespondable)->get();
        foreach ($datos as $item) {
            $nombre = $item->nombre;
            $apellido = $item->apellido;
        }
        $data = $nombre . ' ' . $apellido;
        return $data;
    }


    public function calc($value)
    {
        $calc = (($this->costo_preCli/$this->costo_oper)-1)*100;
        $this->porcen = round($calc, 2);

    }


    public function formatMonto($number)
    {

        $valor = Str::remove('.', $number);
        $finalValor = Str::replace(',', '.', $valor);

        return $finalValor;
    }

    
    public function store()
    {
        $this->validateData();

        try {

                $fecha = Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->format('dmY');
                $otUid = $fecha . '-' . $this->equipoUid . '-MC';
        
                $data_equipo = FichaTecnica::where('uid', $this->equipoUid)->get();
                    foreach ($data_equipo as $item) {
                        $estado = $item->estado;
                        $agencia = $item->agencia;
                        $btu = $item->btu;
                    }
        
                $cod_agencia = Agencia::where('descripcion', $agencia)->get();
                    foreach ($cod_agencia as $item) {
                        $codigo = $item->codigo;
                    }
        
                $user = Auth::user();
                /**
                 * Cargamos las imagenes
                 */
                $pdf_pre_oper  = $this->pdf_pre_oper->store($otUid . '/presupuesto-operacion', 'public');
                $pdf_pre_preCli = $this->pdf_pre_preCli->store($otUid . '/presupuesto-cliente', 'public');
        
                $ot = new Ot();
                $ot->otUid = $otUid;
                $ot->fechaInicio = Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->format('d-m-Y');
                $ot->tecRes_NomApe = $this->datosTecRes();
                $ot->tecRes_email = $this->tecRespondable;
                $ot->equipoUid = $this->equipoUid;
                $ot->btu = $btu;
                $ot->codigo_agencia = $codigo;
                $ot->estado = $estado;
                $ot->agencia = $agencia;
                $ot->tipoMantenimiento = 'MC';
                $ot->costo_oper = $this->costo_oper;
                $ot->costo_preCli = $this->costo_preCli;
                $ot->pdf_pre_oper = $pdf_pre_oper;
                $ot->pdf_pre_preCli = $pdf_pre_preCli;
                $ot->tir = $this->porcen;
                $ot->owner = $user->email;
                $ot->statusOts = '1';
                $ot->statusOts_banco = '1';
                $ot->save();
        
                /**
                 * @method total_mc
                 * @param $estado
                 * Logica para guardar el acumulado de los MP en estatus creada
                 */
                UtilsController::total_ot_mc_estatus($ot->estado, 1);
        
                $this->reset();
        
                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La orden de trabajo fue registrada con éxito'
                );

        } catch (\Throwable $th) {
            dd($th);
        }

        
    }


    public function render()
    {
        return view('livewire.view.crear-mto-correctivo');
    }
}
