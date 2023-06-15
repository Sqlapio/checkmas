<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-700 dark:border-gray-600">


    {{-- Tareas realizadas Mantenimiento Correctivo --}}
    <div class="border border-gray-200 rounded-lg shadow-md px-4">
        <div class="p-2 mb-4">
            <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.tareas')</label>
        </div>

        {{-- Lista de materiales --}}
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.listaMateriales')</label>
                <x-textarea wire:model="listaMateriales" placeholder="Lista de materiales usados en la actividad" />
            </div>
        </div>
        {{-- Fotos antes y despues --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes')</label>
                <input id="" wire:model="fotoAntes" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
            
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoDespues')</label>
                <input id="" wire:model="fotoDespues" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
        </div>
        {{-- observaciones --}}
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.observacionesMC')</label>
                <x-textarea wire:model="observacionesMC" placeholder="Observaciones relevantes de la actividad" />
            </div>
        </div>
    </div>
</div>

