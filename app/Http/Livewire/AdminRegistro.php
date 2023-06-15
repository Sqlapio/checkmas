<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AdminRegistro extends Component
{
    public $nombre;
    public $email;
    public $password;

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->email = '';
        $this->password = '';
    }

    /**
     * Reglas de validación para todos los campos del formulario
     */
    protected $rules = [

        'nombre'   => 'required',
        'password' => 'required',
        'email'    => 'required|email|unique:users'

    ];

    protected $messages = [

        'nombre.required'    => 'Campo Requerido',
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
        // dd(Hash::make($this->password));

        try {

        // Reglas de Validación
        $this->validate();

        $resgistro = new User();

        $resgistro->name = $this->nombre;
        $resgistro->email = $this->email;
        $resgistro->password = Hash::make($this->password);

        $resgistro->save();

        $this->resetInputFields();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'La Información Personal - Registro Exitoso!'
        ]); 


        } catch (\Throwable $th) {
            dd($th);
        }

    }







    public function render()
    {
        return view('livewire.admin-registro');
    }
}
