@php
namespace App\Http\Controllers;
use App\Models\Tikect;

$cardValor = Tikect::where('status_tikect', 1)->count();
$valorTotal = Tikect::all()->count();
if($valorTotal == 0){
    $porcenTikect = '0';
}else{
    $porcenTikect = UtilsController::porcentaje($cardValor, $valorTotal);
    $porcenTikect = round($porcenTikect, 2);
}
@endphp

<span class="text-red-500 mr-2"><i class="fas fa-arrow-down"></i>{{ $porcenTikect }}%</span>