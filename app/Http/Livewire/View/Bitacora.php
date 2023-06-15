<?php

namespace App\Http\Livewire\View;

use Livewire\Component;
use App\Models\Agencia;
use App\Models\Bitacora as ModelsBitacora;
use App\Models\Estado;
use App\Models\FichaTecnica;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Ot;
use App\Models\Tikect;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class Bitacora extends Component
{

    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $tipo_fotos;
    public $atr_fotos;
    public $nro_ot;
    public $foto1;
    public $foto2;
    public $observaciones;
    public $atr_obser = 'hidden';

    public $atr_form = 'hidden';
    public $atr_table = '';

    public $buscar;



    protected $listeners = [
        'selection'
    ];

    public function selection($value)
    {
        $this->atr_fotos = $value;
 
    }

    public function view()
    {
        $this->atr_form = '';
        $this->atr_table = 'hidden';
    }

    public function validateData()
    {

        if ($this->tipo_fotos == 'antes') {
            $this->validate([
                'nro_ot'  => 'required',
                'foto1'   => 'required|file|mimes:jpg,jpeg,png|max:3072',
                'foto2'   => 'required|file|mimes:jpg,jpeg,png|max:3072',
            ]);
        }

        if ($this->tipo_fotos == 'despues') {
            $this->validate([
                'nro_ot'         => 'required',
                'foto1'          => 'required|file|mimes:jpg,jpeg,png|max:3072',
                'foto2'          => 'required|file|mimes:jpg,jpeg,png|max:3072',
                'observaciones'  => 'required',
            ]);
        }

        if ($this->tipo_fotos == '') {
            $this->validate([
                'tipo_fotos' => 'required',
            ]);
        }
    }

    protected $messages = [

        'nro_ot.required'     => 'Campo Requerido',
        'tipo_fotos.required' => 'Campo Requerido',
        'foto1.required'      => 'Campo Requerido',
        'foto2.required'      => 'Campo Requerido',
        'foto1.mimes'         => 'El formato del archivo no esta permitido',
        'foto2.mimes'         => 'El formato del archivo no esta permitido',
        'foto1.max'           => 'El tamaño de la foto no es permitido',
        'foto2.max'           => 'El tamaño de la foto no es permitido',
        'observaciones'       => 'Campo requerido',

    ];


    public function store()
    {

        $this->validateData();

        try {

            $user = Auth::user()->email;

            $data = Ot::where('otUid', $this->nro_ot)->get();
            foreach($data as $item){
                $agencia = $item->agencia;
                $estado = $item->estado;
            }

            $bitacora = new ModelsBitacora();

            if ($this->tipo_fotos == 'antes') {

                /**
                 * Cargamos las fotos
                 */
                $foto1_antes  = $this->foto1->store($this->nro_ot.'/antes', 'public');
                $foto2_antes  = $this->foto2->store($this->nro_ot.'/antes', 'public');

                $bitacora->nro_ot = $this->nro_ot;
                $bitacora->agencia = $agencia;
                $bitacora->estado = $estado;
                $bitacora->tipo_fotos = $this->tipo_fotos;
                $bitacora->foto1_antes = $foto1_antes;
                $bitacora->foto2_antes = $foto2_antes;
                $bitacora->observaciones_antes = $this->observaciones;
                $bitacora->tecnico = $user;
                $bitacora->save();

                $this->reset();

                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La fotos fueron cargadas con exito'
                );
            }

            if ($this->tipo_fotos == 'despues') {
                // dd($this->observaciones);
                /**
                 * Cargamos las fotos
                 */
                $foto1_despues  = $this->foto1->store($this->nro_ot.'/despues', 'public');
                $foto2_despues  = $this->foto2->store($this->nro_ot.'/despues', 'public');

                ModelsBitacora::updateOrCreate(
                    ['nro_ot' => $this->nro_ot],
                    [
                        'tipo_fotos'        => $this->tipo_fotos,
                        'foto1_despues'     => $foto1_despues,
                        'foto2_despues'     => $foto2_despues,
                        'observaciones' => $this->observaciones,
                        'tecnico'           => $user,

                    ]
                );

                $this->reset();

                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La fotos fueron cargadas con exito'
                );
            }
        } catch (\Throwable $th) {
            dd($th);
            $this->notification()->error(
                $title = 'ERROR!',
                $description = 'Function store() - livewire.bitacora'
            );
        }
    }

    public function render()
    {
        return view('livewire.view.bitacora',  [
            'data' => ModelsBitacora::where('tecnico', Auth::user()->email)
                ->orderBy('id', 'desc')
                ->orWhere('nro_ot', 'like', "%{$this->buscar}%")
                ->paginate(5)
        ]);
    }
}
