<?php

namespace App\Http\Livewire\View;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Crypt;

class RecuperarPassword extends Component
{

    use Actions;
    
    public $email;
    public $password;


    public function recuperar_pass()
    {
        try {

            $secret = bcrypt($this->password);

            /**
             * Consultamos si el usuario existe en la base de datos
             */

            $user = User::where('email', $this->email)->count();
            if ($user != 0) {
                $affected = DB::table('users')
                ->where('email', $this->email)
                    ->update(['password' => $secret]);
                    session()->flash('notification', 'La contraseña fue cambiada con éxito');
                    redirect()->to('/');
            } else {
                $this->notification()->error(
                    $title = 'ÉXITO!',
                    $description = 'El correo electrónico no coincide con el registrado en nuestra data'
                );
                return back();
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }



    public function render()
    {
        return view('livewire.view.recuperar-password');
    }
}
