<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Agencia;
use App\Models\Estado;
use App\Models\FichaTecnica as ModelFichaTecnica;
use App\Models\Ot;
use App\Models\Qr;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class FichaTecnica extends Component
{

    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $qrConden;
    public $tipoConden;
    public $voltaje;
    public $phases;
    public $tipoRefri;
    public $btu;
    public $tipoCompresor;
    public $marcaCompresor;
    public $ampCompresor;
    public $imgPlacaCompresor;
    public $tipoVentilador;
    public $imgEtiqVentilador;
    public $qrEvaporador;
    public $imgEvaporador;
    public $oficina;
    public $piso;
    public $agencia;
    public $otroServicio;
    public $otroTipoRefri;
    public $otroBtu;
    public $tecRespondable;

    


    public $buscar;
    public $atr = '';
    public $label = '';
    public $atr_form = 'hidden';
    public $atr_table = '';
    public $atr_otro_servicio = 'hidden';
    public $atr_otro_tipo_refri = 'hidden';
    public $atr_otro_btu = 'hidden';
    public $atr_select_tipo_sistema = '';
    public $atr_select_tipo_refri = '';
    public $atr_select_tipo_btu = '';

    protected $listeners = [
        'tipo_servicio',
        'otro_tipo_refri',
        'otro_btu',
    ];

    public function viewForm()
    {
        $this->atr_form = '';
        $this->atr_table = 'hidden';
    }

    public function tipo_servicio($value)
    {
        if ($value == 'compacto') {
            $this->atr = 'hidden';
        }

        if ($value != 'compacto') {
            $this->atr = '';
            $this->label = $value;
        }

        if ($value == 'otro') {
            $this->atr_otro_servicio = '';
            $this->atr_select_tipo_sistema = 'hidden';
        } else {
            $this->atr_otro_servicio = 'hidden';
            $this->atr_select_tipo_sistema = '';
        }
    }

    public function otro_tipo_refri($value)
    {
        if ($value == 'otro') {
            $this->atr_otro_tipo_refri = '';
            $this->atr_select_tipo_refri = 'hidden';
        } else {
            $this->atr_otro_tipo_refri = 'hidden';
            $this->atr_select_tipo_refri = '';
        }
    }

    public function otro_btu($value)
    {
        if ($value == 'otro') {
            $this->atr_otro_btu = '';
            $this->atr_select_tipo_btu = 'hidden';
        } else {
            $this->atr_otro_btu = 'hidden';
            $this->atr_select_tipo_btu = '';
        }
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

    public function validateData()
    {
        if ($this->tipoConden == 'compacto') {
            $this->validate([
                'qrConden'  => 'required',
                'tipoConden'  => 'required',
                'voltaje'  => 'required',
                'phases'  => 'required',
                'tipoRefri'  => 'required',
                'btu'  => 'required',
                'tipoCompresor'  => 'required',
                'marcaCompresor'  => 'required',
                'ampCompresor'  => 'required',
                'imgPlacaCompresor'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'tipoVentilador'  => 'required',
                'imgEtiqVentilador'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'oficina'  => 'required',
                'piso'  => 'required',
                'agencia'  => 'required',
            ]);
        }

        if ($this->tipoConden != 'compacto') {
            $this->validate([
                'qrConden'  => 'required',
                'tipoConden'  => 'required',
                'voltaje'  => 'required',
                'phases'  => 'required',
                'tipoRefri'  => 'required',
                'btu'  => 'required',
                'tipoCompresor'  => 'required',
                'marcaCompresor'  => 'required',
                'ampCompresor'  => 'required',
                'imgPlacaCompresor'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'tipoVentilador'  => 'required',
                'imgEtiqVentilador'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'qrEvaporador'  => 'required',
                'imgEvaporador'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'oficina'  => 'required',
                'piso'  => 'required',
                'agencia'  => 'required',

            ]);
        }
    }

    private function resetInputFields()
    {
        $this->qrConden = '';
        $this->tipoConden = '';
        $this->voltaje = '';
        $this->phases = '';
        $this->tipoRefri = '';
        $this->btu = '';
        $this->tipoCompresor = '';
        $this->marcaCompresor = '';
        $this->ampCompresor = '';
        $this->imgPlacaCompresor = '';
        $this->tipoVentilador = '';
        $this->imgEtiqVentilador = '';
        $this->qrEvaporador = '';
        $this->imgEvaporador = '';
        $this->oficina = '';
        $this->piso = '';
        $this->agencia = '';
    }

    protected $messages = [

        'qrConden.required'          => 'Campo Requerido',
        'tipoConden.required'        => 'Campo Requerido',
        'voltaje.required'           => 'Campo Requerido',
        'phases.required'            => 'Campo Requerido',
        'tipoRefri.required'         => 'Campo Requerido',
        'btu.required'               => 'Campo Requerido',
        'tipoCompresor.required'     => 'Campo Requerido',
        'marcaCompresor.required'    => 'Campo Requerido',
        'ampCompresor.required'      => 'Campo Requerido',
        'imgPlacaCompresor.required' => 'Campo Requerido',
        'tipoVentilador.required'    => 'Campo Requerido',
        'imgEtiqVentilador.required' => 'Campo Requerido',
        'qrEvaporador.required'      => 'Campo Requerido',
        'imgEvaporador.required'     => 'Campo Requerido',
        'oficina.required'           => 'Campo Requerido',
        'piso.required'              => 'Campo Requerido',
        'imgPlacaCompresor.mimes'    => 'El formato del archivo no esta permitido',
        'imgEtiqVentilador.mimes'    => 'El formato del archivo no esta permitido',
        'imgEvaporador.mimes'        => 'El formato del archivo no esta permitido',

    ];

    public function store()
    {

        $this->validateData();

        try {

            $user = Auth::user();

            $fichaTecnica = new ModelFichaTecnica();

            $desAgencia = Agencia::where('codigo', $this->agencia)->get();
            foreach ($desAgencia as $item) {
                $agenciaDes = $item->descripcion;
                $estadoDes = $item->estado;
                $color = $item->color;
                $codigo_estado = $item->codigo_estado;
            }

            $qrs = new Qr();

            if ($this->tipoConden == 'compacto') 
            {

                $uidFt = DB::table('ficha_tecnicas')->latest("id")->first();

                if ($uidFt == NULL) {
                    $fichaTecnica->uid = $this->agencia . '-' . $codigo_estado . '-1';
                } else {
                    $tercerTer = $uidFt->id * 10;
                    $fichaTecnica->uid = $this->agencia . '-' . $codigo_estado . '-' . $tercerTer;
                }

                /**
                 * Cargamos las imagenes
                 */
                $img_compresor = $this->imgPlacaCompresor->store($this->qrConden . '/compresor', 'public');
                $img_ventilador = $this->imgEtiqVentilador->store($this->qrConden . '/ventilador', 'public');

                $fichaTecnica->qrConden     = $this->qrConden;
                $fichaTecnica->tipoConden   = $this->tipoConden;
                $fichaTecnica->voltaje      = $this->voltaje;
                $fichaTecnica->phases       = $this->phases;
                /**
                 * Lógica para guardar el tipo de refrigerante
                 * según la selección del usuario
                 */
                if (isset($this->otroTipoRefri)) {
                    $fichaTecnica->tipoRefri   = Str::lower($this->otroTipoRefri);
                } else {
                    $fichaTecnica->tipoRefri = Str::lower($this->tipoRefri);
                }

                /**
                 * Lógica para guardar el tipo de BTU
                 * según la selección del usuario
                 */
                if (isset($this->otroBtu)) {
                    $fichaTecnica->btu = preg_replace('/[^0-9]/', '', $this->otroBtu);
                } else {
                    $fichaTecnica->btu = $this->btu;
                }
                $fichaTecnica->costo = $fichaTecnica->btu * 131.61;
                $fichaTecnica->tipoCompresor    = $this->tipoCompresor;
                $fichaTecnica->marcaCompresor   = $this->marcaCompresor;
                $fichaTecnica->ampCompresor     = $this->ampCompresor;
                $fichaTecnica->imgPlacaCompresor    = $img_compresor;
                $fichaTecnica->tipoVentilador       = $this->tipoVentilador;
                $fichaTecnica->imgEtiqVentilador    = $img_ventilador;
                $fichaTecnica->oficina      = $this->oficina;
                $fichaTecnica->piso         = $this->piso;
                $fichaTecnica->agencia      = $agenciaDes;
                $fichaTecnica->estado       = $estadoDes;
                $fichaTecnica->total_mp       = '1';
                $fichaTecnica->save();

                /**
                 * Logia para colocar el CodigoQR seleccionado
                 * como asignado
                 */
                DB::table('qrs')
                    ->where('codigo', $fichaTecnica->qrConden)
                    ->update(['asignado' => 1]);

                // NOTIFICACION VALIDA
                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La ficha técnica fue registrada con éxito'
                );
            }

            if ($this->tipoConden != 'compacto') 
            {

                $uidFt = DB::table('ficha_tecnicas')->latest("id")->first();

                if ($uidFt == NULL) {
                    $fichaTecnica->uid = $this->agencia . '-' . $codigo_estado . '-1';
                } else {
                    $tercerTer = $uidFt->id * 10;
                    $fichaTecnica->uid = $this->agencia . '-' . $codigo_estado . '-' . $tercerTer;
                }

                /**
                 * Cargamos las imagenes
                 */
                $img_compresor  = $this->imgPlacaCompresor->store($this->qrConden . '/compresor', 'public');
                $img_ventilador = $this->imgEtiqVentilador->store($this->qrConden . '/ventilador', 'public');
                $img_evaporador = $this->imgEvaporador->store($this->qrEvaporador . '/evaporador', 'public');

                $fichaTecnica->qrConden = $this->qrConden;

                if (isset($this->otroServicio)) {
                    $fichaTecnica->tipoConden   = Str::lower($this->otroServicio);
                } else {
                    $fichaTecnica->tipoConden = Str::lower($this->tipoConden);
                }
                $fichaTecnica->voltaje = $this->voltaje;
                $fichaTecnica->phases = $this->phases;
                /**
                 * Lógica para guardar el tipo de refrigerante
                 * según la selección del usuario
                 */
                if (isset($this->otroTipoRefri)) {
                    $fichaTecnica->tipoRefri   = Str::lower($this->otroTipoRefri);
                } else {
                    $fichaTecnica->tipoRefri = Str::lower($this->tipoRefri);
                }

                /**
                 * Lógica para guardar el tipo de BTU
                 * según la selección del usuario
                 */
                if (isset($this->otroBtu)) {
                    $fichaTecnica->btu = preg_replace('/[^0-9]/', '', $this->otroBtu);
                } else {
                    $fichaTecnica->btu = $this->btu;
                }
                $fichaTecnica->costo = $fichaTecnica->btu * 131.61;
                $fichaTecnica->tipoCompresor = $this->tipoCompresor;
                $fichaTecnica->marcaCompresor = $this->marcaCompresor;
                $fichaTecnica->ampCompresor = $this->ampCompresor;
                $fichaTecnica->imgPlacaCompresor = $img_compresor;
                $fichaTecnica->tipoVentilador = $this->tipoVentilador;
                $fichaTecnica->imgEtiqVentilador = $img_ventilador;
                $fichaTecnica->qrEvaporador = $this->qrEvaporador;
                $fichaTecnica->imgEvaporador = $img_evaporador;
                $fichaTecnica->oficina = $this->oficina;
                $fichaTecnica->piso = $this->piso;
                $fichaTecnica->agencia      = $agenciaDes;
                $fichaTecnica->estado       = $estadoDes;
                $fichaTecnica->total_mp       = '1';
                $fichaTecnica->save();

                /**
                 * Logia para colocar el CodigoQR seleccionado
                 * como asignado
                 */
                DB::table('qrs')
                    ->where('codigo', $fichaTecnica->qrConden)
                    ->update(['asignado' => 1]);

                DB::table('qrs')
                    ->where('codigo', $fichaTecnica->qrEvaporador)
                    ->update(['asignado' => 1]);

                // NOTIFICACION VALIDA
                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La ficha técnica fue registrada con éxito'
                );
            }


            /**
             * Logica para generar el mp al momento de crear el equipo
             */

            $fecha = date('dmY');
            $otUid = $fecha . '-' . $fichaTecnica->uid . '-MP';

            $ot = new Ot();
            $ot->otUid = $otUid;
            $ot->fechaInicio = date('d-m-Y');
            $ot->tecRes_NomApe = $this->datosTecRes();
            $ot->tecRes_email = $this->tecRespondable;
            $ot->equipoUid = $fichaTecnica->uid;
            $ot->btu = $fichaTecnica->btu;
            $ot->codigo_agencia = $this->agencia;
            $ot->estado = $fichaTecnica->estado;
            $ot->color = $color;
            $ot->agencia = $fichaTecnica->agencia;
            $ot->tipoMantenimiento = 'MP';
            $ot->owner = $user->email;
            $ot->statusOts = '1';
            $ot->total_mp = 1;
            $ot->save();

            /**
             * @method total_mp
             * @param $equipo_uid, $estado
             * Logica para guardar el acumulado de los MC
             */
            UtilsController::total_inversion_mp($fichaTecnica->uid, $ot->estado);

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

        } catch (\Throwable $th) {
            dd($th);
            Log::error($th->getMessage());
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Function store() - livewire.ficha-tecnica'
            );
        }
    }



    public function render()
    {
        return view('livewire.view.ficha-tecnica', [
            'data' => ModelFichaTecnica::where('uid', 'like', "%{$this->buscar}%")
                ->orWhere('tipoConden', 'like', "%{$this->buscar}%")
                ->orWhere('qrConden', 'like', "%{$this->buscar}%")
                ->orWhere('qrEvaporador', 'like', "%{$this->buscar}%")
                ->orWhere('phases', 'like', "%{$this->buscar}%")
                ->orWhere('voltaje', 'like', "%{$this->buscar}%")
                ->orWhere('tipoRefri', 'like', "%{$this->buscar}%")
                ->orWhere('btu', 'like', "%{$this->buscar}%")
                ->orWhere('tipoCompresor', 'like', "%{$this->buscar}%")
                ->orWhere('marcaCompresor', 'like', "%{$this->buscar}%")
                ->orWhere('ampCompresor', 'like', "%{$this->buscar}%")
                ->orderBy('id', 'desc')
                ->paginate(5)
        ]);
    }
}
