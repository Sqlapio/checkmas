@php
namespace App\Http\Controllers;
use App\Models\Ot;

$totalEjecucion = Ot::where('statusOts', 3)->count();
$totalOts = Ot::all()->count();
if($totalOts == 0){
    $porcenOtsEjecucion = '0';
}else{
    $porcenOtsEjecucion = UtilsController::porcentaje($totalEjecucion, $totalOts);
    $porcenOtsEjecucion = round($porcenOtsEjecucion, 2);
}
@endphp

<span class="text-emerald-500 mr-2"><i class="fas fa-arrow-up"></i>{{ $porcenOtsEjecucion }}%</span>