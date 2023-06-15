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
        <table class="w-full table-auto">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <div class="flex items-center gap-x-3">
                            <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                            <button class="flex items-center gap-x-2">
                                <span>@lang('messages.tablas.ot')</span>
                                <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                    <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                    <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                </svg>
                            </button>
                        </div>
                    </th>
                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.tecnico')
                    </th>
                    @endif
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.equipo')
                    </th>
                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.costoOper')
                    </th>
                    @endif
                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.pre_cli')
                    </th>
                    @else
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.presupuesto')
                    </th>
                    @endif
                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.tir')
                    </th>
                    @endif
                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.estatus')
                    </th>
                    @else
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.estatusOt')
                    </th>
                    @endif
                    
                    <th scope="col" class="content-center px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <img class="object-cover ml-6 w-auto h-6" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
                    </th>

                    {{-- @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @lang('messages.tablas.accion')
                    </th>
                    @endif --}}
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                @foreach ($data as $item)
                <tr>
                    {{-- Orden de trabajo --}}
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                        <div class="flex items-center gap-x-2 mr-8">
                            <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                            <div>
                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">{{ $item->otUid }}</h2>
                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.creadopor') {{ $item->owner_tikect }}</p>
                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.t_nro') {{ $item->tikect_id }}</p>
                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.fecha_inicio') {{ $item->fechaInicio }}</p>
                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.fecha_creado_ot'): {{ Carbon::parse($item->created_at)->format('d-m-Y') }}</p>
                            </div>
                        </div>
                    </td>


                    {{-- Fecha Incio --}}
                    {{-- <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->fechaInicio }}</td> --}}

                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    {{-- Tecnico Responsable --}}
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                        <div class="flex items-center gap-x-2 mr-8">
                            <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/admi.png') }}" alt="">
                            <div>
                                <h2 class="text-sm font-medium text-gray-800 dark:text-gray-400">@lang('messages.tablas.res') {{ $item->tecRes_NomApe }}</h2>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">@lang('messages.tablas.super') {{ $item->tecRes_email }}</p>
                            </div>
                        </div>
                    </td>
                    @endif

                    {{-- Equipo --}}
                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <div class="flex items-center gap-x-2 mr-8">
                            <div>
                                <h2 class="text-sm font-bold text-gray-800 dark:text-white ">@lang('messages.tablas.equipo'): {{ $item->equipoUid }}</h2>
                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.agencia') {{ $item->agencia }}</p>
                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.estado') {{ $item->estado }}</p>
                            </div>
                        </div>
                    </td>


                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    {{-- Costo Operacional --}}
                    <td class="px-4 py-4 text-sm text-check-blue font-bold dark:text-gray-300 ">
                        <div class="flex items-center justify-between gap-x-2">
                            <button class="flex text-check-blue font-bold transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                ${{ number_format($item->costo_oper, 2, ',', '.') }}
                            </button>
                            <a class="flex text-check-blue  transition-colors duration-200 hover:text-check-green focus:outline-none" href="{{ asset('/storage/'.$item->pdf_pre_oper) }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </a>
                        </div>
                    </td>

                    @endif

                    {{-- Costo Cliente --}}
                    <td class="px-4 py-4 w-8 text-sm whitespace-nowrap">
                        <div class="flex items-center justify-between gap-x-2">
                            <button class="flex text-check-blue font-bold transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                ${{ number_format($item->costo_preCli, 2, ',', '.') }}
                            </button>
                            <a class="flex text-check-blue  transition-colors duration-200 hover:text-check-green focus:outline-none" href="{{ asset('/storage/'.$item->pdf_pre_preCli) }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </a>
                        </div>
                    </td>

                    {{-- TIR --}}
                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <td class="px-4 py-4 text-sm text-check-blue font-bold dark:text-gray-300 whitespace-nowrap">{{ number_format($item->tir, 2, ',', '.') }}%</td>
                    @endif


                    {{-- Estatus de las Ordenes de trabajo --}}
                    @if($item->statusOts == '1')
                    <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h2 class="text-sm font-normal">@lang('messages.estatus.creada')</h2>
                        </div>
                    </td>
                    @endif

                    @if($item->statusOts == '2')
                    <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                            </svg>
                            <h2 class="text-sm font-normal">@lang('messages.estatus.aprobada')</h2>
                        </div>
                    </td>
                    @endif

                    @if($item->statusOts == '3')
                    <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-orange-500 bg-orange-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                            </svg>
                            <div class="flex items-center gap-x-2 mr-8">
                                <div>
                                    <h2 class="text-sm font-bold text-orange-500 dark:text-white ">@lang('messages.estatus.ejecucion')</h2>
                                    <p class="text-xs text-orange-500 dark:text-gray-400">Orden de trabajo<br>en ejecución</p>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif

                    @if($item->statusOts == '4')
                    <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center px-2 py-1 rounded-full gap-x-2 text-yellow-500 bg-yellow-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <div class="flex items-center gap-x-2 mr-8">
                                <div>
                                    <h2 class="text-sm font-bold text-yellow-500 dark:text-white ">@lang('messages.estatus.supervicion')</h2>
                                    <p class="text-xs font-normal text-yellow-500 dark:text-gray-400">Orden de trabajo<br>esta en supervisión</p>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif

                    @if($item->statusOts == '5')
                    <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                        <div class="inline-flex items-center font-bold px-3 py-1 rounded-full gap-x-2 text-green-700 bg-green-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                            <h2 class="text-sm font-normal">@lang('messages.estatus.finalizada')</h2>
                        </div>
                    </td>
                    @endif

                    {{-- Estatus banco --}}
                    @if($item->statusOts_banco == '1')
                    <td class=" content-center px-4 py-4 text-sm font-medium text-gray-700 ">
                        <div wire:click="updateStatusBanco({{ $item->id }}, '1')" class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-orange-500 bg-orange-100/60 dark:bg-gray-800 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>

                            <h2 class="text-sm font-normal">@lang('messages.estatus.poraprobacion')</h2>
                        </div>
                    </td>
                    @endif
                    
                    @if($item->statusOts_banco == '2')
                    <td class="content-center px-4 py-4 text-sm font-medium text-gray-700 ">
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                            </svg>
                            <h2 class="text-sm font-normal">@lang('messages.estatus.aprobada')</h2>
                        </div>
                    </td>
                    @endif

                    {{-- Acciones para cambiar los estatus --}}
                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                        <x-dropdown>
                            @if($item->statusOts == '1')
                            <x-dropdown.item label="Aprobar OT" type="submit" wire:click="updateStatusAdmin({{ $item->id }}, '2')"/>
                            @endif
                            <x-dropdown.item label="Eliminar" type="submit" wire:click="eliminar({{ $item->id }})"/>
                        </x-dropdown>
                    </td>
                    @endif

                    
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Div para la paginacion --}}
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links('vendor.livewire.tailwind') }}
        </div>
        {{-- Fin Div paginacion --}}
    </div>

    {{-- Tabla Responsive para movil --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
        @foreach ($data as $item)
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="mb-3">
                <h2 class="text-sm font-bold text-gray-800 dark:text-white ">@lang('messages.tablas.nro') {{ $item->otUid }}</h2>
                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.por'): {{ $item->owner_tikect }}</p>
            </div>
            {{-- Orden de trabajo --}}
            <div class="flex justify-between items-center gap-x-2 mr-8">
                <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                <div>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.t_nro') {{ $item->tikect_id }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.fecha_inicio') {{ $item->fechaInicio }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.agencia') {{ $item->agencia }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.estado'){{ $item->estado }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-gray-800 dark:text-white ">@lang('messages.tablas.costo')</h2>
                    @if (Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <p class="text-xs font-normal text-gray-600 dark:text-white ">@lang('messages.tablas.oper'): ${{ number_format($item->costo_oper, 2, ',', '.') }}</p>
                    @endif

                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.cli'): ${{ number_format($item->costo_preCli, 2, ',', '.') }}</p>

                    @if (Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.tir_mobile'): {{ number_format($item->tir, 2, ',', '.') }}</p>
                    @endif
                </div>
            </div>

            <div class="flex justify-between mt-6">

                {{-- Estatus de las ordenes --}}
                <div class="mt-2">
                    @if($item->statusOts == '1')
                    @if(Auth::user()->rol == 5)
                    <div wire:click="updateStatusAdmin({{ $item->id }}, '2')" class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-sm font-normal">@lang('messages.estatus.creada')</h2>
                    </div>
                    @else
                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-sm font-normal">@lang('messages.estatus.creada')</h2>
                    </div>
                    @endif
                    @endif

                    @if($item->statusOts == '2')

                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                        </svg>
                        <h2 class="text-sm font-normal">@lang('messages.estatus.aprobada')</h2>
                    </div>

                    @endif

                    @if($item->statusOts == '3')

                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-orange-500 bg-orange-100/60 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                        </svg>
                        <div class="flex items-center gap-x-2">
                            <div>
                                <h2 class="text-sm font-bold text-orange-500 dark:text-white ">@lang('messages.estatus.ejecucion')</h2>
                            </div>
                        </div>
                    </div>

                    @endif

                    @if($item->statusOts == '4')

                    <div class="inline-flex items-center px-2 py-1 rounded-full gap-x-2 text-yellow-500 bg-yellow-100/60 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <div class="flex items-center gap-x-2">
                            <div>
                                <h2 class="text-sm font-bold text-yellow-500 dark:text-white ">@lang('messages.estatus.supervicion')</h2>
                            </div>
                        </div>
                    </div>

                    @endif

                    @if($item->statusOts == '5')

                    <div class="inline-flex items-center font-bold px-3 py-1 rounded-full gap-x-2 text-green-700 bg-green-100/60 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                        <h2 class="text-sm font-normal">@lang('messages.estatus.finalizada')</h2>
                    </div>

                    @endif
                </div>

                {{-- Estatus de la OT en el Cliente --}}
                <div>
                    @if($item->statusOts_banco == '1')
                    <div wire:click="updateStatusBanco({{ $item->id }}, '1')" class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-orange-500 bg-orange-100/60 dark:bg-gray-800 cursor-pointer">
                        <img class="object-cover ml-2 my-2 w-auto h-4" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
                        <h2 class="text-sm font-normal">@lang('messages.estatus.poraprobacion')</h2>
                    </div>
                    @endif
                    @if($item->statusOts_banco == '2')
                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                        <img class="object-cover ml-2 my-2 w-auto h-4" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
                        <h2 class="text-sm font-normal">@lang('messages.estatus.aprobada')</h2>
                    </div>
                    @endif
                </div>

            </div>

            <div class="flex items-center justify-start ml-4">
                {{-- Acciones --}}
                <div class="mt-2">
                    @if(Auth::user()->rol == 6)
                    <button type="submit" wire:click="updateStatusSupervisor({{ $item ->id }}, '3')" class=" text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                        </svg>
                    </button>
                    <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '4')" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </button>
                    <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '5')" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links() }}
        </div>
    </div>
</div>


