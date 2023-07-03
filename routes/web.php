<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\View\Dashboard;
use App\Models\Estado;
use App\Models\Iaim_Articulo;
use App\Models\IaimCierreInventario;
use App\Models\Ot;
use App\Models\Tikect;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware(['auth:sanctum','verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * Ruta de prueba
     */
    Route::view('/dashboard-admin','livewire.view.dashboard')->name('dashboard-admin');

    Route::view('/dash',Dashboard::class)->name('foo');

    Route::get('/completar-registro', function () {
        return view('auth.completar-registro');
    })->name('completar-registro');

    Route::get('ficha-tecnica', function () {
        return view('tecnicos.ficha-tecnica');
    })->name('ficha-tecnica');

    Route::get('crear-tikect', function () {
        return view('dashboard.crear-tikect');
    })->name('crear-tikect');

    Route::get('lista-tikects', function () {
        return view('dashboard.lista-tikects');
    })->name('lista-tikects');

    Route::get('ots', function () {
        return view('tecnicos.ots');
    })->name('ots');

    Route::get('lista-usuarios', function () {
        return view('dashboard.listado-usuarios');
    })->name('lista-usuarios');

    Route::get('usuarios-activos', function () {
        return view('dashboard.usuarios-activos');
    })->name('usuarios-activos');

    Route::get('equipos', function () {
        return view('dashboard.equipos');
    })->name('equipos');

    Route::get('dash-mantenimientos', function () {
        return view('dashboard.mantenimientos');
    })->name('dash-mantenimientos');

    Route::get('dash-mantenimientos-culminados', function () {
        return view('dashboard.mantenimientos_culminados');
    })->name('dash-mantenimientos-culminados');

    Route::get('mantenimientos', function () {
        return view('tecnicos.mantenimientos');
    })->name('mantenimientos');

    Route::get('bitacora', function () {
        return view('tecnicos.bitacora');
    })->name('bitacora');

    Route::get('mensajes/enviados', function () {
        return view('dashboard.mensajes-enviados');
    })->name('mensajes-enviados');

    Route::get('mensajes/recibidos', function () {
        return view('dashboard.mensajes-recibidos');
    })->name('mensajes-recibidos');

    Route::get('ots/mto/preventivo', function () {
        return view('dashboard.crear-mto-preventivo');
    })->name('crear-mto-preventivo');

    Route::get('ots/mto/correctivo', function () {
        return view('dashboard.crear-mto-correctivo');
    })->name('crear-mto-correctivo');

    Route::get('config/valor-tonelada', function () {
        return view('dashboard.valor-tonelada');
    })->name('valor-tonelada');

    Route::get('prueba', function () {
        return view('prueba');
    })->name('prueba');

    Route::get('arr', function () {
        $arr = User::all();
        return $arr;
    })->name('arr');

    // Route::view('/completar-registro','livewire.view.completar-registro')->name('completar-registro');

    Route::get('/dash-tecnicos', function () {
        return view('tecnicos.ficha-tecnica');
    })->name('dash-tecnicos');
    
    /**
     * Ruta para Logout del usuario
     */
    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'destroy'])
        ->name('logout');

    /**
     * Ruta para reportes
     */
    Route::get('/reporte/users', [\App\Http\Controllers\UtilsController::class, 'reporte_users'])
        ->name('reporte.users');
    Route::get('/reporte/ots', [\App\Http\Controllers\UtilsController::class, 'reporte_ots'])
        ->name('reporte.ots');
    Route::get('/reporte/tickets', [\App\Http\Controllers\UtilsController::class, 'reporte_tickets'])
        ->name('reporte.tickets');
    Route::get('/reporte/ficha-tecnica/{id}', [\App\Http\Controllers\UtilsController::class, 'reporte_ficha_tecnica'])
        ->name('reporte.ficha-tecnica');
    
    /**
     * Ruta para imprimir la OTs
     */
    Route::get('/printOt/{id}', function ($id) {
        $data = Ot::find($id);
        $keySecurity = Hash::make($id);
        return view('tecnicos.printOt', compact(['data', 'keySecurity']));
    })->name('print-ot');

    /**
     * Rutas IAIM
     * ********************************************************************
     */

    Route::view('/dashboard-admin-iaim','livewire.iaim.dashboard-iaim')->name('dashboard-admin-iaim');

    /**
     * Rutas modulo de inventario
     */
    Route::get('iaim/articulos', function () {
        return view('iaim.articulos');
    })->name('iaim-articulos');

    Route::get('iaim/art-entrada', function () {
        return view('iaim.art-entrada');
    })->name('art-entrada');

    Route::get('iaim/art-salida', function () {
        return view('iaim.art-salida');
    })->name('art-salida');

    Route::get('iaim/flujo-inventario', function () {
        return view('iaim.flujo-inventario');
    })->name('flujo-inventario');

    Route::get('iaim/reporte-personalizado', function () {
        return view('iaim.reporte-personalizado');
    })->name('reporte-personalizado');

    /**
     * Ruta para reportes de Inventario
     */
    Route::get('/reporte/articulos', [\App\Http\Controllers\UtilsController::class, 'reporte_articulos'])
        ->name('reporte.articulos');
    Route::get('/reporte/entradas', [\App\Http\Controllers\UtilsController::class, 'reporte_entradas'])
        ->name('reporte.entradas');
    Route::get('/reporte/salidas', [\App\Http\Controllers\UtilsController::class, 'reporte_salidas'])
        ->name('reporte.salidas');
    Route::get('/reporte/per/mov-inv', [\App\Http\Controllers\UtilsController::class, 'reporte_per_articulo'])
        ->name('reporte.reporte_per_articulo');
    Route::get('/reporte/per/ots', [\App\Http\Controllers\UtilsController::class, 'reporte_per_ot'])
        ->name('reporte.reporte_per_ot');

    /**
     * Rutas modulo de Orden de trabajo
     */
    Route::get('iaim/crear/orden-trabajo', function () {
        return view('iaim.crear-orden-trabajo');
    })->name('crear-orden-trabajo');

    Route::get('iaim/listar/orden-trabajo', function () {
        return view('iaim.listar-orden-trabajo');
    })->name('listar-orden-trabajo');

    Route::get('iaim/certificar/orden-trabajo', function () {
        return view('iaim.certificar-orden-trabajo');
    })->name('certificar-orden-trabajo');

    Route::get('/reporte/cert/ot/{id}', [\App\Http\Controllers\UtilsController::class, 'cert_orden_trabajo'])
        ->name('reporte.cert.ot');
        Route::get('/reporte/ot/{id}', [\App\Http\Controllers\UtilsController::class, 'orden_trabajo'])
        ->name('reporte.ot');


     /**
     * Rutas modulo de Orden de Compra
     */

});

