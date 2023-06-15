@php
namespace App\Http\Controllers;
use App\Models\Estadistica;
$totalEstadisticas = Estadistica::all()->sum('total_inversion_mp_mc') + 658.05;
if($totalEstadisticas == 0){
    $totalEstadisticas = '0';
}else{
    $totalEstadisticas = round($totalEstadisticas, 2);
    $totalEstadisticas = number_format($totalEstadisticas, 2, ',', '.');
}
@endphp
<span class="font-semibold text-xl text-blueGray-700">${{ $totalEstadisticas }}</span>