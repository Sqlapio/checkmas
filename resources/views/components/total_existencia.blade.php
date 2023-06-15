@php
use App\Models\Iaim_Articulo;
use Carbon\Carbon;
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

    $totales = [];

    for ($i=0, $j=0; $i<count($productos), $j<count($existencia); $i++, $j++) {
        array_push($totales, $productos[$i] * $existencia[$j]);
    }
    
@endphp
<span class="font-semibold text-xl text-blueGray-700">${{ number_format(array_sum($totales), 2, ',', '.') }}</span>