<?php

namespace App\Http\Livewire\Iaim;

use App\Http\Controllers\UtilsController;
use App\Models\IaimCertificacionOrdenTrabajo;
use App\Models\IaimOrdenTrabajo;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class CertificarOrdenTrabajo extends Component
{

    use Actions;

    use WithPagination;

    use WithFileUploads;

    protected $listeners = ['ot_selected'];

    public $usr_cer_nombre;
    public $usr_cer_cedula;
    public $usr_cer_cargo;
    public $usr_cer_firma;
    public $fecha_cer_ot;
    public $usr_cer_division;
    public $usr_cer_coordinacion;
    public $fecha_inicio_ot;
    public $fecha_fin_ot;
    public $codigo_ot;
    public $observaciones;
    public $can_dias;
    public $can_trabajadores;

    //Fotos
    public $foto_antes_1;
    public $foto_antes_2;
    public $foto_antes_3;
    public $foto_durante_1;
    public $foto_durante_2;
    public $foto_durante_3;
    public $foto_des_1;
    public $foto_des_2;
    public $foto_des_3;

    public $atr_tablas = 'hidden';
    public $atr_botton = '';

    public $buscar;
    public $fil_fecha_ini;
    public $fil_fecha_fin;

    public $fil_hidden = '';

    public function ot_selected($value)
    {
        try {

                $data = IaimOrdenTrabajo::where('codigo_ot', $value)->get();
                foreach($data as $item)
                {
                    $fecha_aprobacion = $item->fecha_aprobacion;
                }

                $this->fecha_inicio_ot = $fecha_aprobacion;

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function cert()
    {
        $this->atr_tablas = '';
        $this->atr_botton = 'hidden';
        $this->fil_hidden = 'hidden';
    }

    public function validateData()
    {
            $this->validate([
                'codigo_ot'     => 'required',
                'foto_antes_1'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_antes_2'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_antes_3'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_durante_1'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_durante_2'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_durante_3'  => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_des_1'      => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_des_2'      => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_des_3'      => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'fecha_fin_ot'   => 'required',
                'can_dias'   => 'required',
                'can_trabajadores'   => 'required',
                'observaciones'   => 'required',

            ]);
    }

    public function store()
    {

        $this->validateData();

        try {

                /**
                 * Logica para obtener el id de la orden de trabajo
                 */
                $data = IaimOrdenTrabajo::where('codigo_ot', $this->codigo_ot)->get();
                foreach ($data as $item) {
                    $id = $item->id;
                }

                /**
                 * Cargamos las imagenes
                 */
                $foto_antes_1 = $this->foto_antes_1->store($this->codigo_ot . '/antes', 'public');
                $foto_antes_2 = $this->foto_antes_2->store($this->codigo_ot . '/antes', 'public');
                $foto_antes_3 = $this->foto_antes_3->store($this->codigo_ot . '/antes', 'public');

                $foto_durante_1 = $this->foto_durante_1->store($this->codigo_ot . '/durante', 'public');
                $foto_durante_2 = $this->foto_durante_2->store($this->codigo_ot . '/durante', 'public');
                $foto_durante_3 = $this->foto_durante_3->store($this->codigo_ot . '/durante', 'public');

                $foto_des_1 = $this->foto_des_1->store($this->codigo_ot . '/despues', 'public');
                $foto_des_2 = $this->foto_des_2->store($this->codigo_ot . '/despues', 'public');
                $foto_des_3 = $this->foto_des_3->store($this->codigo_ot . '/despues', 'public');

                $certificacion = new IaimCertificacionOrdenTrabajo();
                $certificacion->ot_id = $id;
                $certificacion->codigo_ot = $this->codigo_ot;
                $certificacion->fecha_inicio_ot = $this->fecha_inicio_ot;
                $certificacion->fecha_fin_ot = Carbon::createFromFormat('Y-m-d', $this->fecha_fin_ot)->format('d-m-Y');
                $certificacion->fecha_cer_ot = date('d-m-Y');
                $certificacion->usr_cer_nombre = $this->usr_cer_nombre;
                $certificacion->usr_cer_cedula = $this->usr_cer_cedula;
                $certificacion->usr_cer_cargo = $this->usr_cer_cargo;
                $certificacion->usr_cer_firma = $this->usr_cer_firma;
                $certificacion->usr_cer_correo = $this->usr_cer_firma;
                $certificacion->usr_cer_division = $this->usr_cer_division;
                $certificacion->usr_cer_coordinacion = $this->usr_cer_coordinacion;
                $certificacion->can_dias = $this->can_dias;
                $certificacion->can_trabajadores = $this->can_trabajadores;
                $certificacion->foto_antes_1 = $foto_antes_1;
                $certificacion->foto_antes_2 = $foto_antes_2;
                $certificacion->foto_antes_3 = $foto_antes_3;
                $certificacion->foto_durante_1 = $foto_durante_1;
                $certificacion->foto_durante_2 = $foto_durante_2;
                $certificacion->foto_durante_3 = $foto_durante_3;
                $certificacion->foto_des_1 = $foto_des_1;
                $certificacion->foto_des_2 = $foto_des_2;
                $certificacion->foto_des_3 = $foto_des_3;
                $certificacion->observaciones = $this->observaciones;
                $certificacion->save();

                /**
                 * Actualizamos el estatus de la ordend e trabajo en su 
                 * tabla principal para eliminarla de la lista 
                 * desplegable
                 */

                UtilsController::actualiza_estatus_orden($certificacion->codigo_ot);

                $this->reset();

                    $this->notification()->success(
                        $title = 'ÉXITO!',
                        $description = 'La orden de trabajo fue certificada con éxito'
                    );
            //code...
        } catch (\Throwable $th) {
            dd($th);
            Log::error($th->getMessage());
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Function store() - livewire.iaim.certifica_orden_trabajo'
            );
        }


    }

    public function imprimir($id)
    {
        redirect()->to('/reporte/cert/ot/'.$id);

    }

    public function reset_filtros()
    {
        $this->reset(); 
    }

    
    public function render()
    {
        $user = Auth::user();

        $this->usr_cer_nombre = $user->nombre.' '.$user->apellido;
        $this->usr_cer_cedula = $user->ci_rif;
        $this->usr_cer_cargo = $user->cargo;
        $this->usr_cer_firma = $user->email;
        $this->fecha_cer_ot = date('d-m-Y H:m:s');
        $this->usr_cer_division = $user->division;
        $this->usr_cer_coordinacion = $user->coordinacion;

        $data = IaimCertificacionOrdenTrabajo::orderBy('id', 'desc')
            ->when($this->buscar, function($query, $buscar) 
            {
                return $query->where('codigo_ot', 'like', "%{$this->buscar}%")
                            ->orWhere('fecha_cer_ot', 'like', "%{$this->buscar}%")
                            ->orWhere('usr_cer_nombre', 'like', "%{$this->buscar}%")
                            ->orWhere('usr_cer_cargo', 'like', "%{$this->buscar}%")
                            ->orWhere('usr_cer_coordinacion', 'like', "%{$this->buscar}%")
                            ->orWhere('usr_cer_division', 'like', "%{$this->buscar}%");
            })
            ->when($this->fil_fecha_ini, function($query, $status) 
            {
                return $query->orwhere('fecha_inicio_ot' , Carbon::createFromFormat('Y-m-d', $this->fil_fecha_ini)->format('d-m-Y'));
            })
            ->when($this->fil_fecha_fin, function($query, $status) 
            {
                return $query->orwhere('fecha_fin_ot' , Carbon::createFromFormat('Y-m-d', $this->fil_fecha_fin)->format('d-m-Y'));
            })
            ->paginate(5);

        return view('livewire.iaim.certificar-orden-trabajo', compact('data'));
    }
}
