
<div class="p-5">
    <div class="items-center justify-start mb-8 mt-4 sm:flex">
        <h1 class="text-xl mb-4">Asignación Mantenimientos Correctivos</h1>
    </div>
    <div class="border border-gray-200 rounded-lg shadow-md px-4">
        {{-- Datos Orden de trabajo --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fechaInicio')</label>
                <x-input type="date" wire:model="fechaInicio" id="focus"  class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <x-lista-tecnicos></x-lista-tecnicos>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.idEquipo')</label>
                <x-equipos />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.costo_Opera')</label>
                <x-inputs.currency icon="currency-dollar" thousands="." decimal="," precision="2" wire:model="costo_oper" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.costo_preCli')</label>
                <x-inputs.currency icon="currency-dollar" thousands="." decimal="," precision="2" wire:model="costo_preCli" wire:change="$emit('calc', $event.target.value)" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.utilBruta')</label>
                <x-input icon="currency-dollar" thousands="." decimal="," precision="2" wire:model="porcen" value="" class="cursor-none" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 mt-8">
            
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.presupuesto1')</label>
                {{-- <input wire:model="pdf_pre_oper" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:ring-check-blue focus:border-check-blue disabledDocCC"> --}}
                <input id="" wire:model="pdf_pre_oper" type="file" class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-green-50 file:text-check-blue
                        hover:file:bg-green-100">
                @error('pdf_pre_oper') <span class="error text-xs text-red-500 italic">{{ $message }}</span> @enderror
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.presupuesto2')</label>
                {{-- <input wire:model="pdf_pre_preCli" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:ring-check-blue focus:border-check-blue disabledDocCC"> --}}
                <input id="" wire:model="pdf_pre_preCli" type="file" class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-green-50 file:text-check-blue
                        hover:file:bg-green-100">
                @error('pdf_pre_preCli') <span class="error text-xs text-red-500 italic">{{ $message }}</span> @enderror
            </div>
        </div>
        {{-- Boton de registro --}}
        <div class="flex items-center justify-end mt-8 mb-8">
            <x-boton />
        </div>
    </div>
    

    
</div>










