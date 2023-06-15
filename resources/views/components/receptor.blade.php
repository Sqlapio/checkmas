@php
use App\Models\User;
use Illuminate\Support\Facades\DB;
$receptores = DB::table('users')
           ->whereBetween('rol', [1, 6])
           ->get();
@endphp
<x-native-select wire:model="receptor" class="focus:ring-check-blue focus:border-check-blue">
    <option value="">...</option>
        @foreach($receptores as $item)
            <option value="{{ $item->email }}">{{ $item->email }}</option>
        @endforeach
</x-native-select>