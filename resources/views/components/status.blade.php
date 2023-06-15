<div>
    <span class="text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">@lang('messages.tablas.estatus'): </span>
    <select wire:model="filtro_estatus" wire:change="$emit('filtro', $event.target.value)" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-40 shadow-lg" >
        <option value="">...</option>
        <option value="0">Abierto</option>
        <option value="1">Cerrado</option>
    </select>
</div>