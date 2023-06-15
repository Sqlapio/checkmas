@php
    use App\Models\Servicio;
    $servicios = Servicio::all();
@endphp
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-700 dark:border-gray-600">
    <div class="items-center justify-start mb-8 mt-4 sm:flex">
        <time class="mb-1 text-2xl font-extrabold text-blue-900 drop-shadow-lg sm:order-last sm:mb-0">@lang('messages.label.reporteIncidencias')</time>
    </div>

    <div class="border border-gray-200 rounded-lg shadow-md px-4">

        {{-- Datos Orden de trabajo --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 mt-8">
            <div class="p-2 {{ $atr_select_servicio }}">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.tipoServicio')</label>
                {{-- <x-input wire:model="otroServicio" class="{{ $atr_otro_servicio }}"/> --}}
                <x-native-select wire:model="tipoServicio" wire:change="$emit('otro_servicio', $event.target.value)" class="focus:ring-check-blue focus:border-check-blue">
                    <option value="">...</option>
                    @foreach ($servicios as $item)
                    <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
                    @endforeach 
                    <option value="otro">Otro</option>
                </x-native-select>
            </div>
            <div class="p-2 {{ $atr_otro_servicio }}">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Otro Servicio</label>
                <x-input wire:model="otroServicio" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.oficina')</label>
                <x-input icon="pencil" wire:model="oficina" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.piso')</label>
                <x-input icon="pencil" wire:model="piso" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.agencia')</label>
                <x-agencias />
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.estado')</label>
                <x-estados />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.observaciones')</label>
                <x-textarea wire:model="observaciones" placeholder="Por favor indique cual es su Incidencia de forma Detallada" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
        </div>
        {{-- Boton de registro --}}
        <div class="flex items-center justify-end mt-8 mb-8">
            <x-boton />
        </div>
    </div>
</div>


