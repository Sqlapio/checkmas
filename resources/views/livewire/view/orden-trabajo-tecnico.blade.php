<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-700 dark:border-gray-600">
    <div class="items-center justify-start mb-8 mt-4 sm:flex">
        <time class="mb-1 text-2xl font-extrabold text-blue-900 drop-shadow-lg sm:order-last sm:mb-0">@lang('messages.label.otsTecnicos')</time>
    </div>

    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.TecRes'): Nombre del Tecnico</label>
    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.tipoMan'): MC - MP</label>

    {{-- Datos Orden de trabajo --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 mt-8">
        <div class="p-2">
            <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fechaEjecucion')</label>
            <x-datetime-picker wire:model="fechaEjecucion" />
        </div>
    </div>

    {{-- Tareas realizadas MP --}}
    <div class="border border-gray-200 rounded-lg shadow-md px-4">
        <div class="p-2 mb-4">
            <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.tareasMp')</label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="flex items-center ">
                <label for="default-checkbox" class="opacity-60 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">@lang('messages.label.limConden')</label>
                <input wire:model="limConden" id="default-checkbox" type="checkbox" class="w-6 h-6 ml-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
            <div class="flex items-center">
                <label for="checked-checkbox" class="opacity-60 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">@lang('messages.label.limEva')</label>
                <input wire:model="limEva" id="checked-checkbox" type="checkbox" class="w-6 h-6 ml-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.lecAmpComp')</label>
                <x-input icon="pencil" wire:model="lecAmpComp" />
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.lecPreAlta')</label>
                <x-input icon="pencil" wire:model="lecPreAlta" />
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.lecPreBaja')</label>
                <x-input icon="pencil" wire:model="lecPreBaja" />
            </div>
        </div>

        {{-- Fotos Mp Antes --}}
        <div class="p-2 mb-4">
            <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.fotosMpAntes')</label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes1')</label>
                <input id="" wire:model="fotoMpAntes1" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes2')</label>
                <input id="" wire:model="fotoMpAntes2" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
        </div>

        {{-- Fotos Mp Despues --}}
        <div class="p-2 mb-4">
            <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.fotosMpDesp')</label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes1')</label>
                <input id="" wire:model="fotoMpDesp1" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes2')</label>
                <input id="" wire:model="fotoMpDesp2" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
        </div>

        {{-- Observaciones --}}
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.observacionesMp')</label>
                <x-textarea wire:model="observacionesMp" placeholder="Obervaciones y Diagnostico para Mentenimiento Correctivo" />
            </div>
        </div>
    </div>

    {{-- Tareas realizadas MC --}}
    <div class="border border-gray-200 rounded-lg shadow-md px-4">
        <div class="p-2 mb-4">
            <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.tareasMc')</label>
        </div>

        {{-- Lista de materiales --}}
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.listaMateriales')</label>
                <x-textarea wire:model="listaMateriales" placeholder="Lista de materiales usados en la actividad" />
            </div>
        </div>

        {{-- Fotos Mc Antes --}}
        <div class="p-2 mb-4">
            <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.fotosMcAntes')</label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes1')</label>
                <input id="" wire:model="fotoMcAntes1" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes2')</label>
                <input id="" wire:model="fotoMcAntes2" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
        </div>

        {{-- Fotos Mc Despues --}}
        <div class="p-2 mb-4">
            <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.fotosMcDesp')</label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes1')</label>
                <input id="" wire:model="fotoMcDesp1" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fotoAntes2')</label>
                <input id="" wire:model="fotoMcDesp2" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:border-indigo-500 disabledDocCC">
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

    {{-- Boton de registro --}}
    <div class="flex items-center justify-end mt-8 mb-8">
        <button type="submit" wire:click.prevent="store()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-red-200 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-200">
            <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            <span> REGISTRAR</span>
        </button>
    </div>

</div>


