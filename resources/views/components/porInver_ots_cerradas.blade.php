@php
namespace App\Http\Controllers;
use App\Models\Ot;
use Illuminate\Support\Facades\DB;

$totalCerradas = Ot::select(DB::raw("sum(costo_preCli) as total"))->where('tipoMantenimiento', 'MC')->where('statusOts', 5)->pluck('total');
$totalOts = Ot::select(DB::raw("sum(costo_preCli) as total"))->where('tipoMantenimiento', 'MC')->pluck('total');
if($totalCerradas == null || $totalOts == null){
    $porcenOts = '0';
}else{
    $porcenOts = UtilsController::porcentaje($totalCerradas['0'], $totalOts['0']);
    $porcenOts = round($porcenOts, 2);
}
@endphp

{{-- <h5 class="mb-2 font-bold dark:text-white">%{{ $totalOts['0'] }}</h5> --}}
<span class="text-emerald-500 mr-2"><i class="fas fa-arrow-up"></i>{{ $porcenOts }}%</span>