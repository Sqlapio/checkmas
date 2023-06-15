<?php

namespace App\Http\Livewire\View;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Ot;
use App\Models\User;
use Carbon\Carbon;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class CrearOtModal extends Component
{

    use WithFileUploads;

    public $atr_showModal = 'hidden';

    public $otUid;
    public $tikect_id;
    public $owner_tikect;
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

    public $atr = 'hidden';

    public $porcen = '';

    protected $listeners = [
        'selection',
        'formatMonto',
        'calc',
        'showOtModal'
    ];

    

    public function closeModal(){
        $this->atr_showModal = 'hidden';
    }

    public function showOtModal($id){
        $this->atr_showModal = '';
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
        // $calc = (($this->costo_oper * 100)/$this->costo_preCli)/100;
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

        'fechaInicio.required'          => 'Campo Requerido',
        'tecRespondable.required'       => 'Campo Requerido',
        'equipoUid.required'            => 'Campo Requerido',
        'tipoMantenimiento.required'    => 'Campo Requerido',
        'costo_oper.required'           => 'Campo Requerido',
        'costo_preCli.required'         => 'Campo Requerido',
        'pdf_pre_oper.required'         => 'Documento Requerido',
        'pdf_pre_preCli.required'       => 'Documento Requerido',


    ];

    public function store()
    {

        $this->validateData();

        try {

            $fecha = Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->format('dmY');
            $otUid = $fecha . '-' . $this->equipoUid . '-' . $this->tipoMantenimiento;

            $user = Auth::user();

            $ot = new Ot();

            if ($this->tipoMantenimiento == 'MP') {

                $ot->otUid = $otUid;
                $ot->fechaInicio = Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->format('d-m-Y');
                $ot->tecRes_NomApe = $this->datosTecRes();
                $ot->tecRes_email = $this->tecRespondable;
                $ot->equipoUid = $this->equipoUid;
                $ot->tipoMantenimiento = $this->tipoMantenimiento;
                $ot->owner = $user->email;
                $ot->statusOts = '1';
                $ot->save();

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
                $ot->tipoMantenimiento = $this->tipoMantenimiento;
                $ot->costo_oper = $this->costo_oper;
                $ot->costo_preCli = $this->costo_preCli;
                $ot->pdf_pre_oper = $pdf_pre_oper;
                $ot->pdf_pre_preCli = $pdf_pre_preCli;
                $ot->tir = $this->porcen;
                $ot->owner = $user->email;
                $ot->statusOts = '1';
                $ot->statusOts_banco = '1';
                $ot->save();

                $this->reset();

                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La orden de trabajo fue registrada con éxito'
                );
            }
        } catch (\Throwable $th) {
            dd($th);
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Function store() - livewire.orden-trabajo'
            );
        }
    }


    public function render()
    {
        return view('livewire.view.crear-ot-modal');
    }
}
