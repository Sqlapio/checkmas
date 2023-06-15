<?php

namespace App\Http\Livewire\View;

use Livewire\Component;

class PrintOt extends Component
{
    public $ppp;

    protected $listeners = [
        'e'
    ];

    public function e($equipoUid)
    {

        dd($equipoUid);
    
    }

    public function render()
    {
        return view('livewire.view.print-ot');
    }
}
