<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class RegistroIaim extends Component
{
    use Actions;

    use WithPagination;

    use WithFileUploads;

    public $nombre;
    public $apellido;
    public $ci_rif;
    public $cargo;
    public $division;
    public $coordinacion;
    public $email;
    public $password;
    public $firma_digital;
    public $terminos = false;

    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [

        'nombre'        => 'required',
        'apellido'      => 'required',
        'ci_rif'        => 'required',
        'cargo'         => 'required',
        'division'      => 'required',
        'coordinacion'  => 'required',
        'email'         => 'required|email|unique:users',
        'password'      => 'required',
        'terminos'      => 'required',

    ];

    protected $messages = [

        'nombre'        => 'Campo Requerido',
        'apellido'      => 'Campo Requerido',
        'ci_rif'        => 'Campo Requerido',
        'cargo'         => 'Campo Requerido',
        'division'      => 'Campo Requerido',
        'coordinacion'  => 'Campo Requerido',
        'email.required'     => 'Campo Requerido',
        'email.unique'       => 'El correo ya se encuentra registrado en el sistema',
        'password'      => 'Campo Requerido',
        'terminos'      => 'Debe estar de acuerdo con los terminos y condiciones',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rol($value)
    {
        if ($value == 'Intendente') 
        {
            return 'iaim_1';
        }
        if ($value == 'Jefe de division') 
        {
            return 'iaim_2';
        }
        if ($value == 'Contratado') 
        {
            return 'iaim_3';
        }
        if ($value == 'Director') 
        {
            return 'iaim_4';
        }
    }

    public function store()
    {

        try {

            // Reglas de Validación
            $this->validate();

            $resgistro = new User();
            $resgistro->nombre = $this->nombre;
            $resgistro->apellido = $this->apellido;
            $resgistro->ci_rif = $this->ci_rif;
            $resgistro->cargo = $this->cargo;
            $resgistro->rol = $this->rol($this->cargo);
            $resgistro->division = $this->division;
            $resgistro->coordinacion = $this->coordinacion;
            $resgistro->email = $this->email;
            $resgistro->password = Hash::make($this->password);
            $resgistro->empresa = 'IAIM';
            $resgistro->status_registro = '1';
            $resgistro->firma_digital = $this->firma_digital;

            if ($this->terminos != true) {

                $this->notification()->warning(
                    $title = 'Validación!',
                    $description = 'Debe aceptar los términos y condiciones'
                );
                $this->terminos = '';

            } else {

                $resgistro->save();

                $this->reset();

                session()->flash('notification', 'El usuario fue registrado de forma satisfactoria, debe esperar la aprobación del Administrador');
                redirect()->to('/');

            }

        } catch (\Throwable $th) {
            Log::error('Se ha producido un error al ejecutar la función.'.$th->getMessage());
            $this->notification()->Error(
                $title = 'Excepción!',
                $description = $th->getMessage()
            );
        }
    }


    public function render()
    {
        return view('livewire.auth.registro-iaim');
    }
}
