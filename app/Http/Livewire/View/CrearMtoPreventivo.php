<?php

namespace App\Http\Livewire\View;

use App\Http\Controllers\UtilsController;
use App\Models\Agencia;
use App\Models\FichaTecnica;
use App\Models\Ot;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class CrearMtoPreventivo extends Component
{
    use Actions;

    use WithPagination;

    public $buscar;
    public $fechaInicio;
    public $tecRespondable;

    public $equipos = [];


    public function reset_filtros()
    {
        $this->reset(); 
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

    public function store()
    {
        $lista_equipos = [];
        $user = Auth::user();

        for ($i = 0; $i < count($this->equipos); $i++) {

            /**
             * Logica para generar el mp al momento de crear el equipo
             */

            $data_equipo = FichaTecnica::where('uid', $this->equipos[$i])->get();
            foreach ($data_equipo as $item) {
                $btu = $item->btu;
                $agencia = $item->agencia;
                $estado = $item->estado;
                $totalMp = $item->total_mp;
            }

            $cod_agencia = Agencia::where('descripcion', $agencia)->get();
            foreach ($cod_agencia as $item) {
                $cod = $item->codigo;
            }

            $fecha = date('dmY');
            $otUid = $fecha . '-' . $this->equipos[$i] . '-MP';

            $ot = new Ot();
            $ot->otUid = $otUid;
            $ot->fechaInicio = date('d-m-Y');
            $ot->tecRes_NomApe = $this->datosTecRes();
            $ot->tecRes_email = $this->tecRespondable;
            $ot->equipoUid = $this->equipos[$i];
            $ot->btu = $btu;
            $ot->codigo_agencia = $cod;
            $ot->estado = $estado;
            $ot->agencia = $agencia;
            $ot->tipoMantenimiento = 'MP';
            $ot->owner = $user->email;
            $ot->statusOts = '1';
            $ot->total_mp = '2';
            $ot->save();

            /**
             * Funcion para actualizar el contador de 
             * MP en la ficha tecnica
             */
            DB::table('ficha_tecnicas')
                ->where('uid', $this->equipos[$i])
                ->update([
                    'total_mp' => '2',
                ]);

            /**
             * @method total_mp
             * @param $equipo_uid, $estado
             * Logica para guardar el acumulado de los MC
             */
            UtilsController::total_inversion_mp($this->equipos[$i], $ot->estado);

            /**
             * @method total_mp
             * @param $estado, estatus
             * Logica para guardar el acumulado de los MC creados
             */
            UtilsController::total_ot_mp_estatus($ot->estado, 1);

            array_push($lista_equipos, $this->equipos[$i]);
            
        }

        $this->notification()->success(
            $title = 'ÉXITO!',
            $description = 'Las ordenes de trabajo fueron creadas con exito. Equipos asociados: </br>'.implode("</br>", $lista_equipos)
        );

        $this->reset();
    }

    public function render()
    {
        return view('livewire.view.crear-mto-preventivo',[
            // 'data' => Ot::where('tipoMantenimiento', 'MP')
            //     ->Where('total_mp', '1')
            //     ->Where('equipoUid', 'like', "%{$this->buscar}%")
            //     ->orderBy('id', 'desc')
            //     ->paginate(8)
             'data' => FichaTecnica::Where('total_mp', '1')
                ->Where('uid', 'like', "%{$this->buscar}%")
                ->orderBy('id', 'desc')
                ->paginate(8)
        ]);
    }
}
