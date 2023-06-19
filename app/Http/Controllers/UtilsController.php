<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use App\Models\Estadistica;
use App\Models\Estado;
use App\Models\FichaTecnica;
use App\Models\Iaim_Articulo;
use App\Models\Iaim_Movimiento_Inventario;
use App\Models\Iaim_OrdenCompra;
use App\Models\IaimCertificacionOrdenTrabajo;
use App\Models\IaimMaterialOrdenTrabajo;
use App\Models\IaimOrdenTrabajo;
use App\Models\Ot;
use App\Models\Tikect;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class UtilsController extends Controller
{
    static function porcentaje($cardValor, $valorTotal)
    {
        $porcen = ($cardValor * 100) / $valorTotal;
        return $porcen;
    }

    static function estado($codigo)
    {
        try {
            $data = Estado::where('codigo', $codigo)->get();
            foreach ($data as $item) {
                $estado = $item->descripcion;
            }
            return $estado;
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function agencia($codigo)
    {
        try {
            $data = Agencia::where('codigo', $codigo)->get();
            foreach ($data as $item) {
                $agencia = $item->descripcion;
            }
            return $agencia;
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function suma()
    {
        $date = date('Y-m-d');

        try {

            $inver = Ot::where('statusOts', '5')
                ->where('updated_at', '<', $date)
                ->where('tipoMantenimiento', 'MC')
                ->sum('costo_preCli');
            return $inver;
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function actualizaContador($id, $valor)
    {
        $total = $valor + 1;
        try {

            DB::table('users')
                ->where('id', $id)
                ->update(['contador' => $total]);
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function userActivo($id)
    {
        try {

            DB::table('users')
                ->where('id', $id)
                ->update(['activo' => 1]);
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function userInactivo($id)
    {
        try {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'activo' => 0,
                    'ultima_conexion' => date('d-m-Y h:m:s a')
                ]);
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function porcenInverPorEstado($total_estado)
    {
        try {
            $totalOts = Ot::select(DB::raw("sum(costo_preCli) as total"))
                ->where('tipoMantenimiento', 'MC')
                ->where('statusOts', 5)
                ->pluck('total');

            $valor = ($total_estado * 100) / $totalOts['0'];

            return number_format($valor, 2, ',', '.');
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    

    public function reporte_ots()
    {
        try {

            $data = Ot::all();
            $count_r = Ot::where('statusOts', '1')->count();
            $count_a = Ot::where('statusOts', '2')->count();
            $count_e = Ot::where('statusOts', '3')->count();
            $count_f = Ot::where('statusOts', '5')->count();
            $pdf = Pdf::loadView('pdf.ots', compact('data', 'count_r', 'count_a', 'count_e', 'count_f'));
            return $pdf->stream('reporte_ots.pdf');
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    public function reporte_tickets()
    {
        try {

            $data = Tikect::all();
            $count_a = Tikect::where('status_tikect', '0')->count();
            $count_c = Tikect::where('status_tikect', '1')->count();
            $pdf = Pdf::loadView('pdf.tickets', compact('data', 'count_a', 'count_c'));
            return $pdf->stream('reporte_tickets.pdf');
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function get_nombre($email)
    {
        try {

            $data = User::where('email', $email)->get();

            foreach ($data as $item) {
                $nombre = $item->nombre;
                $apellido = $item->apellido;
            }

            $res = $nombre . ' ' . $apellido;

            return $res;
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function total_ticket($estado, $estatus)
    {
        try {

            if ($estatus == 1) {
                $total = Estadistica::where('estado', $estado)->get();
                foreach ($total as $item) {
                    $total_ticket_cerrados = $item->total_ticket_cerrados;
                    $total_ticket_abiertos = $item->total_ticket_abiertos;
                }
                $total_ticket_cerrados = $total_ticket_cerrados + 1;
                $total_ticket_abiertos = $total_ticket_abiertos - 1;
                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ticket_cerrados' => $total_ticket_cerrados,
                        'total_ticket_abiertos' => $total_ticket_abiertos
                    ]);
            } else {
                $total = Estadistica::where('estado', $estado)->get();
                foreach ($total as $item) {
                    $total_ticket_abiertos = $item->total_ticket_abiertos;
                }
                $total_ticket_abiertos = $total_ticket_abiertos + 1;
                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update(['total_ticket_abiertos' => $total_ticket_abiertos]);
            }
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function total_inversion_mp($equipo_uid, $estado)
    {
        try {

            $data = FichaTecnica::where('uid', $equipo_uid)->get();
            foreach ($data as $item) {
                $costo = $item->costo;
            }

            $data2 = Estadistica::where('estado', $estado)->get();
            foreach ($data2 as $item) {
                $total_inversion_mp = $item->total_inversion_mp;
                $total_inversion_mc = $item->total_inversion_mc;
                $total_ot_mp_creada = $item->total_ot_mp_creada;
            }

            $total_inversion_mp = $total_inversion_mp + $costo;
            $total_ot_mp_creada = $total_ot_mp_creada + 1;
            // dd($total_inversion_mp, $total_ot_mp_creada);
            DB::table('estadisticas')
                ->where('estado', $estado)
                ->update([
                    'total_inversion_mp' => $total_inversion_mp,
                    'total_ot_mp_creada' => $total_ot_mp_creada,
                    'total_inversion_mp_mc' => $total_inversion_mp + $total_inversion_mc
                ]);
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function total_inversion_mc($costo_preCli, $estado)
    {
        try {
            $data = Estadistica::where('estado', $estado)->get();
            foreach ($data as $item) {
                $total_inversion_mc = $item->total_inversion_mc;
                $total_inversion_mp = $item->total_inversion_mp;
            }

            $total_inversion_mc = $total_inversion_mc + $costo_preCli;

            DB::table('estadisticas')
                ->where('estado', $estado)
                ->update([
                    'total_inversion_mc' => $total_inversion_mc,
                    'total_inversion_mp_mc' => $total_inversion_mp + $total_inversion_mc
                ]);
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function actualiza_total_inversion_mc($costo_preCli, $estado)
    {
        try {

            $data = Estadistica::where('estado', $estado)->get();
                foreach ($data as $item) {
                    $total_inversion_mc = $item->total_inversion_mc;
                    $total_inversion_mp_mc = $item->total_inversion_mp_mc;
                }

            $total_inversion_mc = $total_inversion_mc - $costo_preCli;
            $total_inversion_mp_mc = $total_inversion_mp_mc - $costo_preCli;

            DB::table('estadisticas')
                ->where('estado', $estado)
                ->update([
                    'total_inversion_mc' => $total_inversion_mc,
                    'total_inversion_mp_mc' => $total_inversion_mp_mc,
            ]);

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function total_ot_mc_estatus($estado, $estatus)
    {
        try {

            $data = Estadistica::where('estado', $estado)->get();
            foreach ($data as $item) {
                $total_ot_mc_creada     = $item->total_ot_mc_creada;
                $total_ot_mc_aprobada   = $item->total_ot_mc_aprobada;
                $total_ot_mc_ejecucion  = $item->total_ot_mc_ejecucion;
                $total_ot_mc_supervicion = $item->total_ot_mc_supervicion;
                $total_ot_mc_finalizada  = $item->total_ot_mc_finalizada;
            }

            if ($estatus == 1) {
                $total_ot_mc_creada = $total_ot_mc_creada + 1;
                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mc_creada' => $total_ot_mc_creada
                    ]);
            }

            if ($estatus == 2) {
                $total_ot_mc_aprobada = $total_ot_mc_aprobada + 1;

                if ($total_ot_mc_creada == 0) {
                    $total_ot_mc_creada = 0;
                } else {
                    $total_ot_mc_creada = $total_ot_mc_creada - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mc_aprobada' => $total_ot_mc_aprobada,
                        'total_ot_mc_creada' => $total_ot_mc_creada
                    ]);
            }

            if ($estatus == 3) {
                $total_ot_mc_ejecucion = $total_ot_mc_ejecucion + 1;

                if ($total_ot_mc_aprobada == 0) {
                    $total_ot_mc_aprobada = 0;
                } else {
                    $total_ot_mc_aprobada = $total_ot_mc_aprobada - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mc_ejecucion' => $total_ot_mc_ejecucion,
                        'total_ot_mc_aprobada' => $total_ot_mc_aprobada
                    ]);
            }

            if ($estatus == 4) {
                $total_ot_mc_supervicion = $total_ot_mc_supervicion + 1;

                if ($total_ot_mc_ejecucion == 0) {
                    $total_ot_mc_ejecucion = 0;
                } else {
                    $total_ot_mc_ejecucion = $total_ot_mc_ejecucion - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mc_supervicion' => $total_ot_mc_supervicion,
                        'total_ot_mc_ejecucion' => $total_ot_mc_ejecucion
                    ]);
            }

            if ($estatus == 5) {
                $total_ot_mc_finalizada = $total_ot_mc_finalizada + 1;

                if ($total_ot_mc_supervicion == 0) {
                    $total_ot_mc_supervicion = 0;
                } else {
                    $total_ot_mc_supervicion = $total_ot_mc_supervicion - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mc_finalizada' => $total_ot_mc_finalizada,
                        'total_ot_mc_supervicion' => $total_ot_mc_supervicion
                    ]);
            }
        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function total_ot_mp_estatus($estado, $estatus)
    {
        try {

            $data = Estadistica::where('estado', $estado)->get();
            foreach ($data as $item) {
                $total_ot_mp_creada = $item->total_ot_mp_creada;
                $total_ot_mp_aprobada = $item->total_ot_mp_aprobada;
                $total_ot_mp_ejecucion = $item->total_ot_mp_ejecucion;
                $total_ot_mp_supervicion = $item->total_ot_mp_supervicion;
                $total_ot_mp_finalizada = $item->total_ot_mp_finalizada;
            }

            if ($estatus == 2) {
                $total_ot_mp_aprobada = $total_ot_mp_aprobada + 1;

                if ($total_ot_mp_creada == 0) {
                    $total_ot_mp_creada = 0;
                } else {
                    $total_ot_mp_creada = $total_ot_mp_creada - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mp_aprobada' => $total_ot_mp_aprobada,
                        'total_ot_mp_creada' => $total_ot_mp_creada
                    ]);
            }

            if ($estatus == 3) {
                $total_ot_mp_ejecucion = $total_ot_mp_ejecucion + 1;

                if ($total_ot_mp_aprobada == 0) {
                    $total_ot_mp_aprobada = 0;
                } else {
                    $total_ot_mp_aprobada = $total_ot_mp_aprobada - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mp_ejecucion' => $total_ot_mp_ejecucion,
                        'total_ot_mp_aprobada' => $total_ot_mp_aprobada
                    ]);
            }

            if ($estatus == 4) {
                $total_ot_mp_supervicion = $total_ot_mp_supervicion + 1;

                if ($total_ot_mp_ejecucion == 0) {
                    $total_ot_mp_ejecucion = 0;
                } else {
                    $total_ot_mp_ejecucion = $total_ot_mp_ejecucion - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mp_supervicion' => $total_ot_mp_supervicion,
                        'total_ot_mp_ejecucion' => $total_ot_mp_ejecucion
                    ]);
            }

            if ($estatus == 5) {
                $total_ot_mp_finalizada = $total_ot_mp_finalizada + 1;

                if ($total_ot_mp_supervicion == 0) {
                    $total_ot_mp_supervicion = 0;
                } else {
                    $total_ot_mp_supervicion = $total_ot_mp_supervicion - 1;
                }

                DB::table('estadisticas')
                    ->where('estado', $estado)
                    ->update([
                        'total_ot_mp_finalizada' => $total_ot_mp_finalizada,
                        'total_ot_mp_supervicion' => $total_ot_mp_supervicion
                    ]);
            }
        } catch (\Throwable $th) {
            Debugbar::info($th);
            dd($th);
        }
    }

    public function reporte_articulos()
    {
        try {

            $data = Iaim_Articulo::all();
            $count = Iaim_Articulo::all()->count();
            $pdf = Pdf::loadView('pdf.articulos', compact('data', 'count'));
            return $pdf->stream('reporte_articulos.pdf');

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    public function reporte_entradas()
    {
        try {

            $data = Iaim_Movimiento_Inventario::where('tipo_mov', 1)->get();
            $count = Iaim_Movimiento_Inventario::where('tipo_mov', 1)->count();
            $pdf = Pdf::loadView('pdf.entradas', compact('data', 'count'));
            return $pdf->stream('reporte_entradas.pdf');

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    public function reporte_salidas()
    {
        try {

            $data = Iaim_Movimiento_Inventario::where('tipo_mov', 2)->get();
            $count = Iaim_Movimiento_Inventario::where('tipo_mov', 2)->count();
            $pdf = Pdf::loadView('pdf.salidas', compact('data', 'count'));
            return $pdf->stream('reporte_salidas.pdf');

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    public function reporte_ficha_tecnica($id)
    {
        try {

            $data = FichaTecnica::where('id',$id)->get();
            $pdf = Pdf::loadView('pdf.ficha_tecnica', compact('data'))->setPaper('a4', 'landscape');
            return $pdf->stream('reporte_ficha_tecnica.pdf');

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function total_existe($codigo)
    {
        try {

            /**
             * @todo Se debe realizar ajustes para que el query que calcula el total de existencias
             * reconsca el formato de fecha de forma correcta.
             */

            $data_entradas = DB::table("iaim_movimiento_inventarios")
                ->select(DB::raw("SUM(entrada) as entradas"))
                ->where('codigo', $codigo)
                ->get();
            foreach($data_entradas as $item)
            {
                $entradas = $item->entradas;
            }

            $data_salidas = DB::table("iaim_movimiento_inventarios")
                ->select(DB::raw("SUM(salida) as salidas"))
                ->where('codigo', $codigo)
                ->get();
            foreach($data_salidas as $item)
            {
                $salidas = $item->salidas;
            }


            $total = $entradas - $salidas;
            return $total;

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function crear_codigo_ot($aero, $area)
    {

        $prefijo = 'IAIM';

        $res = DB::table('iaim_orden_trabajos')->latest('id')->first();
        if($res == null){
            $parte4 = str_pad(1, 5, "0", STR_PAD_LEFT);
        }else{
            $parte4 = $res->id + 1;
            $parte4 = str_pad($parte4, 5, "0", STR_PAD_LEFT);
        }
        
        if($aero == 'nacional' && $area == 'conviasa'){
            $codigo_ot = $prefijo.'-N-CON-'.date('dmY').'-'.$parte4;
            return $codigo_ot;
        }

        if($aero == 'nacional' && $area == 'aeropostal'){
            $codigo_ot = $prefijo.'-N-AE-'.date('dmY').'-'.$parte4;
            return $codigo_ot;
        }

        if($aero == 'internacional' && $area == 'copa'){
            $codigo_ot = $prefijo.'-I-CO-'.date('dmY').'-'.$parte4;
            return $codigo_ot;
        }

        if($aero == 'internacional' && $area == 'america'){
            $codigo_ot = $prefijo.'-I-AM-'.date('dmY').'-'.$parte4;
            return $codigo_ot;
        }

        if($aero == 'edif_sede' && $area == 'no_aplica'){
            $codigo_ot = $prefijo.'-ES-'.date('dmY').'-'.$parte4;
            return $codigo_ot;
        }
    }

    public function orden_trabajo($id)
    {
        try {

            $data = IaimOrdenTrabajo::where('id',$id)->get();
            foreach($data as $item){
                $codigo = $item->codigo_ot;
            }
            $dataProductos = IaimMaterialOrdenTrabajo::where('codigo_ot',$codigo)->get();
            $pdf = Pdf::loadView('pdf.orden_trabajo', compact('data', 'dataProductos'));
            return $pdf->stream('reporte_orden_compra.pdf');

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    public function cert_orden_trabajo($id)
    {
        try {

            $data = IaimCertificacionOrdenTrabajo::where('id',$id)->get();
            $pdf = Pdf::loadView('pdf.cert_orden_trabajo', compact('data'));
            return $pdf->download('reporte_cert_orden_compra.pdf');

        } catch (\Throwable $th) {
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
    }

    static function actualiza_estatus_orden($codigo)
    {

        try {
                DB::table('iaim_orden_trabajos')
                ->where('codigo_ot', $codigo)
                ->update([
                    'status' => '3'
                ]);

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    static function cierre_diario()
    {

        try {

            $data_entradas = DB::table("iaim_movimiento_inventarios")
                ->select(DB::raw("SUM(entrada) as entradas"))
                ->groupBy(DB::raw("codigo as codigo"))
                ->get();
            Debugbar::infor($data_entradas);
            foreach($data_entradas as $item)
            {
                $entradas = $item->entradas;
            }

            $data_salidas = DB::table("iaim_movimiento_inventarios")
                ->select(DB::raw("SUM(salida) as salidas"))
                ->groupBy(DB::raw("codigo as codigo"))
                ->get();
            foreach($data_salidas as $item)
            {
                $salidas = $item->salidas;
            }

            $total = $entradas - $salidas;
            return $total;

        } catch (\Throwable $th) {
            Debugbar::addThrowable($th);
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
        
    }

    static function reporte_per_articulo($fecha_inicio, $fecha_fin, $codigo)
    {
        dd($fecha_inicio);
        try {

            $data = DB::table("iaim_movimiento_inventarios")
            ->select(DB::raw("SUM(entrada) as total_mov_ent"),
                    DB::raw("SUM(salida) as total_mov_sal"), 
                    DB::raw("codigo as codigo"), 'descripcion',
                    DB::raw("SUM(entrada) - SUM(salida) as Total_existencia"))
            ->where('codigo', $codigo)
            ->whereBetween('created_at', [$fecha_inicio.' 00:00:00', $fecha_fin.' 23:59:00'])
            ->groupBy(['codigo', 'descripcion'])
            ->get();

            foreach ($data as $item) {
                $total_mov_ent      = $item->total_mov_ent;
                $total_mov_sal      = $item->total_mov_sal;
                $Total_existencia   = $item->Total_existencia;
                $descripcion        = $item->descripcion;
            }

            $totales = [$total_mov_ent, $total_mov_sal, $Total_existencia];

            $pdf = Pdf::loadView('pdf.reporte_mov_inv', compact('totales', 'descripcion', 'fecha_inicio', 'fecha_fin'));
            return $pdf->stream('reporte_mov_inv.pdf');
            


        } catch (\Throwable $th) {
            dd($th);
            Debugbar::addThrowable($th);
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
        
    }

    static function reporte_per_ot($fecha_inicio, $fecha_fin, $estatus)
    {

        try {

            $data = DB::table("iaim_orden_trabajos")
            ->where('status', $estatus)
            ->whereBetween('created_at', [$fecha_inicio.' 00:00:00', $fecha_fin.' 23:59:00'])
            ->get();

            $pdf = Pdf::loadView('pdf.reporte_ots', compact('data', 'dataProductos'));
            return $pdf->stream('reporte_ots.pdf');
            
            dd($data);

        } catch (\Throwable $th) {
            dd($th);
            Debugbar::addThrowable($th);
            Log::error('- Class UtilsControllers - Se ha producido un error al ejecutar la funcion.'.$th->getMessage());
        }
        
    }

}
