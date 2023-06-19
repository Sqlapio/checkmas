@php
use App\Models\IaimCierreInventario;
use Carbon\Carbon;
$data = DB::table("iaim_cierre_inventarios")
            ->select(DB::raw("SUM(total_mov_sal) as total_mov_sal") ,DB::raw("codigo as codigo"))
            ->groupBy('codigo')
            ->get();

$dia_anterior = date('Y-m-d', strtotime("-1 days"));

$data2 = IaimCierreInventario::select('*')
        ->whereBetween('fecha_cierre', [$dia_anterior.' 00:00:00', $dia_anterior.' 23:00:00'])
        ->where('total_mov_sal', '>', 10)
        ->get();
        foreach($data2 as $item)
        {
            $total = $item->total_mov_sal;
            $codigo = $item->codigo;
        }
@endphp
<h5 class="text-blueGray-400 uppercase text-xs mb-4">Inventario<br>Salidas<br>Codigo: 00</h5>
<span class="font-semibold text-xl text-blueGray-700">Salidas: 00</span>