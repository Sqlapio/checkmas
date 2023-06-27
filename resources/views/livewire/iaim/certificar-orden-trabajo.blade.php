@php
use App\Models\Iaim_Articulo;
use App\Models\IaimOrdenTrabajo;
$articulos = Iaim_Articulo::all();
$ots = IaimOrdenTrabajo::where('status', '2')->get();
@endphp
<div class="contents">
    <div class="p-4 tabla_ots">

        <h1 class="text-xl mb-4 p-4">Finalizar orden de trabajo</h1>
        <div class="botton grid md:justify-items-end mt-5 {{ $atr_botton }}">
            {{-- Botton Finalizar orden --}}
            <div class="p-4 mt-auto">
                <button type="submit" wire:click.prevent="cert()" class="justify-end rounded-xl border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <span>
                        FINALIZAR ORDEN
                    </span>
                </button>
            </div>
        </div>

        {{-- CODIGO DE OT --}}
        <div class="py-5 mt-4 {{ $atr_tablas }}">
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-4 mb-4 mt-8">
                <div class="p-2 cursor-none">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Código:</label>
                    <x-native-select wire:model.defer="codigo_ot" wire:change="$emit('ot_selected', $event.target.value)" class="focus:ring-check-blue focus:border-check-blue">
                        <option value="">...</option>
                            @foreach($ots as $item)
                                <option value="{{ $item->codigo_ot }}">{{ $item->codigo_ot }}</option>
                            @endforeach
                    </x-native-select>
                </div>   
            </div>
        </div>

        {{-- FILTROS PARA LA TABLA PRINCIPAL --}}
        <div class="py-5 mt-4 hidden lg:block">
            {{-- Filtros --}}
            <div class="flex flex-wrap gap-x-5 gap-y-5 {{ $fil_hidden }}">
                <div class="p-2">
                    <label class="opacity-60 block text-sm font-medium text-italblue my-auto">Buscador</label>
                    <x-input wire:model="buscar" class="focus:ring-check-blue focus:border-check-blue md:w-60" placeholder="Buscar..."/>
                </div>
                
                <div class="p-2">
                    <label class="opacity-60 block text-sm font-medium text-italblue my-auto">Fecha inicio:</label>
                    <x-input wire:model="fil_fecha_ini" class="focus:ring-check-blue focus:border-check-blue md:w-60" type="date"/>
                </div>
                
                <div class="p-2">
                    <label class="opacity-60 block text-sm font-medium text-italblue my-auto">Fecha fin:</label>
                    <x-input wire:model="fil_fecha_fin" class="focus:ring-check-blue focus:border-check-blue md:w-60" type="date"/>
                </div>
                
                <div class="py-2 mt-auto">
                    <x-badge.circle lg icon="refresh" wire:click='reset_filtros'/>  
                </div>
                
            </div>
        </div>

        {{-- TABLA PRINCIPAL PARA LISTAR LAS OREDENES CERTIFICADAS --}}
        <div class="hidden lg:block">
            <div class="overflow-auto rounded-lg shadow {{ $atr_botton }}">
                <h1 class="text-lg mb-1 p-4">Listado de ordenes finalizadas</h1>
                <div class="tabla_ots" id="tabla_ot">
                    <table class="w-full">
                        <thead class="bg-check-blue">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <button class="flex items-center gap-x-2">
                                            <span class="ml-1">Codigo</span>
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Certificada por:
                                </th>
                                <th scope="col" class="w-20 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Fecha certificación
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Rango fechas
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Duración y personal
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Observaciones
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
    
                                </th>
    
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($data as $item)
                            <tr>
                                <td class="w-1/3 px-4 py-4 text-sm text-gray-500 text-justify dark:text-gray-300">
                                    <div class="flex items-center gap-x-2 mr-8">
                                        <div>
                                            <h2 class="text-xs font-bold text-gray-800 dark:text-white ">{{ $item->codigo_ot }}</h2>
                                            <h2 class="text-xs font-bold text-gray-800 dark:text-white ">Fecha certificacion: {{ $item->fecha_cer_ot }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Division: {{ $item->usr_cer_division }}</p>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Coordinacion: {{ $item->usr_cer_coordinacion }}</p>
                                            <div class="mt-2">
                                                    <x-badge emerald label="Finalizada" />
                                            </div>    
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2 mr-8">
                                        <div>
                                            <h2 class="text-xs font-bold text-gray-800 dark:text-white ">Nombre: {{ $item->usr_cer_nombre }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Cédula: {{ $item->usr_cer_cedula }}</p>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Cargor: {{ $item->usr_cer_cargo }}</p>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Firma: {{ $item->usr_cer_firma }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-1/4 px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">{{ $item->fecha_cer_ot }}</td>
                                <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2 mr-8">
                                        <div>
                                           
                                            <h2 class="text-xs font-bold text-gray-800 dark:text-white ">Fecha inicio: {{ $item->fecha_inicio_ot }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Fecha fin: {{ $item->fecha_fin_ot }}</p>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Cargo: {{ $item->usr_res_cargo }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2 mr-8">
                                        <div> 
                                            <h2 class="text-xs font-bold text-gray-800 dark:text-white ">Nro. días: {{ $item->can_dias }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Nro. trabajadores: {{ $item->can_trabajadores }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-1/4 px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">{{ $item->observaciones }}</td>
                                <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                    <x-dropdown>
                                        @if($item->status == '1')
                                            <x-dropdown.item label="Aprobar" wire:click.prevent="aprobar({{ $item->id }})" />
                                        @endif
                                        <x-dropdown.item label="Eliminar" />
                                        <x-dropdown.item label="imprimir" wire:click.prevent="imprimir({{ $item->id }})"/>
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
                </div>
            </div>
        </div>
        

        {{-- GRID DE TABLAS INPUTS --}}
        <div class="tablas p-4 {{ $atr_tablas }}">
            {{-- TABLA INPUTS 1 --}}
            <div class="tabla_inputs">
                <div class="overflow-auto rounded-lg shadow hidden lg:block">
                    <div class="tabla_ots" id="tabla_ot">
                        <table class="w-full">
                            <thead class="bg-check-blue">
                                <tr>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        División
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Coordinación
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Fecha
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr> 
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <x-input icon="pencil" wire:model.defer="usr_cer_division" class="cursor-none" disabled/>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                        <x-input icon="pencil" wire:model.defer="usr_cer_coordinacion" class="cursor-none" disabled/>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                        <x-input icon="pencil" wire:model.defer="fecha_cer_ot" class="cursor-none" disabled/>
                                    </td>    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- TABLA INPUTS 2 --}}
            <div class="tabla_inputs mt-5">
                <div class="overflow-auto rounded-lg shadow hidden lg:block">
                    <div class="tabla_ots" id="tabla_ot">
                        <table class="w-full">
                            <thead class="bg-check-blue">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span class="ml-1">Nombre completo</span>
                                            </button>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Cédula
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Cargo
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Firma
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr> 
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <x-input icon="pencil" wire:model.defer="usr_cer_nombre" class="cursor-none" disabled/>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                        <x-input icon="pencil" wire:model.defer="usr_cer_cedula" class="cursor-none" disabled/>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                        <x-input icon="pencil" wire:model.defer="usr_cer_cargo" class="cursor-none" disabled/>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                        <x-input icon="pencil" wire:model.defer="usr_cer_firma" class="cursor-none" disabled/>
                                    </td>    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- TABLA INPUTS 3  --}}
            <div class="tabla_inputs mt-5">
                <div class="overflow-auto rounded-lg shadow lg:block">
                    <div class="tabla_ots" id="tabla_ot">
                        <table class="w-full">
                            <thead class="bg-check-blue">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span class="ml-1">Fecha Aprobación</span>
                                            </button>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Fecha culminación
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr> 
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <x-input icon="pencil" wire:model.defer="fecha_inicio_ot" value="{{ $fecha_inicio_ot }}"/>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                        <x-input type="date" wire:model.defer="fecha_fin_ot" />
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- TABLA INPUTS 4  --}}
            <div class="tabla_inputs mt-5">
                <div class="overflow-auto rounded-lg shadow md:block">
                    <div class="tabla_ots" id="tabla_ot">
                        <table class="w-full">
                            <thead class="bg-check-blue">
                                <tr>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Días de trabajo
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Trabajadores
                                    </th>
                                    <th scope="col" class=" px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400 hidden lg:block">
                                        Observaciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr> 
                                    <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                        <x-inputs.number wire:model.defer="can_dias" class="number"/>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                        <x-inputs.number wire:model.defer="can_trabajadores" class="number"/>
                                    </td>  
                                    <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300 hidden lg:block">
                                        <x-input icon="pencil" placeholder="Observaciones y recomendaciones" wire:model.defer="observaciones"/>
                                    </td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- TABLA OBSERVACIONES - SOLO VISIBLE EN VISTAS MOBILE  --}}
            <div class="tabla_inputs mt-5 lg:hidden">
                <div class="overflow-auto rounded-lg shadow md:block">
                    <div class="tabla_ots" id="tabla_ot">
                        <table class="w-full">
                            <thead class="bg-check-blue">
                                <tr>
                                    <th scope="col" class=" px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Observaciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr>  
                                    <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                        <x-input icon="pencil" placeholder="Observaciones y recomendaciones" wire:model.defer="observaciones"/>
                                    </td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- TABLA INPUTS 4 FOTOS --}}
            <div class="tabla_inputs mt-5">
                <div class="overflow-auto rounded-lg shadow md:block">
                    <div class="tabla_ots" id="tabla_ot">
                        <table class="w-full">
                            <thead class="bg-check-blue">
                                <tr>
                                    <th scope="col" class="w-1/6 py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span class="ml-1">Fotos antes</span>
                                            </button>
                                        </div>
                                    </th>
                                    <th scope="col" class="w-1/6 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Fotos durante
                                    </th>
                                    <th scope="col" class="w-1/6 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                        Fotos despues
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr> 
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <div class="flex flex-col">
                                            <input id="" wire:model="foto_antes_1" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_antes_1') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>

                                            <input id="" wire:model="foto_antes_2" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_antes_2') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>

                                            <input id="" wire:model="foto_antes_3" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_antes_3') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <div class="flex flex-col">
                                            <input id="" wire:model="foto_durante_1" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_durante_1') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>

                                            <input id="" wire:model="foto_durante_2" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_durante_2') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>

                                            <input id="" wire:model="foto_durante_3" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_durante_3') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <div class="flex flex-col">
                                            <input id="" wire:model="foto_des_1" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_des_1') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>

                                            <input id="" wire:model="foto_des_2" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_des_2') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>

                                            <input id="" wire:model="foto_des_3" type="file" class="mb-1 block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-50 file:text-check-blue
                                            hover:file:bg-green-100">
                                            @error('foto_des_3') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                                            <p class="text-sm px-4 mb-4 font-extrabold text-check-blue">Foto ≤ 1024MB</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="botton grid justify-items-end mt-5 {{ $atr_tablas }}">
            {{-- Botton agregar materiales --}}
            <div class="p-2 mt-auto">
                <button type="submit" wire:click.prevent="store()" class="justify-end rounded-xl border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <span>
                        CERTIFICAR ORDEN DE TRABAJO
                    </span>
                </button>
            </div>
        </div>

        {{-- RESPONSIVE --}}
        {{-- ResponsiveBuscardor --}}
        <div class="flex justify-between p-4 lg:hidden">
            <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full w-1/2 mb-2 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
        </div>

        {{-- Tabla de ot finalizadas --}}
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 p-4 lg:hidden">
            @foreach ($data as $item)
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center justify-between mb-6">
                    <img class="object-cover w-auto h-8" src="{{ asset('images/iaim/iaim-logo.png') }}" alt="">
                    <x-dropdown>
                        <x-dropdown.item label="Eliminar" />
                        <x-dropdown.item label="imprimir" wire:click.prevent="imprimir({{ $item->id }})"/>
                    </x-dropdown>
                </div>
                <div class="text-sm font-bold text-gray-700">{{ $item->codigo_ot }}</div>
                <div class="text-sm text-gray-700">Finalizada el: {{ $item->fecha_cer_ot }}</div>
                <div class="text-sm text-gray-700">Coordinacion: {{ $item->usr_cer_coordinacion }}</div>
                <div class="text-sm font-bold text-gray-700">Inicio: {{ $item->fecha_inicio_ot }}</div>
                <div class="text-sm font-bold text-gray-700">Fin: {{ $item->fecha_fin_ot }}</div>
                <div class="text-sm font-bold text-gray-700 mt-2">Finalizada por:</div>
                <div class="text-sm text-gray-700">Nombre: {{ $item->usr_cer_nombre }}</div>
                <div class="text-sm text-gray-700">C.I.: {{ $item->usr_cer_cedula }}</div>
                <div class="flex items-center justify-between">
                    <div class="mt-2">
                        <x-badge emerald label="Certificada" />
                    </div>
                    <div class="mt-2">
                        @if($item->valor_urgencia == '0')
                        <x-badge.circle sm icon="home" class="shadow-lg"/>
                        @endif
                        @if($item->valor_urgencia == 'baja')
                        <x-badge.circle sm info label="B" class="shadow-lg"/>
                        @endif
                        @if($item->valor_urgencia == 'media')
                        <x-badge.circle sm warning label="M" class="shadow-lg"/>
                        @endif
                        @if($item->valor_urgencia == 'alta')
                        <x-badge.circle sm negative label="A" class="shadow-lg"/>
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
    <script>
        $('.number').on('input', function () { 
            this.value = this.value.replace(/[^1-9]/g,'');
        });
        $('.cantidad').on('input', function () { 
            this.value = this.value.replace(/[^1-9.,]/g,'');
        });
    </script>
</div>

