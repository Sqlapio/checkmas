<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Agencia;
use App\Models\Estado;
use App\Models\FichaTecnica;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Ot;
use App\Models\Tikect;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class OrdenTrabajo extends Component
{

    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $otUid;
    public $tikect_id;
    public $owner_tikect;
    public $estado_tikect;
    public $fechaInicio;
    public $tecRespondable;
    public $equipoUid;
    public $tipoMantenimiento;
    public $costo_oper;
    public $costo_preCli;
    public $pdf_pre_oper;
    public $pdf_pre_preCli;
    public $owner;
    public $statusOts;
    public $statusOts_banco;
    public $atr_form_ot = 'hidden';

    public $atr = 'hidden';
    public $atr_info_tikect = 'hidden';

    public $porcen = '';
    public $buscar;

    protected $listeners = [
        'selection',
        'formatMonto',
        'calc',
        'showFormOts'
    ];

    public function showFormOts($id)
    {
        $this->atr_info_tikect = '';

        $info = Tikect::find($id);
        $nroTikect  = $info->tikect_uid;
        $owner_email = $info->owner_email;
        $estado_tikect = $info->estado;

        $this->tikect_id = $nroTikect;
        $this->owner_tikect = $owner_email;
        $this->estado_tikect = $estado_tikect;
        $this->atr_form_ot = '';

    }

    public function selection($value)
    {
        if ($value == 'MC') {
            $this->atr = '';
        }

        if ($value != 'MC') {
            $this->atr = 'hidden';
        }
    }

    public function calc($value)
    {
        $calc = (($this->costo_preCli/$this->costo_oper)-1)*100;
        $this->porcen = round($calc, 2);

    }

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

    public function formatMonto($number)
    {

        $valor = Str::remove('.', $number);
        $finalValor = Str::replace(',', '.', $valor);

        return $finalValor;
    }

    /**
     * Reglas de validación para todos los campos del formulario
     */
    public function validateData()
    {
        if ($this->tipoMantenimiento == 'MP') {
            $this->validate([
                'fechaInicio' => 'required',
                'tecRespondable'  => 'required',
                'equipoUid'  => 'required',
                'tipoMantenimiento'  => 'required',
            ]);
        }

        if ($this->tipoMantenimiento == 'MC') {
            $this->validate([
                'fechaInicio' => 'required',
                'tecRespondable'  => 'required',
                'equipoUid'  => 'required',
                'tipoMantenimiento'  => 'required',
                'costo_oper'  => 'required',
                'costo_preCli'  => 'required',
                'pdf_pre_oper'  => 'required|file|mimes:pdf|max:2048',
                'pdf_pre_preCli'  => 'required|file|mimes:pdf|max:2048',

            ]);
        }

        if ($this->tipoMantenimiento == '') {
            $this->validate([
                'tipoMantenimiento' => 'required',

            ]);
        }
    }

    protected $messages = [
        'fechaInicio.required'       => 'Campo Requerido',
        'tecRespondable.required'    => 'Campo Requerido',
        'equipoUid.required'         => 'Campo Requerido',
        'tipoMantenimiento.required' => 'Campo Requerido',
        'costo_oper.required'        => 'Campo Requerido',
        'costo_preCli.required'      => 'Campo Requerido',
        'pdf_pre_oper.required'      => 'Documento Requerido',
        'pdf_pre_preCli.required'    => 'Documento Requerido',
        'pdf_pre_oper.mimes'        => 'El formato del documento es incorrecto',
        'pdf_pre_preCli.mimes'      => 'El formato del documento es incorrecto',
        'pdf_pre_oper.max'          => 'El tamaño del documento no esta permitido',
        'pdf_pre_preCli.max'        => 'El tamaño del documento no esta permitido',

    ];

    /**
     * Funcion para guardar los tipos de mantenimientos
     * MP y MC
     */
    public function store()
    {

        $this->validateData();

        try {

            /**
             * Logica para obtener el codigo del estado y el codigo de la agencia 
             * de la ubicacion del equipo
             */
            $datos = FichaTecnica::where('uid', $this->equipoUid)->get();
            foreach ($datos as $item) {
                $estado = $item->estado;
                $agencia = $item->agencia;
            }
            
            $desEstado = Estado::where('descripcion', $estado)->get();
            foreach ($desEstado as $item) {
                $desEstado = $item->descripcion;
                $color = $item->color;
            }

            $dataEquipo = FichaTecnica::where('uid', $this->equipoUid)->get();
            foreach ($dataEquipo as $item) {
                $btu = $item->btu;
            }

            $dataAgencia = Agencia::where('descripcion', $agencia)->get();
            foreach ($dataAgencia as $item) {
                $codigo = $item->codigo;
            }

            $fecha = Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->format('dmY');
            $otUid = $fecha . '-' . $this->equipoUid . '-' . $this->tipoMantenimiento;

            $user = Auth::user();

            $ot = new Ot();

            if ($this->tipoMantenimiento == 'MP') 
            {

                $existe_ot = Ot::where('otUid', $otUid)->get();
                foreach($existe_ot as $item){
                    $total_mp = $item->total_mp;
                }
                // if(count($existe_ot) >= 1 && $total_mp < 2)
                // {
                //     DB::table('ots')
                //     ->where('otUid', $otUid)
                //     ->update([
                //         'total_ticket_cerrados' => $total_ticket_cerrados,
                //         'total_ticket_abiertos' => $total_ticket_abiertos
                //     ]);

                // }

                $ot->otUid = $otUid;
                $ot->fechaInicio = Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->format('d-m-Y');
                $ot->tecRes_NomApe = $this->datosTecRes();
                $ot->tecRes_email = $this->tecRespondable;
                $ot->equipoUid = $this->equipoUid;
                $ot->btu = $btu;
                $ot->codigo_agencia = $codigo;
                $ot->estado = $estado;
                $ot->color = $color;
                $ot->agencia = $agencia;
                $ot->tipoMantenimiento = $this->tipoMantenimiento;
                $ot->owner = $user->email;
                $ot->statusOts = '1';
                $ot->total_mp = 1;
                if($this->tikect_id != 'null' && $this->owner_tikect != 'null')
                {
                    $ot->tikect_id = $this->tikect_id;
                    $ot->owner_tikect = $this->owner_tikect;
                    $ot->estado_tikect = $this->estado_tikect;
                }
                $ot->save();

                /**
                 * @method total_mp
                 * @param $equipo_uid, $estado
                 * Logica para guardar el acumulado de los MC
                 */
                UtilsController::total_inversion_mp($ot->equipoUid, $ot->estado);
                
                /**
                 * @method total_mp
                 * @param $estado, estatus
                 * Logica para guardar el acumulado de los MC creados
                 */
                UtilsController::total_ot_mp_estatus($ot->estado, 1);
                
                $this->reset();

                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La orden de trabajo fue registrada con éxito'
                );
            }

            if ($this->tipoMantenimiento == 'MC') {

                 /**
                 * Cargamos las imagenes
                 */
                $pdf_pre_oper  = $this->pdf_pre_oper->store($otUid.'/presupuesto-operacion', 'public');
                $pdf_pre_preCli = $this->pdf_pre_preCli->store($otUid.'/presupuesto-cliente', 'public');

                $ot->otUid = $otUid;
                $ot->fechaInicio = Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->format('d-m-Y');
                $ot->tecRes_NomApe = $this->datosTecRes();
                $ot->tecRes_email = $this->tecRespondable;
                $ot->equipoUid = $this->equipoUid;
                $ot->btu = $btu;
                $ot->codigo_agencia = $codigo;
                $ot->estado = $estado;
                $ot->color = $color;
                $ot->agencia = $agencia;
                $ot->tipoMantenimiento = $this->tipoMantenimiento;
                $ot->costo_oper = $this->costo_oper;
                $ot->costo_preCli = $this->costo_preCli;
                $ot->pdf_pre_oper = $pdf_pre_oper;
                $ot->pdf_pre_preCli = $pdf_pre_preCli;
                $ot->tir = $this->porcen;
                $ot->owner = $user->email;
                $ot->statusOts = '1';
                $ot->statusOts_banco = '1';

                if($this->tikect_id != 'null' && $this->owner_tikect != 'null')
                {
                    $ot->tikect_id = $this->tikect_id;
                    $ot->owner_tikect = $this->owner_tikect;
                    $ot->estado_tikect = $this->estado_tikect;
                }

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
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Function store() - livewire.orden-trabajo'
            );
        }
    }

    public function render()
    {

        return view('livewire.view.orden-trabajo', [
            'data_mp' => Ot::where('tipoMantenimiento', 'MP')
            ->where('otUid', 'like', "%{$this->buscar}%")
            ->orderBy('id', 'desc')
            ->paginate(5),
            'data_mc' => Ot::where('tipoMantenimiento', 'MP')
            ->where('otUid', 'like', "%{$this->buscar}%")
            ->orderBy('id', 'desc')
            ->paginate(5)
        ]);
    }
}
