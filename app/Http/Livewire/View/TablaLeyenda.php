<?php

namespace App\Http\Livewire\View;

use App\Models\Ot;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaLeyenda extends Component
{
    public function render()
    {
        return view('livewire.view.tabla-leyenda', [
            'data' => $porList = Ot::select(DB::raw("sum(costo_preCli) as totales"), DB::raw("estado as estados"), DB::raw("color as colores"))
            ->where('tipoMantenimiento', 'MC')
            ->where('statusOts', 5)
            ->orderBy('estados', 'asc')
            ->groupBy(DB::raw("estado, color"))
            ->paginate(5)
        ]);
    }
}
