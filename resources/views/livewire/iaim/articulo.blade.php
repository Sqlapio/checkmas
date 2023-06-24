@php
use App\Models\Iaim_Categoria;
$categorias = Iaim_Categoria::all();
@endphp
<div class="p-5">
    <h1 class="text-xl mb-4">Carga de productos con inventario</h1>
    <div class="py-5 mt-4">
        <div class="flex justify-between">
            <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
        </div>
    </div>
    <div class="overflow-auto rounded-lg shadow md:block">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-4 mt-8">
            {{-- Descripcion --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Descripción</label>
                <x-input icon="pencil" wire:model.defer="descripcion"  class="focus:ring-check-blue focus:border-check-blue valLetras"/>
            </div>
            {{-- categoria --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Categoría</label>
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
                <x-input icon="pencil" wire:model.defer="precio_unitario"  class="focus:ring-check-blue focus:border-check-blue cantidad"/>
            </div>
            {{-- stock --}}
            <div class="p-2" x-data="{ count: 0 }">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Mínimo stock</label>
                <x-inputs.number wire:model.defer="cantidad_minima" class="number"/>
            </div>
            <div class="p-2 mt-auto">
                <button type="submit" wire:click.prevent="store()" class="w-full justify-end rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span>CARGAR</span>
                </button>
            </div>
        </div>
        

        <table class="w-full mt-6">
            <thead class="bg-check-blue">
                <tr>
                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Código
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                        Descripción
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white max-[320px]:hidden max-[420px]:hidden xs:hidden sm:hidden md:hidden lg:table-cell">
                        Categoría
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

                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white max-[320px]:hidden max-[420px]:hidden xs:hidden sm:hidden md:hidden lg:table-cell">
                        Cargado por:
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                @foreach ($data as $item)
                <tr>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->codigo }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->descripcion }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap max-[320px]:hidden max-[420px]:hidden xs:hidden sm:hidden md:hidden lg:table-cell">{{ $item->categoria }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->precio_unitario }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->cantidad_minima }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ App\Http\Controllers\UtilsController::total_existe($item->codigo) }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap max-[320px]:hidden max-[420px]:hidden xs:hidden sm:hidden md:hidden lg:table-cell">{{ $item->usuario_responsable }}</td>
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
    <script>
        $('.number').on('input', function () { 
            this.value = this.value.replace(/[.,]/g,'');
        });
        $('.cantidad').on('input', function () { 
            this.value = this.value.replace(/[^1-9.,]/g,'');
        });
    </script>
</div>