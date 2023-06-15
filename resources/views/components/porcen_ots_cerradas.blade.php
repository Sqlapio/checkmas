@php
namespace App\Http\Controllers;
use App\Models\Ot;

$cardValor = Ot::where('statusOts', 5)->where('tipoMantenimiento', 'MC')->count();
$valorTotal = Ot::all()->count();
if($valorTotal == 0){
    $porcenOts = '0';
}else{
    $porcenOts = UtilsController::porcentaje($cardValor, $valorTotal);
    $porcenOts = round($porcenOts, 2);
}

@endphp

{{-- <h5 class="mb-2 font-bold dark:text-white">{{ $porcenOts }}%</h5> --}}
<span class="text-orange-500 mr-2"><i class="fas fa-arrow-down"></i>{{ $porcenOts }}%</span>