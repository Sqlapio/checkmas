<div class="p-2">
    <h1 class="text-xl mb-4">Usuarios activos</h1>

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
                        @lang('messages.tablas.nombre')
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.cargo')
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.empresa')
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.estatus')
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Ultima conexión
                    </th>

                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Total conexiones
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900 ">
                @foreach ($data as $item)
                <tr>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->nombre }} {{ $item->apellido }}</td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->cargo }}</td>
                    @if($item->empresa == 'Trx')
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                        <img class="object-cover w-16 h-auto" src="{{ asset('images/logo-trx.png') }}" alt="">
                    </td>
                    @endif
                    @if($item->empresa == 'Banco del Tesoro')
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                        <img class="object-cover w-auto h-7" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
                    </td>
                    @endif
                    @if($item->empresa == 'IAIM')
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                        <img class="object-cover w-auto h-7" src="{{ asset('images/iaim/iaim-logo.png') }}" alt="">
                    </td>
                    @endif
                    {{-- Estatus de usuarios --}}
                    @if($item->activo == '0')
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-red-500 bg-red-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                              </svg>                                                            
                            <h2 class="text-sm font-normal">Inactivo</h2>
                        </div>
                    </td>
                    @else
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                              </svg>                                                                                          
                            <h2 class="text-sm font-normal">Activo</h2>
                        </div>
                    </td>
                    @endif
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-check-blue bg-yellow-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                              </svg>                                                                                                                      
                            <h2 class="text-sm font-normal">{{ $item->ultima_conexion }}</h2>
                        </div>
                    </td>
                    
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                                                                                                                       
                            <h2 class="text-sm font-normal">{{ $item->contador }}</h2>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Div para la paginacion --}}
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links('vendor.livewire.tailwind') }}
        </div>
    </div>

    {{-- Table para mobile app --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
        @foreach ($data as $item)
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between mb-6">
                @if($item->empresa == 'Trx')
                <img class="object-cover w-20 h-auto" src="{{ asset('images/logo-trx.png') }}" alt="">
                @endif
                @if($item->empresa == 'Banco del Tesoro')
                <img class="object-cover w-auto h-7" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
                @endif
                @if($item->empresa == 'IAIM')
                <img class="object-cover w-auto h-7" src="{{ asset('images/iaim/iaim-logo.png') }}" alt="">
                @endif
                <div class="text-sm font-bold text-right text-gray-700">{{ $item->cargo }}</div>
            </div>
            <div class="text-sm font-bold text-gray-700">Nombre: {{ $item->nombre }} {{ $item->apellido }}</div>
            @if ($item->activo == '0')
            <div class="text-sm font-bold text-red-700">Estatus: Inactivo</div>
            @else
            <div class="text-sm font-bold text-green-700">Estatus: Activo</div> 
            @endif
            <div class="text-sm font-medium text-yellow-700">Ultima conexión: {{ $item->updated_at }}</div>
            <div class="text-sm font-medium text-yellow-500">Total Conexiones: {{ $item->contador }}</div>
        </div>
        @endforeach
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links() }}
        </div>
    </div>
</div>
