@php
use App\Models\Iaim_Categoria;
$categorias = Iaim_Categoria::all();
@endphp
<div class="p-5">
    <h1 class="text-xl mb-4">Carga de productos de invantario</h1>
    <div class="py-5 mt-4">
        <div class="flex justify-between">
            <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
        </div>
    </div>
    <div class="overflow-auto rounded-lg shadow md:block">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-4 mt-8">
            {{-- Descripcion --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Descripcion</label>
                <x-input icon="pencil" wire:model.defer="descripcion"  class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            {{-- categoria --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Categoria</label>
                <x-native-select wire:model.defer="categoria" class="focus:ring-check-blue focus:border-check-blue">
                    <option value="">...</option>
                        @foreach($categorias as $item)
                            <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
                        @endforeach
                </x-native-select>
            </div>
            {{-- proveedor --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Proveedor</label>
                <x-input icon="pencil" wire:model.defer="proveedor"  class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            {{-- precio unitario --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Precio Unitario</label>
                <x-input icon="pencil" wire:model.defer="precio_unitario"  class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            {{-- stock --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Minimo stock</label>
                <x-input icon="pencil" wire:model.defer="cantidad_minima"  class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2 mt-auto">
                <button type="submit" wire:click.prevent="store()" class="w-full justify-end rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span>CARGAR PRODUCTO</span>
                </button>
            </div>
        </div>
        

        <table class="w-full mt-12">
            <thead class="bg-check-blue">
                <tr>
                    <th scope="col" class="py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white">
                        <div class="flex items-center gap-x-3">
                            <button class="flex items-center gap-x-2">
                                <span class="ml-1">ID Aticulo</span>
                                <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                    <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                    <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                </svg>
                            </button>
                        </div>
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Codigo
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Descripcion
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Categoria
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Precio Unitario
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Stock
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Total existencia
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Cargado por:
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                @foreach ($data as $item)
                <tr>
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                        <div class="inline-flex items-center gap-x-3 ">
                            <span>{{ $item->id }}</span>  
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->codigo }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->descripcion }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->categoria }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->precio_unitario }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->cantidad_minima }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ App\Http\Controllers\UtilsController::total_existe($item->codigo) }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->usuario_responsable }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Div para la paginacion --}}
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links() }}
        </div>
    </div>
</div>