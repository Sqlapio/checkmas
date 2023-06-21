<?php

namespace App\Http\Livewire\Iaim;

use App\Http\Controllers\UtilsController;
use App\Models\IaimCierreInventario;
use App\Models\IaimOrdenTrabajo;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class ReportePersonalizado extends Component
{
    use Actions;

    public $buscar;
    public $fecha_inicio_inv;
    public $fecha_fin_inv;
    public $fecha_inicio_ot;
    public $fecha_fin_ot;
    public $codigo;
    public $estatus;

    public function validateData_t1()
    {
        $this->validate([
            'fecha_inicio_inv'         => 'required',
            'fecha_fin_inv'            => 'required',
            'codigo'                  => 'required',

        ]);
    }

    public function validateData_t2()
    {
        $this->validate([
            'fecha_inicio_ot'         => 'required',
            'fecha_fin_ot'            => 'required',
            'estatus'                  => 'required',

        ]);
    }

    /**
     * Mensajes de validacion
     */
    protected $messages = [

        'fecha_inicio_inv.required'       => 'Campo Requerido',
        'fecha_fin_inv.required'          => 'Campo Requerido',
        'fecha_inicio_ot.required'       => 'Campo Requerido',
        'fecha_fin_ot.required'          => 'Campo Requerido',
        'codigo.required'                => 'Campo Requerido',
        'estatus.required'                => 'Campo Requerido',

    ];

    public function genera_reporte_inv()
    {
        $this->validateData_t1();

        try {

            $data = DB::table("iaim_movimiento_inventarios")
                ->select(
                    DB::raw("SUM(entrada) as total_mov_ent"),
                    DB::raw("SUM(salida) as total_mov_sal"),
                    DB::raw("codigo as codigo"),
                    'descripcion',
                    DB::raw("SUM(entrada) - SUM(salida) as Total_existencia")
                )
                ->where('codigo', $this->codigo)
                    ->whereBetween('created_at', [$this->fecha_inicio_inv . ' 00:00:00', $this->fecha_fin_inv . ' 23:59:00'])
                    ->groupBy(['codigo', 'descripcion'])
                    ->get();

            $data_entradas = DB::table("iaim_movimiento_inventarios")
            ->select('entrada', 'fecha_entrada', 'created_at')
            ->where('codigo', $this->codigo)
            ->where('entrada', '>', 0)
                ->whereBetween('created_at', [$this->fecha_inicio_inv . ' 00:00:00', $this->fecha_fin_inv . ' 23:59:00'])
                ->orderBy('fecha_entrada', 'asc')
                ->get();

            $data_salidas = DB::table("iaim_movimiento_inventarios")
            ->select('salida', 'fecha_salida', 'created_at')
            ->where('codigo', $this->codigo)
            ->where('salida', '>', 0)
                ->whereBetween('created_at', [$this->fecha_inicio_inv . ' 00:00:00', $this->fecha_fin_inv . ' 23:59:00'])
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

        $this->validateData_t2();

    try {

        $res = DB::table("iaim_orden_trabajos")
        ->select(DB::raw("count(codigo_ot) as total_ot"))
        ->where('status', $this->estatus)
            ->whereBetween('created_at', [$this->fecha_inicio_ot . ' 00:00:00', $this->fecha_fin_ot . ' 23:59:00'])
            ->groupBy(['status'])
            ->get();

        $res2 = DB::table("iaim_orden_trabajos")
        ->select(DB::raw("count(codigo_ot) as total_ot"), DB::raw("fecha_ot as fechas"))
        ->where('status', $this->estatus)
            ->whereBetween('created_at', [$this->fecha_inicio_ot . ' 00:00:00', $this->fecha_fin_ot . ' 23:59:00'])
            ->orderBy('fecha_ot', 'desc')
            ->groupBy(['fecha_ot'])
            ->get();

        $totales_ots = $res2->pluck('total_ot');
        $fechas = $res2->pluck('fechas');
        // dd($totales_ots, $fechas);

        foreach ($res as $item) 
        {
            $total     = $item->total_ot;
        }

        $total_ots = IaimOrdenTrabajo::all()->count();
        $array_data = [$total, $total_ots];
        $fecha_inicio_ot = $this->fecha_inicio_ot;
        $fecha_fin_ot = $this->fecha_fin_ot;

        if ($this->estatus == 1) 
        {
            $des_estatus = 'Registrada';
        }
        if ($this->estatus == 2) 
        {
            $des_estatus = 'Aprobada';
        }
        if ($this->estatus == 3) 
        {
            $des_estatus = 'Finalizada';
        }

        $pdf = Pdf::loadView('pdf.reporte_ots', 
            compact('total','res2','array_data','fecha_inicio_ot','fecha_fin_ot','total_ots','des_estatus','totales_ots','fechas'))->output();
            return response()->streamDownload(
                fn () => print($pdf),
                "filename.pdf"
           );

        } catch (\Throwable $res) {
            $this->notification()->warning(
                $title = 'Validación!',
                $description = 'Debe selecionar un fecha valida. No hay información disponible.'
            );
        }
    }

    public function render()
    {

        return view('livewire.iaim.reporte-personalizado');
        
    }
}
