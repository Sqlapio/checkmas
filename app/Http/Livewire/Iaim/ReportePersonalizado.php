<?php

namespace App\Http\Livewire\Iaim;

use App\Http\Controllers\UtilsController;
use App\Models\IaimCierreInventario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReportePersonalizado extends Component
{
    public $buscar;
    public $fecha_inicio_inv;
    public $fecha_fin_inv;
    public $fecha_inicio_ot;
    public $fecha_fin_ot;
    public $codigo;
    public $estatus;

    public function genera_reporte_inv(){
        // UtilsController::reporte_per_articulo($this->fecha_inicio, $this->fecha_fin, $this->codigo);
        try {
            $data = DB::table("iaim_movimiento_inventarios")
            ->select(DB::raw("SUM(entrada) as total_mov_ent"),
                    DB::raw("SUM(salida) as total_mov_sal"), 
                    DB::raw("codigo as codigo"), 'descripcion',
                    DB::raw("SUM(entrada) - SUM(salida) as Total_existencia"))
            ->where('codigo', $this->codigo)
            ->whereBetween('created_at', [$this->fecha_inicio_inv.' 00:00:00', $this->fecha_fin_inv.' 23:59:00'])
            ->groupBy(['codigo', 'descripcion'])
            ->get();

            foreach ($data as $item) {
                $total_mov_ent      = $item->total_mov_ent;
                $total_mov_sal      = $item->total_mov_sal;
                $Total_existencia   = $item->Total_existencia;
                $descripcion        = $item->descripcion;
            }

            $totales = [$total_mov_ent, $total_mov_sal, $Total_existencia];
            $fecha_ini_inv = $this->fecha_inicio_inv;
            $fecha_fin_inv = $this->fecha_fin_inv;

            $pdf = Pdf::loadView('pdf.reporte_mov_inv', 
            compact('totales', 
                    'descripcion', 
                    'fecha_ini_inv', 
                    'fecha_fin_inv', 
                    'total_mov_ent',
                    'total_mov_sal',
                    'Total_existencia'))->output();
            return response()->streamDownload(
                fn () => print($pdf),
                "filename.pdf"
           );

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function genera_reporte_ot(){
        UtilsController::reporte_per_ot($this->fecha_inicio, $this->fecha_fin, $this->estatus);
    }

    public function render()
    {

        return view('livewire.iaim.reporte-personalizado');
        
    }
}
