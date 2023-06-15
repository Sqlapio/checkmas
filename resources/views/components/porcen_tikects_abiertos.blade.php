@php
namespace App\Http\Controllers;
use App\Models\Tikect;

$cardValor = Tikect::where('status_tikect', 0)->count();
$valorTotal = Tikect::all()->count();
if($valorTotal == 0){
    $porcenTikect = '0';
}else{
    $porcenTikect = UtilsController::porcentaje($cardValor, $valorTotal);
    $porcenTikect = round($porcenTikect, 2);
}

@endphp

<h5 class="mb-2 font-bold dark:text-white">{{ $porcenTikect }}%</h5>