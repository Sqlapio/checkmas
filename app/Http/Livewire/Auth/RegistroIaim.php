<?php

namespace App\Http\Livewire\Auth;

use App\Models\Iaim_Cargo;
use App\Models\Iaim_Coordinacion;
use App\Models\Iaim_Division;
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

    public $atr_otro_cargo = 'hidden';
    public $atr_select_cargo = '';

    public $atr_otra_division = 'hidden';
    public $atr_select_division = '';

    public $atr_otra_coordinacion = 'hidden';
    public $atr_select_coordinacion = '';

    public $otro_cargo;
    public $otra_division;
    public $otra_coordinacion;

    protected $listeners = [
        'otro_cargo',
        'otra_division',
        'otra_coordinacion'
    ];

    public function otro_cargo($value)
    {
        if ($value == 'otro') {
            $this->atr_otro_cargo = '';
            $this->atr_select_cargo = 'hidden';
        } else {
            $this->atr_otro_cargo = 'hidden';
            $this->atr_select_cargo = '';
        }
    }

    public function otra_division($value)
    {
        if ($value == 'otro') {
            $this->atr_otra_division = '';
            $this->atr_select_division = 'hidden';
        } else {
            $this->atr_otra_division = 'hidden';
            $this->atr_select_division = '';
        }
    }

    public function otra_coordinacion($value)
    {
        if ($value == 'otro') {
            $this->atr_otra_coordinacion = '';
            $this->atr_select_coordinacion = 'hidden';
        } else {
            $this->atr_otra_coordinacion = 'hidden';
            $this->atr_select_coordinacion = '';
        }
    }

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

    public function eValcargo($value)
    {

        if ($value == 'Jefe de division') 
        {
            return 'Jefe de división';
        }else
        {
            return $value;
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

            /**
             * Logica para cargar el tipo de cargo
             */
            if (isset($this->otro_cargo)) {
                $resgistro->cargo = strtoupper($this->otro_cargo);
                $resgistro->rol = strtoupper($this->otro_cargo);
                $cargo = new Iaim_Cargo();
                $cargo->descripcion = $resgistro->cargo;
                $cargo->save();

            } else {
                $resgistro->cargo = $this->eValcargo($this->cargo);
                $resgistro->rol = $this->eValcargo($this->cargo);
            }

            /**
             * Logica para cargar el tipo de division
             */
            if (isset($this->otra_division)) {
                $resgistro->division = strtoupper($this->otra_division);
                $division = new Iaim_Division();
                $division->descripcion = $resgistro->division;
                $division->save();

            } else {
                $resgistro->division = $this->division;
            }

            /**
             * Logica para cargar el tipo de coordinacion
             */
            if (isset($this->otra_coordinacion)) {
                $resgistro->coordinacion = strtoupper($this->otra_coordinacion);
                $coordinacion = new Iaim_Coordinacion();
                $coordinacion->descripcion = $resgistro->coordinacion;
                $coordinacion->save();

            } else {
                $resgistro->coordinacion = $this->coordinacion;
            }

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