/**
 * Rutas que no requieren autenticacion
 */
 Route::get('admin-registro', function () {
    return view('auth.admin-registro');
})->name('admin-registro');

Route::get('registro-index', function () {
    return view('auth.registro-index');
})->name('registro-index');

Route::get('registro-trx', function () {
    return view('auth.registro-trx');
})->name('registro-trx');

Route::get('registro-banco', function () {
    return view('auth.registro-banco');
})->name('registro-banco');

Route::get('registro-iaim', function () {
    return view('auth.registro-iaim');
})->name('registro-iaim');

Route::get('/completar-registro-banco', function () {
    return view('auth.completar-registro-banco');
})->name('completar-registro-banco');

Route::get('/recuperar-password', function () {
    return view('auth.recuperar-password');
})->name('recuperar-password');



Route::post('/store-resgistro', [\App\Http\Controllers\UserController::class, 'store-registro'])
        ->name('store-resgistro');

Route::view('/completar-registro','livewire.view.completar-registro')->name('completar-registro');

Route::get('uuid', function () {
    $uuid = Str::uuid()->toString();
        dd($uuid);
   
});

Route::get('/pp', function () {
    $data1 = Iaim_Articulo::select(['codigo','precio_unitario'])->orderBy('codigo', 'asc')->get();
    $productos = $data1->pluck('precio_unitario');
    $productos = json_decode( json_encode($productos), true);
    

    $data2 = DB::table("iaim_movimiento_inventarios")
            ->select(DB::raw("SUM(entrada) - SUM(salida) as Total_existencia"))
            ->groupBy('codigo')
            ->orderBy('codigo', 'asc')
            ->get();
    $existencia = $data2->pluck('Total_existencia');
    $existencia = json_decode( json_encode($existencia), true);
    $res1 = [];
    $res2 = [];
    $totales = [];
    for ($i=0, $j=0; $i<count($productos), $j<count($existencia); $i++, $j++) {
        // $productos[$i] * $existencia[$j];
        array_push($totales, $productos[$i] * $existencia[$j]);
    }
    
dd($productos, $existencia, $totales, array_sum($totales));
})->name('pp');

Route::get('repo', function () {
    $data = DB::table("iaim_movimiento_inventarios")
            ->select(DB::raw("SUM(entrada) as total_mov_ent"),
                    DB::raw("SUM(salida) as total_mov_sal"), 
                    DB::raw("now() as fecha_cierre"), 
                    DB::raw("codigo as codigo"), 'descripcion',
                    DB::raw("now() as updated_at"),
                    DB::raw("SUM(entrada) - SUM(salida) as Total_existencia"))
            ->whereBetween('created_at', ['2023-06-01 00:00:00', '2023-06-05 10:07:00'])
            ->groupBy(['codigo', 'descripcion'])
            ->get();
    dd($data);
   
});



