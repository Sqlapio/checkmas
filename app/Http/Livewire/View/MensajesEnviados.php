<?php

namespace App\Http\Livewire\View;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\MensajeEnviado as ModelsMensajeEnviado;
use App\Models\MensajeRecibido;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MensajesEnviados extends Component
{
    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $buscar;
    public $mensajes;
    public $emisor;
    public $receptor;
    public $asunto;
    public $mensaje;
    public $atr_formulario = 'hidden';
    public $atr_grid_enviados = '';
    public $atr_botton = '';

    public function validateData()
    {
        $this->validate([
            'receptor' => 'required',
            'asunto'   => 'required',
            'mensaje'   => 'required',
        ]);
    }

    protected $messages = [
        'emisor.required'   => 'Campo Requerido',
        'receptor.required' => 'Campo Requerido',
        'asunto.required'   => 'Campo Requerido',
        'mensaje.required'   => 'Campo Requerido',
    ];

    public function ocultar_grid()
    {
        $this->atr_grid_enviados = 'hidden';
        $this->atr_botton = 'hidden';

        $this->atr_formulario = '';
    }

    public function store()
    {
        $this->validateData();

        try {

            $user = Auth::user();

            /**
             * Logica para guardar la informacion del emisor
             */
            $mensaje = new ModelsMensajeEnviado();
            $mensaje->emisor = $user->email;
            $mensaje->fecha_envio = date('d-m-Y h:m:s a');
            $mensaje->receptor = $this->receptor;
            $mensaje->asunto = $this->asunto;
            $mensaje->mensaje = $this->mensaje;
            $mensaje->estatus = '1';
            $mensaje->save();

            if($mensaje->save())
            {
            /**
             * Logica para guardar la informacion del receptor
             */
                $mensaje_receptor = new MensajeRecibido();
                $mensaje_receptor->emisor = $user->email;
                $mensaje_receptor->receptor = $this->receptor;
                $mensaje_receptor->fecha_recibido = $mensaje->fecha_envio;
                $mensaje_receptor->asunto = $this->asunto;
                $mensaje_receptor->estatus = '1';
                $mensaje_receptor->mensaje = $this->mensaje;
                $mensaje_receptor->save();
            }
            else{
                $this->reset();
                $this->notification()->error(
                    $title = 'ERROR!',
                    $description = 'No se pudo guardar la informacion del receptor, contacte con el Administrador'
                );
            }
  
            $this->reset();

            $this->notification()->success(
                $title = 'ÉXITO!',
                $description = 'El mensaje fue enviado a: '.$mensaje->receptor.' de forma exitosa'
            );

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.view.mensajes-enviados', [

            'data' => ModelsMensajeEnviado::where('emisor', Auth::user()->email)
                    ->Where('receptor', 'like', "%{$this->buscar}%")
                    ->Where('asunto', 'like', "%{$this->buscar}%")
                    ->Where('mensaje', 'like', "%{$this->buscar}%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(5)
        ]);
    }
}
