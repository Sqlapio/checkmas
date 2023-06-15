@php
    use Carbon\Carbon;
@endphp
<div class="p-5">
    <div class="{{ $atr_tabla_ticket }}">
        <h1 class="text-xl mb-4">Listado de Tikects</h1>
        <div class="py-5 mt-4">
            <div class="flex justify-between">
                <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
                {{-- <x-status /> --}}
            </div>
        </div>

        {{-- div tabla tickets --}}
        <div class="overflow-auto rounded-lg shadow hidden md:block">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <div class="flex items-center gap-x-3">
                                    <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                                    <button class="flex items-center gap-x-2">
                                        <span>@lang('messages.tablas.ticket')</span>
                                        <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                            <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                            <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                        </svg>
                                    </button>
                                </div>
                            </th>

                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <div class="flex items-center gap-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <button class="flex items-center gap-x-2">
                                        <span>@lang('messages.tablas.ubicacion')</span>
                                    </button>
                                </div>
                            </th>   

                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                @lang('messages.tablas.observacion')
                            </th>  

                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <div class="flex items-center gap-x-3">
                                    <span>@lang('messages.tablas.estatus')</span>
                                    <button wire:click="filtro('status_tikect')" class="flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-up-alt" viewBox="0 0 16 16"> <path d="M3.5 13.5a.5.5 0 0 1-1 0V4.707L1.354 5.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 4.707V13.5zm4-9.5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/> </svg>
                                    </button>
                                </div>
                            </th>
                            
                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($data as $item)
                        <tr>
                            <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                <div class="flex items-center gap-x-2">
                                    <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                                    <div>
                                        <h2 class="text-sm font-medium text-gray-800 dark:text-white ">{{ $item->tikect_uid }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.creadopor') {{ $item->owner }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.fecha_creado') {{ Carbon::parse($item->created_at)->format('d-m-Y') }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.correo') {{ $item->owner_email }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.servicio') {{ $item->tipoServicio }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                <div class="flex items-center gap-x-2">
                                    <div>
                                        <p class="text-xs font-bold text-gray-600 dark:text-gray-400">@lang('messages.tablas.agencia') {{ $item->agencia }}</p>
                                        <p class="text-xs font-bold text-gray-600 dark:text-gray-400">@lang('messages.tablas.estado') {{ $item->estado }}</p>
                                    </div>
                                </div>
                            </td>
        
                            <td class="w-1/4 px-4 pr-12 py-4 text-sm text-gray-500 text-justify dark:text-gray-300">{{ $item->observaciones }}</td>

                            @if($item->status_tikect == '0')
                            <td class="w-1/6 px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    <h2 class="text-sm font-normal">@lang('messages.estatus.abierto')</h2>
                                </div>
                            </td>
                            @endif

                            @if($item->status_tikect == '1')
                            <td class="w-1/6 px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-red-500 bg-red-100/60 dark:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    <h2 class="text-sm font-normal">@lang('messages.estatus.cerrado')</h2>
                                </div>
                            </td>
                            @endif

                            {{-- Menu --}}
                            <td class="px-4 py-4 text-sm text-gray-500 text-justify dark:text-gray-300">
                                <x-dropdown>

                                    @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                                        @if($item->status_tikect == 0)
                                            <x-dropdown.item label="Asignar OT" wire:click="CrearOt({{ $item->id }})"/>
                                        @endif
                                    @endif

                                    @if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3)
                                        @if($item->status_tikect == 0)
                                            <x-dropdown.item label="Cerrar" type="submit" wire:click="updateStatusTikect({{ $item->id }}, '1')"/>
                                        @endif
                                    @endif

                                    <x-dropdown.item label="Eliminar" wire:click="eliminar({{ $item->id }})"/>

                                </x-dropdown>
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
    
    {{-- Tabla Responsive para movil --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
        @foreach ($data as $item)
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center gap-x-2">
                <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                <div>
                    <h2 class="text-sm font-medium text-gray-800 dark:text-white ">{{ $item->tikect_uid }}</h2>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.creadopor') {{ $item->owner }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.correo') {{ $item->owner_email }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.servicio') {{ $item->tipoServicio }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.agencia') {{ $item->agencia }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.estado') {{ $item->estado }}</p>
                    {{-- <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Razon: {{ $item->observaciones }}</p> --}}
                </div>
            </div>
            <div class="flex justify-between mt-6">

                {{-- Estatus de tikects --}}
                @if($item->status_tikect == '0')

                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <h2 class="text-sm font-normal">@lang('messages.estatus.abierto')</h2>
                </div>

                @endif
                @if($item->status_tikect == '1')

                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-red-500 bg-red-100/60 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <h2 class="text-sm font-normal">@lang('messages.estatus.cerrado')</h2>
                </div>

                @endif
                @if($item->status_tikect == '2')

                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-orange-500 bg-orange-100/60 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="text-sm font-normal">@lang('messages.estatus.anulado')</h2>
                </div>

                @endif

                {{-- Cambio de estatus --}}
                @if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3)
                    <button type="submit" wire:click="updateStatusTikect({{ $item->id }}, '1')" class="px-2 py-2 rounded-full bg-red-100/60 text-red-800 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </button>
                @endif
                @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                    <div wire:click="CrearOt({{ $item->id }})" class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-check-green bg-blue-100/60 dark:bg-gray-800 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        <h2 class="text-sm font-normal">@lang('messages.tablas.asignar')</h2>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links() }}
        </div>
    </div>

    {{-- formulario cierre de tickets --}}
    <div class="border border-gray-200 rounded-lg shadow-md px-4" {{ $atr_form }}>
        {{-- Datos Orden de trabajo --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Nro. de ticket</label>
                <x-input icon="pencil" wire:model="nro_ticket" class="focus:ring-check-blue focus:border-check-blue cursor-none"/>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Observaciones</label>
                <x-textarea wire:model="observaciones_cierre" placeholder="Por favor indique cual es su Incidencia de forma Detallada" class="focus:ring-check-blue focus:border-check-blue" />
            </div>
        </div>
        {{-- Boton de registro --}}
        <div class="flex items-center justify-end mt-8 mb-8">
            <button type="submit" wire:click.prevent="actualiza_estatus()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="actualiza_estatus" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span>Cerrar ticket</span>
            </button>
        </div>
    </div>
    
    {{-- Componente para crear la orden de trabajo --}}
    <div class="{{ $atr_form_otsTicket }}">
        @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
        @livewire('view.orden-trabajo')
        @endif
    </div>
</div>

