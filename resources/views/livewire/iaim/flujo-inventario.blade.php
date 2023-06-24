    <div class="p-2">
        <h1 class="text-xl mb-4">Flujo de inventario</h1>
        <div class="py-5 mt-4">
            <div class="flex justify-between">
                <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
            </div>
        </div>
        <div class="overflow-auto rounded-lg shadow hidden md:block">
            <table class="w-full mt-12">
                <thead class="bg-check-blue">
                    <tr>
                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                            Código
                        </th>

                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                            Descripción
                        </th>

                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                            Entrada
                        </th>

                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                            Fecha Entrada
                        </th>

                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                            Salida
                        </th>

                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                            Fecha Salida
                        </th>

                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white max-[320px]:hidden max-[420px]:hidden xs:hidden sm:hidden md:hidden lg:table-cell">
                            Responsable:
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                    @foreach ($data as $item)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->codigo }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->descripcion }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->entrada }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->fecha_entrada }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->salida }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->fecha_salida }}</td>
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

        {{-- Table para mobile app --}}
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 md:hidden">
            @foreach ($data as $item)
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center justify-between mb-6">
                    <img class="object-cover w-auto h-7" src="{{ asset('images/iaim/iaim-logo.png') }}" alt="">
                </div>
                <div class="text-sm font-bold text-gray-800">Codigo: {{ $item->codigo }}</div>
                <div class="text-sm font-medium text-gray-800">Descripcion: {{ $item->descripcion }}</div>
                <div class="text-sm font-medium text-gray-800">Categoria: {{ $item->categoria }}</div>
                <div class="text-sm font-bold text-green-800 mt-2">Movimientos inventario</div>
                <div class="text-sm font-medium text-blue-500">Entrada: {{ $item->entrada }}</div>
                <div class="text-sm font-medium text-blue-500">Fecha: {{ $item->fecha_entrada }}</div>
                <div class="text-sm font-medium text-red-500 mt-2">Salida: {{ $item->salida }}</div>
                <div class="text-sm font-medium text-red-500">Fecha: {{ $item->fecha_salida }}</div>
            </div>
            @endforeach
            <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                {{-- Paginacion --}}
                {{ $data->links() }}
            </div>
        </div>
    </div>


    
