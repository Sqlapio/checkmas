@php
use App\Models\FichaTecnica;
$equipos = FichaTecnica::all();
@endphp
<x-native-select wire:model="equipoUid" class="focus:ring-check-blue focus:border-check-blue">
    <option value="">...</option>
        @foreach($equipos as $item)
            <option value="{{ $item->uid }}">{{ $item->uid }} - {{ $item->tipoConden }}</option>
        @endforeach
</x-native-select>