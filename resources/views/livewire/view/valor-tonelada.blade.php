@php
    use Carbon\Carbon;
@endphp
<div class="p-5">
    <h1 class="text-xl mb-4">Mantenimientos Correctivos</h1>
    <div class="py-5 mt-4">
        <div class="flex justify-between">
            <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
        </div>
    </div>
    <div class="overflow-auto rounded-lg shadow hidden md:block">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Descripcion
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Campo
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Valor
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Nuevo valor
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                @foreach ($data as $item)
                <tr>
                    <td class="px-4 py-4 text-sm text-check-blue font-bold dark:text-gray-300 whitespace-nowrap">{{ $item->descripcion }}</td>
                    <td class="px-4 py-4 text-sm text-check-blue font-bold dark:text-gray-300 whitespace-nowrap">{{ $item->tipo }}</td>
                    <td class="px-4 py-4 text-sm text-check-blue font-bold dark:text-gray-300 whitespace-nowrap">{{ $item->precio_unitario }}</td>
                    <td class="px-4 py-4 text-sm text-check-blue font-bold dark:text-gray-300 whitespace-nowrap">
                        <input type="text" class="border p-1 rounded-lg w-20" wire:model="valor-{{$item->id}}">
                    </td>
                    <td class="px-4 py-4 text-sm text-check-blue font-bold dark:text-gray-300 whitespace-nowrap">
                        <div wire:click="editar">
                            <a href="">EDITAR</a>
                        </div>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Div para la paginacion --}}
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links() }}
        </div>
        {{-- Fin Div paginacion --}}
    </div>
</div>