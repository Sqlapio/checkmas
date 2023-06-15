@php
use App\Models\Iaim_Categoria;
$categorias = Iaim_Categoria::all();
@endphp
<x-native-select wire:model="categoria" class="focus:ring-check-blue focus:border-check-blue">
    <option value="">...</option>
        @foreach($categorias as $item)
            <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
        @endforeach
</x-native-select>