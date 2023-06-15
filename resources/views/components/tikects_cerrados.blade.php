@php
use App\Models\Tikect;
$total = Tikect::where('status_tikect', 1)->count();
@endphp
<div class="w-full h-auto m-auto text-6xl px-3 text-center font-bold basis-1/3">
    {{ $total }}
</div>