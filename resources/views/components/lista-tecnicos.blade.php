@php
use App\Models\User;
$tecnicos = User::where('rol', '8')->get();
@endphp

<label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.tecnico')</label>
<x-native-select wire:model="tecRespondable" class="focus:ring-check-blue focus:border-check-blue">
    <option value="">...</option>
        @foreach($tecnicos as $item)
            <option value="{{ $item->email }}">{{ $item->nombre }}, {{ $item->apellido }}</option>
        @endforeach
</x-native-select>
