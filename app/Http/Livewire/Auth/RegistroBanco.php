<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Http\Controllers\UtilsController;


class RegistroBanco extends Component
{

    use Actions;

    public $nombre;
    public $apellido;
    public $telefono;
    public $password;
    public $email;
    public $rol;
    public $agencia;
    public $estado;
    public $prefijo;
    public $terminos = false;


    public function cargo($value)
    {
        if($value == '3'){
            return 'Gerente de agencia';
        }
        if($value == '4'){
            return 'Gerente de servicios';
        }
    }


    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [

        'nombre'    => 'required',
        'apellido'  => 'required',
        'prefijo'  => 'required',
        'telefono'  => 'required',
        'email'     => 'required|email|unique:users',
        'password'  => 'required',
        'rol'       => 'required',
        'estado'    => 'required',
        'agencia'   => 'required',
        'terminos'   => 'required',

    ];

    protected $messages = [

        'nombre'             => 'Campo Requerido',
        'apellido'           => 'Campo Requerido',
        'prefijo'           => 'Campo Requerido',
        'telefono'           => 'Campo Requerido',
        'password.required'  => 'Campo Requerido',
        'email.required'     => 'Campo Requerido',
        'email.unique'       => 'El correo ya se encuentra registrado en el sistema',
        'rol'                => 'Campo Requerido',
        'estado'             => 'Campo Requerido',
        'agencia'            => 'Campo Requerido',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    private function resetInputFields()
    {

        $this->nombre = '';
        $this->apellido = '';
        $this->telefono = '';
        $this->prefijo = '';
        $this->password = '';
        $this->email = '';
        $this->rol = '';
        $this->estado = '';
        $this->agencia = '';
        $this->terminos = '';

    }


    public function store()
    {

        // Reglas de Validación
        $this->validate();

        try {



        $resgistro = new User();
        $resgistro->nombre = $this->nombre;
        $resgistro->apellido = $this->apellido;
        $resgistro->telefono = $this->prefijo.$this->telefono;
        $resgistro->email = $this->email;
        $resgistro->password = Hash::make($this->password);
        $resgistro->cargo = $this->cargo($this->rol);
        $resgistro->rol = $this->rol;
        $resgistro->estado = UtilsController::estado($this->estado);
        $resgistro->agencia = UtilsController::agencia($this->agencia);
        $resgistro->status_registro = '0';
        $resgistro->empresa = 'Banco del Tesoro';


        if($this->terminos != true)
        {

            $this->notification()->warning(
                $title = 'Validación!',
                $description = 'Debe aceptar los términos y condiciones'
            );

            $this->terminos = '';
            
        }else{
            $resgistro->save();

            $this->resetInputFields();

            session()->flash('notification', 'El usuario fue registrado de forma satisfactoria, debe esperar la aprobación del Administrador');

            redirect()->to('/');
        }
        

        } catch (\Throwable $th) {
            dd($th);
            $this->notification()->Error(
                $title = 'Excepción!',
                $description ='Error interno del sistema, Favor contacte al administrador'
            );
        }

    }

    public function render()
    {
        return view('livewire.auth.registro-banco');
    }
}
