@php
    use Carbon\Carbon;
@endphp
<div class="p-5 mt-4">
    <h1 class="text-xl mb-4">Mantenimiento Preventivos</h1>
    <div class="py-5 mt-4">
        <div class="flex justify-between">
            <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
        </div>
    </div>
    {{-- Tabla Responsive para PC --}}
    <div class="overflow-auto rounded-lg shadow hidden md:block">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <div class="flex items-center gap-x-3">
                                    <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                                    <button class="flex items-center gap-x-2">
                                        <span>@lang('messages.tablas.ot')</span>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                @lang('messages.tablas.tecnico')
                            </th>

                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                @lang('messages.tablas.equipo')
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                @lang('messages.tablas.estatus')
                            </th>
                            <th scope="col" class="relative py-3.5 px-4">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($dataMp as $item)
                        <tr>
                            <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                <div class="flex items-center gap-x-2 mr-8">
                                    <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/admi.png') }}" alt="">
                                    <div>
                                        <h2 class="text-sm font-medium text-gray-800 dark:text-white ">{{ $item->otUid }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.fecha_inicio') {{ $item->fechaInicio }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.fecha_creado') {{ Carbon::parse($item->created_at)->format('d-m-Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            {{-- Tecnico Responsable --}}
                            <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                <div class="flex items-center gap-x-2 mr-8">
                                    <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/admi.png') }}" alt="">
                                    <div>
                                        <h2 class="text-sm font-medium text-gray-800 dark:text-white ">@lang('messages.tablas.res') {{ $item->tecRes_NomApe }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.super') {{ $item->owner }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center gap-x-2 mr-8">
                                    <div>
                                        <h2 class="text-sm font-bold text-gray-800 dark:text-white ">@lang('messages.tablas.equipo') {{ $item->equipoUid }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.agencia') {{ $item->agencia }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.estado') {{ $item->estado }}</p>
                                    </div>
                                </div>
                            </td>
                            {{-- Estatus de las Ordenes de trabajo --}}
                            @if($item->statusOts == '1')
                                <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                        <h2 class="text-sm font-normal">@lang('messages.estatus.creada')</h2>
                                    </div>
                                </td>
                            @endif
                            @if($item->statusOts == '2')
                                <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                          </svg>                                              
                                        <h2 class="text-sm font-normal">@lang('messages.estatus.aprobada')</h2>
                                    </div>
                                </td>
                            @endif
                            @if($item->statusOts == '3')
                                <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-orange-500 bg-orange-100/60 dark:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                        </svg>                                            
                                        <h2 class="text-sm font-normal">@lang('messages.estatus.ejecucion')</h2>
                                    </div>
                                </td>
                            @endif
                            @if($item->statusOts == '4')
                                <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-yellow-500 bg-yellow-100/60 dark:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                          </svg>                                              
                                        <h2 class="text-sm font-normal">@lang('messages.estatus.supervicion')</h2>
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

                            {{-- Cambio de estatus --}}
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                @if(Auth::user()->rol == 5 || Auth::user()->rol == 6)
                                <x-dropdown>
                                    <x-dropdown.item label="Aprobar" type="submit" wire:click="updateStatusAdmin({{ $item->id }}, '2')"/>
                                </x-dropdown>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Div para la paginacion --}}
                <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                    {{-- Paginacion --}}
                    {{ $dataMp->links('vendor.livewire.tailwind') }}
                </div>
                {{-- Fin Div paginacion --}}
    </div>

    {{-- Tabla Responsive para movil --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
        @foreach ($dataMp as $item)
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="mb-4">
                <h2 class="text-sm font-bold text-gray-800 dark:text-white ">@lang('messages.tablas.nro') {{ $item->otUid }}</h2>
                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.res') {{ $item->tecRes_NomApe }}</p>
                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.super') {{ $item->owner }}</p>
            </div>
            {{-- Orden de trabajo --}}
            <div class="flex items-center gap-x-2 mr-8">
                <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                <div class="mb-2">
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.fecha_inicio') {{ $item->fechaInicio }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.agencia') {{ $item->agencia }}</p>
                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">@lang('messages.tablas.estado') {{ $item->estado }}</p>
                </div>
            </div>

            <div class="flex justify-between mt-6">

                {{-- Estatus de las ordenes --}}
                <div>
                    {{-- Estatus de las Ordenes de trabajo --}}
                    @if($item->statusOts == '1')
                    
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <h2 class="text-sm font-normal">@lang('messages.estatus.creada')</h2>
                        </div>
                    
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
                            <h2 class="text-sm font-normal">@lang('messages.estatus.ejecucion')</h2>
                        </div>
                    
                    @endif
                    @if($item->statusOts == '4')
                    
                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-yellow-500 bg-yellow-100/60 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>                                              
                            <h2 class="text-sm font-normal">@lang('messages.estatus.supervicion')</h2>
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
                    @if(Auth::user()->rol == 5)
                        <button type="submit" wire:click="updateStatusAdmin({{ $item->id }}, '2')" class="text-yellow-800 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none"> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                </svg>                                              
                        </button>
                    @endif
                    @if(Auth::user()->rol == 6)
                        <button type="submit" wire:click="updateStatusSupervisor({{ $item ->id }}, '3')" class=" text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                </svg>                                              
                        </button>
                        <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '4')" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>                                               
                        </button>
                        <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '5')" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
            {{ $dataMp->links() }}
        </div>
    </div>
    
</div>


