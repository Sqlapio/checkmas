<?php

namespace App\Http\Livewire\View;

use App\Models\MensajeEnviado;
use Livewire\Component;
use App\Models\MensajeRecibido as ModelsMensajeRecibido;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MensajesRecibidos extends Component
{
    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $buscar;
    public $atr_form_respuesta = 'hidden';
    public $atr_table_recibidos = '';
    public $respuesta;
    public $res_id;
    public $res_para;
    public $res_enviado;
    public $res_asunto;
    public $res_mensaje;

    public function acciones($id, $accion)
    {
        if($accion == '1')
        {
            $data = ModelsMensajeRecibido::find($id)->estatus;

            if($data == '2')
            {
                $this->notification()->warning(
                    $title = 'NOTIFICACION!',
                    $description = 'El mensaje ya se encuentra marcado como leido'
                );
            }else{
                try {
                    DB::table('mensaje_enviados')
                    ->where('id', $id)
                        ->update([
                            'fecha_leido' => date('d-m-Y h:m:s a'),
                            'estatus' => '2',
                        ]);
                    
                    DB::table('mensaje_recibidos')
                    ->where('id', $id)
                        ->update([
                            'estatus' => '2', /* El estatus 2 significa que fue marcado como leido */
                        ]);
                    
                        $this->notification()->success(
                            $title = 'ÉXITO!',
                            $description = 'Mensaje marcado como leido'
                        );
    
                } catch (\Throwable $th) {
                    dd($th);
                }
            }
            
        }

        if($accion == '2')
        {
           $data = MensajeEnviado::find($id);
           $this->res_id = $id;
           $this->res_para = $data->emisor;
           $this->res_enviado = $data->fecha_envio;
           $this->res_asunto = $data->asunto;
           $this->res_mensaje = $data->mensaje;
           $this->atr_form_respuesta = '';
           $this->atr_table_recibidos = 'hidden';
        }

        if($accion == '3')
        {
            try {
                DB::table('mensaje_recibidos')
                ->where('id', $id)
                    ->update([
                        'estatus' => '3', /* El estatus 3 significa que fue eliminado de la bandeja */
                    ]);
                
                    $this->notification()->success(
                        $title = 'ÉXITO!',
                        $description = 'El mensaje eliminado de su bandeja de entrada'
                    );

            } catch (\Throwable $th) {
                dd($th);
            }
        }
    }

    public function respuesta($id)
    {

        try {

            DB::table('mensaje_enviados')
            ->where('id', $id)
                ->update([
                    'fecha_respuesta' => date('d-m-Y h:m:s a'),
                    'respuesta' => $this->respuesta,
                    'estatus' => '3',
                ]);
            
            DB::table('mensaje_recibidos')
            ->where('id', $id)
                ->update([
                    'fecha_respuesta' => date('d-m-Y h:m:s a'),
                    'estatus' => '3',
                ]);
            
                $this->reset();
                $this->notification()->success(
                    $title = 'ÉXITO!',
                    $description = 'La respuesta fue enviada de forma exitosa'
                );

        } catch (\Throwable $th) {
            dd($th);
        }

    }


    public function render()
    {
        return view('livewire.view.mensajes-recibidos', [

            'data' => ModelsMensajeRecibido::where('receptor', Auth::user()->email)
                    ->Where('emisor', 'like', "%{$this->buscar}%")
                    ->Where('asunto', 'like', "%{$this->buscar}%")
                    ->Where('mensaje', 'like', "%{$this->buscar}%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(5)
        ]);
    }
}
