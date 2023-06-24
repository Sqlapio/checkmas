@php
use App\Models\Ot;
use App\Models\IaimOrdenTrabajo;
$total = IaimOrdenTrabajo::where('status', 3)->count();
if($total == 0){
    $total = '0';
}
@endphp
<span class="font-semibold text-xl text-blueGray-700">{{ $total }}</span>