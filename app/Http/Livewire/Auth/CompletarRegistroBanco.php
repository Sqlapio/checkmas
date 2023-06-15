<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use WireUi\Traits\Actions;

class CompletarRegistroBanco extends Component
{

    use Actions;

    public $nombre;
    public $apellido;
    public $telefono;
    public $password;
    public $email;
    public $rol = '2';
    public $cargo = 'Administrador Banco';
    public $agencia;
    public $estado;
    public $terminos = false;


    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [

        'nombre'    => 'required',
        'apellido'  => 'required',
        'telefono'  => 'required',
        'email'     => 'required|email|unique:users',
        'password'  => 'required',
        'estado'    => 'required',
        'agencia'   => 'required',
        'terminos'   => 'required',

    ];

    protected $messages = [

        'nombre'             => 'Campo Requerido',
        'apellido'           => 'Campo Requerido',
        'telefono'           => 'Campo Requerido',
        'password.required'  => 'Campo Requerido',
        'email.required'     => 'Campo Requerido',
        'email.unique'       => 'El correo ya se encuentra registrado en el sistema',
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
        $this->password = '';
        $this->email = '';
        $this->estado = '';
        $this->agencia = '';
        $this->terminos = '';

    }


    public function store()
    {

        try {

        // Reglas de Validación
        $this->validate();

        $resgistro = new User();
        $resgistro->nombre = $this->nombre;
        $resgistro->apellido = $this->apellido;
        $resgistro->telefono = $this->telefono;
        $resgistro->email = $this->email;
        $resgistro->password = Hash::make($this->password);
        $resgistro->cargo = $this->cargo;
        $resgistro->rol = $this->rol;
        $resgistro->estado = $this->estado;
        $resgistro->agencia = $this->agencia;
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

            DB::table('users')
                ->where('email', 'administrador@checkmas.com')
                ->update(['rol' => 400]);

            $this->resetInputFields();

            $this->notification()->success(
                $title = 'Perfil Creado!',
                $description = 'El usuario fue registrado de forma satisfactoria'
            );
        }
        

        } catch (\Throwable $th) {
            
            $this->notification()->Error(
                $title = 'Excepción!',
                $description ='Error interno del sistema, Favor contacte al administrador'
            );
        }

    }


    public function render()
    {
        return view('livewire.auth.completar-registro-banco');
    }
}
