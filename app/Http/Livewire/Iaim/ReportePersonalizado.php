<?php

namespace App\Http\Livewire\Iaim;

use App\Http\Controllers\UtilsController;
use App\Models\IaimCierreInventario;
use Barryvdh\Debugbar\Facades\Debugbar;
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

            $data_entradas = DB::table("iaim_movimiento_inventarios")
            ->select('entrada', 'fecha_entrada', 'created_at')
            ->where('codigo', $this->codigo)
            ->where('entrada', '>', 0)
            ->whereBetween('created_at', [$this->fecha_inicio_inv.' 00:00:00', $this->fecha_fin_inv.' 23:59:00'])
            ->orderBy('fecha_entrada', 'asc')
            ->get();

            $data_salidas = DB::table("iaim_movimiento_inventarios")
            ->select('salida', 'fecha_salida', 'created_at')
            ->where('codigo', $this->codigo)
            ->where('salida', '>', 0)
            ->whereBetween('created_at', [$this->fecha_inicio_inv.' 00:00:00', $this->fecha_fin_inv.' 23:59:00'])
            ->orderBy('fecha_salida', 'asc')
            ->get();

            $entradas = $data_entradas->pluck('entrada');
            $fecha_entradas = $data_entradas->pluck('fecha_entrada');

            $salidas = $data_salidas->pluck('salida');
            $fecha_salidas = $data_salidas->pluck('fecha_salida');

            Debugbar::info($data, $data_entradas, $entradas);

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
                    'Total_existencia',
                    'entradas',
                    'fecha_entradas',
                    'salidas',
                    'fecha_salidas'))->output();
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
