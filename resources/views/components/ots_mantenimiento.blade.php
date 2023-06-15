@php
use App\Models\Ot;
$user = Auth::user()->rol;
$ots_supervisor = Ot::all();
$ots = Ot::where('statusOts', '3')
            ->where('tecRes_email', Auth::user()->email)
            ->get();
@endphp
@if ($user == '7')
    <x-native-select wire:model="nro_ot" class="focus:ring-check-blue focus:border-check-blue">
        <option value="">...</option>
            @foreach($ots_supervisor as $item)
                <option value="{{ $item->otUid }}">{{ $item->otUid }}</option>
            @endforeach
    </x-native-select>
@else
    <x-native-select wire:model="nro_ot" class="focus:ring-check-blue focus:border-check-blue">
        <option value="">...</option>
            @foreach($ots as $item)
                <option value="{{ $item->otUid }}">{{ $item->otUid }}</option>
            @endforeach
    </x-native-select> 
@endif
