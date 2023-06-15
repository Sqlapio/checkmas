@php
use App\Models\Ot;
$total = Ot::where('statusOts', 5)->count();
if($total == 0){
    $total = '0';
}
@endphp
{{-- <div class="w-full h-auto m-auto text-6xl px-3 text-center font-bold basis-1/3">
    {{ $total }}
</div> --}}
<span class="font-semibold text-xl text-blueGray-700">{{ $total }}</span>