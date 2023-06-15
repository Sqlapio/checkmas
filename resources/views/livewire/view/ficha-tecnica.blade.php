<div>
    <div class="p-6 border bg-white border-gray-200 rounded-lg shadow-md dark:bg-gray-700 dark:border-gray-600" {{ $atr_form }}>
        <div class="items-center justify-start mb-8 mt-4 sm:flex">
            <time class="mb-1 text-2xl font-extrabold text-blue-900 drop-shadow-lg sm:order-last sm:mb-0">FICHA TECNICA</time>
        </div>
    
        <div class="border border-gray-200 rounded-lg shadow-md px-4">
            {{-- Titulo Codensadora --}}
            <div class="p-2">
                <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.condensadora')</label>
            </div>
            {{-- QR y Type Condensadora --}}
            <div class="flex flex-wrap justify-star">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.numQR')</label>
                    <x-conden />
                </div>
                <div class="p-2 {{ $atr_select_tipo_sistema }}">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.tipo')</label>
                    <x-native-select wire:model="tipoConden" wire:change="$emit('tipo_servicio', $event.target.value)" class="w-32 focus:ring-check-blue focus:border-check-blue">
                        <option></option>
                        <option value="compacto">@lang('messages.label.compacto')</option>
                        <option value="fancoil">@lang('messages.label.fancoil')</option>
                        <option value="split">@lang('messages.label.split')</option>
                        <option value="gabinete">@lang('messages.label.gabinete')</option>
                        <option value="otro">@lang('messages.label.otro')</option>
                    </x-native-select>
                </div>
                <div class="p-2 {{ $atr_otro_servicio }}">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Otro tipo de sistema</label>
                    <x-input wire:model="otroServicio" class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
            </div>
            {{-- Form Condensadora --}}
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.voltaje')</label>
                        <x-native-select wire:model="voltaje" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="110V">110V</option>
                            <option value="220V">220V</option>
                            <option value="380V">380V</option>
                            <option value="440V">440V</option>
                        </x-native-select>
                    </div>
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.phases')</label>
                        <x-native-select wire:model="phases" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="1PH">1PH</option>
                            <option value="3PH">3PH</option>
                        </x-native-select>
                    </div>
                    <div class="p-2 {{ $atr_select_tipo_refri }}">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.refri')</label>
                        <x-native-select wire:model="tipoRefri" wire:change="$emit('otro_tipo_refri', $event.target.value)" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="R22">R22</option>
                            <option value="R410A">R410A</option>
                            <option value="otro">Otro</option>
                        </x-native-select>
                    </div>
                    <div class="p-2 {{ $atr_otro_tipo_refri }}">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Otro tipo de refrigerante</label>
                        <x-input wire:model="otroTipoRefri" class="focus:ring-check-blue focus:border-check-blue"/>
                    </div>
                    <div class="p-2 {{  $atr_select_tipo_btu  }}">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.BTU')</label>
                        <x-native-select wire:model="btu" wire:change="$emit('otro_btu', $event.target.value)" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="1">1</option>
                            <option value="1.50">1.50</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="7.50">7.50</option>
                            <option value="10">10</option>
                            <option value="12">12</option>
                            <option value="15">15</option>
                            <option value="40">40</option>
                            <option value="140">140</option>
                            <option value="otro">Otro</option>
                        </x-native-select>
                    </div>
                    <div class="p-2 {{ $atr_otro_btu }}">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Otro BTU</label>
                        <x-input wire:model="otroBtu" class="focus:ring-check-blue focus:border-check-blue valNumber"/>
                    </div>
                </div>
            </div>
    
            {{-- COMPRESOR --}}
            <div class="border border-gray-200 rounded-lg shadow-md px-4">
                {{-- Title Compresor --}}
                <div class="p-2">
                    <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.compresor')</label>
                </div>
                {{-- Form Cmpresar --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.tipo')</label>
                        <x-native-select wire:model="tipoCompresor" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="scroll">@lang('messages.label.scroll')</option>
                            <option value="piston">@lang('messages.label.piston')</option>
                        </x-native-select>
                    </div>
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.marca')</label>
                        <x-input icon="pencil" wire:model="marcaCompresor" class="focus:ring-check-blue focus:border-check-blue" />
                    </div>
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.amp')</label>
                        <x-input icon="pencil" wire:model="ampCompresor" class="focus:ring-check-blue focus:border-check-blue"/>
                    </div>
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.placa')</label>
                        <input id="" wire:model="imgPlacaCompresor" type="file" class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-green-50 file:text-check-blue
                        hover:file:bg-green-100">
                        @error('imgPlacaCompresor') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
    
    
            {{-- Title Ventilador --}}
            <div class="p-2">
                <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.ventilador')</label>
            </div>
            {{-- Form Cmpresar --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.tipo')</label>
                    <x-native-select wire:model="tipoVentilador" class="focus:ring-check-blue focus:border-check-blue">
                        <option></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="otro">@lang('messages.label.otro')</option>
                    </x-native-select>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.etiqueta')</label>
                    <input id="" wire:model="imgEtiqVentilador" type="file" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-green-50 file:text-check-blue
                    hover:file:bg-green-100">
                    @error('imgEtiqVentilador') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    
        <div class="border border-gray-200 rounded-lg shadow-md px-4 mt-8 mb-4" {{ $atr }}>
            {{-- Title Evaporador --}}
            <div class="p-2">
                <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.evaporador') - {{ $label }} - @lang('messages.label.uInter')</label>
            </div>
            <div class="flex flex-wrap justify-star">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.numQR')</label>
                    <x-evaporador />
                </div>
                <div class="p-2 ml-8">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.representativa')</label>
                    <input id="" wire:model="imgEvaporador" type="file" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-green-50 file:text-check-blue
                    hover:file:bg-green-100">
                    @error('imgEvaporador') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    
        {{-- UBICACION --}}
        <div class="border border-gray-200 rounded-lg shadow-md px-4 mt-8">
            {{-- Title Ubicacion --}}
            <div class="p-2">
                <label class="text-xs font-extrabold text-black drop-shadow-lg">@lang('messages.label.ubicacion')</label>
            </div>
            {{-- Form Ubicacion --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.oficina')</label>
                    <x-input icon="pencil" wire:model="oficina" class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.piso')</label>
                    <x-input icon="pencil" wire:model="piso" class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.agencia')</label>
                    <x-agencias />
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.estado')</label>
                    <x-estados />
                </div>
            </div>
        </div>
    
        <div class="flex items-center justify-end mt-8 mb-8">
            <x-boton />
        </div>
    </div>
    
    {{-- Tabla Equipos --}}
    <div class="flex flex-col sm:flex">
        <div class="mx-4 -my-2 overflow-x-auto sm:mx-4 lg:-mx-8" {{ $atr_table }}>
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <h1 class="font-bold text-2xl text-gray-700 drop-shadow-lg">Equipos</h1>
                <div class="py-5 mt-4">
                    <div class="flex justify-between">
                        <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
                        <button wire:click="viewForm" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="viewForm" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg> --}}
                            <span> + AGREGAR</span>
                        </button>
                    </div>
                </div>
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg shadow-lg mb-8">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                          </svg>
                                          
                                        <button wire:click="order" class="flex items-center gap-x-2">
                                            <span>Nro. de Equipo</span>
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </div>
                                </th>
                                
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Condensadora
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Voltaje
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Fases
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Refrigerante
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    BTU
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Compresor
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Marca
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Compresor(AMP)
                                </th>
    
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    QR
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Imagenes
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                    <a href="{{ route('reporte.ficha-tecnica', $item->id) }}">
                                        <div class="inline-flex items-center gap-x-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                              </svg>
                                            <span>{{ $item->uid }}</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->tipoConden }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->voltaje }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->phases }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->tipoRefri }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->btu }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->tipoCompresor }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->marcaCompresor }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->ampCompresor }}</td>
                                
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                           <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                                           <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                                        </svg> 
                                        <div>
                                            @if($item->tipoConden == 'compacto')
                                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">con: {{ $item->qrConden }}</h2>
                                            @endif
                                            @if($item->tipoConden != 'compacto')
                                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">con: {{ $item->qrConden }}</h2>
                                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">eva: {{ $item->qrEvaporador }}</p>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        @if($item->tipoConden == 'compacto')
                                            <a class="ml-8" href="{{ asset('/storage/'.$item->imgPlacaCompresor) }}" target="_blank">Con
                                                <img src="{{ asset('/storage/'.$item->imgPlacaCompresor) }}" class="w-8 h-8"/>
                                            </a>
                                            <a href="{{ asset('/storage/'.$item->imgEtiqVentilador) }}" target="_blank" >Ven
                                                <img src="{{ asset('/storage/'.$item->imgEtiqVentilador) }}" class="w-8 h-8"/>
                                            </a>
                                        @endif
                                        @if($item->tipoConden != 'compacto')
                                            <a class="ml-8" href="{{ asset('/storage/'.$item->imgPlacaCompresor) }}" target="_blank">Con
                                                <img src="{{ asset('/storage/'.$item->imgPlacaCompresor) }}" class="w-8 h-8"/>
                                            </a>
                                            <a href="{{ asset('/storage/'.$item->imgEtiqVentilador) }}" target="_blank" >Ven
                                                <img src="{{ asset('/storage/'.$item->imgEtiqVentilador) }}" class="w-8 h-8"/>
                                            </a>
                                            <a href="{{ asset('/storage/'.$item->imgEvaporador) }}" target="_blank" >Eva
                                                <img src="{{ asset('/storage/'.$item->imgEvaporador) }}" class="w-8 h-8"/>
                                            </a>
                                        @endif
                                          
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
        </div>
    </div>
</div>

