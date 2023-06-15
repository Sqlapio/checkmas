<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use WireUi\Traits\Actions;

class Registro extends Component
{
    use Actions;

    public $email;
    public $password;

    private function resetInputFields()
    {

        $this->email = '';
        $this->password = '';
    }

    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [

        'password' => 'required',
        'email'    => 'required|email|unique:users'

    ];

    protected $messages = [

        'password.required'  => 'Campo Requerido',
        'email.required'     => 'Campo Requerido',
        'email.unique'       => 'El correo ya se encuentra registrado en el sistema',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function store()
    {

        try {

        // Reglas de Validación
        $this->validate();

        $resgistro = new User();

        $resgistro->email = $this->email;
        $resgistro->password = Hash::make($this->password);
        // $resgistro->password = $this->password;
        $resgistro->save();

        $this->resetInputFields();

        $this->notification()->success(
            $title = 'Perfil Creado!',
            $description = 'El usuario fue registrado de forma satisfactoria'
        );


        } catch (\Throwable $th) {
            dd($th);
        }

    }
    
    public function render()
    {
        return view('livewire.auth.registro');
    }
}
