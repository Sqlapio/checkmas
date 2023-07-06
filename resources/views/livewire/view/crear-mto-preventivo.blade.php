
<div class="p-3">
    <div class="items-center justify-start mb-8 mt-4 sm:flex">
        <h1 class="text-xl mb-6">Asignación Mantenimientos Preventivos</h1>
    </div>

    <div class="mt-5">
        <div class="flex justify-start mt-4 mb-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fechaInicio')</label>
                <x-input type="date" wire:model="fechaInicio" id="focus"  class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <x-lista-tecnicos></x-lista-tecnicos>
            </div>
        </div>
        <div class="flex justify-start mb-4">
            <input wire:model="buscar" type="search" id="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar por codigo del equipo...." autocomplete="off">
                <svg wire:click="reset_filtros" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 font-bold text-gray-500 my-auto ml-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
        </div>
        <div class="overflow-auto rounded-lg shadow">
            <table class="w-full" id="tabla_ots_mp">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-500">
                            Nro. Ot
                        </th>
                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-500">
                            Codigo Equipo
                        </th>
                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-500">
                            Agencia
                        </th>
                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-500">
                            Estado
                        </th>
                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-500">

                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                    @foreach ($data as $item)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->otUid }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->equipoUid }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->agencia }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->estado }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                            <x-checkbox id="md" md wire:model="equipos" value="{{ $item->equipoUid }}"/>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{var_export($equipos)}} --}}
            {{-- Div para la paginacion --}}
            <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">

                {{-- Paginacion --}}
                {{ $data->links() }}
            </div>
            <div class="botton grid justify-items-end mt-1 mb-1">
                {{-- Botton APROBAR OT --}}
                <div class="p-2 mt-auto mr-4">
                    <button type="submit" wire:click.prevent="store()" class="justify-end rounded-xl border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                        <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>
                            Cargar mantenimientos
                        </span>
                    </button>
                </div>
            </div>
        </div>


    </div>
</div>










