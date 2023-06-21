<div id="content">
    {{-- TABLA DE OTS --}}
    <div class="p-5 tabla_ots {{ $ocultar_tabla }}">
        <h1 class="text-xl mb-4">Ordenes de trabajo</h1>
        {{-- Filtros --}}
        <div class="py-5 mt-4 hidden lg:block" id="filtros">
            {{-- Filtros --}}
            <div class="flex flex-wrap justify-start gap-x-3">
                <div class="my-auto">
                    <x-input wire:model="buscar" class="focus:ring-check-blue focus:border-check-blue sm:w-1/3 lg:w-auto" placeholder="Buscar..."/>
                </div>
                <div class="p-2">
                    {{-- <label class="opacity-60 block text-sm font-medium text-italblue my-auto">Estatus:</label> --}}
                    <x-native-select wire:model="fil_status" class="lg:w-auto focus:ring-check-blue focus:border-check-blue">
                        <option value="" selected hidden>estatus...</option>
                        <option value="1">Registrada</option>
                        <option value="2">Aprobada</option>
                    </x-native-select>
                </div>
                <div class="p-2">
                    {{-- <label class="opacity-40 block text-sm font-medium text-italblue my-auto">Rango de fechas:</label> --}}
                    <x-native-select wire:model="fil_fecha" class="lg:w-auto focus:ring-check-blue focus:border-check-blue">
                        <option value="" selected hidden>rango...</option>
                        <option value="hoy">Hoy</option>
                        <option value="semana">Semana</option>
                        <option value="mes">mes</option>
                    </x-native-select>
                </div>
                
                <div class="p-2">
                    {{-- <label class="opacity-40 block text-sm font-medium text-italblue my-auto">Urgencia:</label> --}}
                    <x-native-select wire:model="fil_urgencia" class="lg:w-auto focus:ring-check-blue focus:border-check-blue">
                        <option value="" selected hidden>urgencia...</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                    </x-native-select>
                </div>
                
                <div class="p-2 my-auto opacity-60" wire:click='reset_filtros'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 font-semibold text-orange-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                      </svg>  
                </div> 
            </div>
        </div>
        {{-- Tabla principal --}}
        <div class="overflow-auto rounded-lg shadow hidden lg:block">
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
                                Ubicación y reporte
                            </th>
                            <th scope="col" class="w-20 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                Descripción general
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                Inspeccionado por:
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                Obra:
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                Urgencia:
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">

                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($data as $item)
                        <tr>
                            <td class="w-1/4 px-4 py-4 text-sm text-gray-500 text-justify dark:text-gray-300">
                                <div class="flex items-center gap-x-2 mr-8">
                                    <div>
                                        <h2 class="text-xs font-bold text-gray-800 dark:text-white ">{{ $item->codigo_ot }}</h2>
                                        <h2 class="text-xs font-bold text-gray-800 dark:text-white ">Fecha registro: {{ $item->fecha_ot }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Division: {{ $item->division }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Coordinacion: {{ $item->coordinacion }}</p>
                                        <div class="mt-2">
                                            @if($item->status == '1')
                                                <x-badge outline sky label="Registrada" />
                                            @elseif($item->status == '2')
                                                <x-badge sky label="Aprobada" />
                                                <p class="mt-1 text-xs font-semibold text-gray-600 dark:text-gray-400">Por: {{ $item->aprobada_por }}</p>
                                            @elseif($item->status == '3')
                                                <x-badge emerald label="Finalizada" />
                                                <p class="mt-1 text-xs font-semibold text-gray-00 dark:text-gray-400">Por: {{ $item->aprobada_por }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                <div class="flex items-center gap-x-2 mr-8">
                                    <div>
                                        <h2 class="text-xs font-bold text-gray-800 dark:text-white ">Aeropuerto: {{ $item->aeropuerto }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Area: {{ $item->area }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Reportado por: {{ $item->reportado_por }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="w-1/4 px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">{{ $item->descripcion_general }}</td>
                            <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                <div class="flex items-center gap-x-2 mr-8">
                                    <div>
                                       
                                        <h2 class="text-xs font-bold text-gray-800 dark:text-white ">Nombre: {{ $item->usr_res_nombre }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">C.I: {{ $item->usr_res_cedula }}</p>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Cargo: {{ $item->usr_res_cargo }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="w-1/6 px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                @if($item->valor_obra == '0')
                                <x-badge flat label="Sin valorar" />
                                @endif
                                @if($item->valor_obra == 'facil')
                                <x-badge md flat sky label="Facil" />
                                @endif
                                @if($item->valor_obra == 'media')
                                <x-badge md flat warning label="Media" />
                                @endif
                                @if($item->valor_obra == 'dificil')
                                <x-badge md flat red label="Dificil" />
                                @endif
                            </td>
                            <td class="w-1/6 px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                @if($item->valor_urgencia == '0')
                                <x-badge flat label="Sin valorar" />
                                @endif
                                @if($item->valor_urgencia == 'baja')
                                <x-badge md flat sky label="Baja" />
                                @endif
                                @if($item->valor_urgencia == 'media')
                                <x-badge md flat warning label="Media" />
                                @endif
                                @if($item->valor_urgencia == 'alta')
                                <x-badge md flat red label="Alta" />
                                @endif
                            </td>
                            {{-- Menu de opciones --}}
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

    {{-- TABLA DE APROBACIÓN DE ORDEN DE TRABAJO --}}
    <div class="p-5 tabla_materiales {{ $mostrar }}">
        <p class="text-sm font-bold">APROBACION</p>
        <p class="text-xs mb-4">Codigo: {{ $codigo_ot }}</p>

        {{-- TABLA INPUTS --}}
        <div class="tabla_inputs">
            <div class="overflow-auto rounded-lg shadow hidden xl:block">
                <div class="tabla_ots" id="tabla_ot">
                    <table class="w-full">
                        <thead class="bg-check-blue">
                            <tr>
                                <th scope="col" class="w-1/6 py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <button class="flex items-center gap-x-2">
                                            <span class="ml-1">Valor de urgencia</span>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="w-1/6 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Valor de obra
                                </th>
                                <th scope="col" class="w-1/6 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Otras diviciones
                                </th>
                                <th scope="col" class=" px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Recomendaciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            <tr> 
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                    <x-native-select wire:model="valor_urgencia" class="focus:ring-check-blue focus:border-check-blue">
                                        <option value="">...</option>
                                        <option value="baja">Baja</option>
                                        <option value="media">Media</option>
                                        <option value="alta">Alta</option>
                                    </x-native-select>
                                </td>
                                <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                    <x-native-select wire:model="valor_obra" class="focus:ring-check-blue focus:border-check-blue">
                                        <option value="">...</option>
                                        <option value="facil">Fácil</option>
                                        <option value="media">Media</option>
                                        <option value="dificil">Difícil</option>
                                    </x-native-select>
                                </td>
                                <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                    <x-native-select wire:model="otras_diviciones" class="focus:ring-check-blue focus:border-check-blue">
                                        <option value="">...</option>
                                        <option value="Mantenimiento equipos de electricidad">Mantenimiento equipos de electricidad</option>
                                        <option value="Proyectos y desarrollo aeroportuario">Proyectos y desarrollo aeroportuario</option>
                                        <option value="Mantenimiento de infraestructura y areas verdes">Mantenimiento de infraestructura y areas verdes</option>
                                        <option value="Mantenimiento de equipos de electromecanica">Mantenimiento de equipos de electromecanica</option>
                                        <option value="Planta de agua">Planta de agua</option>
                                    </x-native-select>
                                </td>
                                <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                    <x-input icon="pencil" placeholder="Especifique su recomendacion" wire:model="recomendaciones"/>
                                </td>    
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- TABLA INPUTS MOBILE RESPONSIVE --}}
        <div class="tabla_inputs xl:hidden">
            <div class="overflow-auto rounded-lg shadow sm:block">
                <div class="tabla_ots" id="tabla_ot">
                    <table class="w-full">
                        <thead class="bg-check-blue">
                            <tr>
                                <th scope="col" class="w-1/6 py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <button class="flex items-center gap-x-2">
                                            <span class="ml-1">Valor de urgencia</span>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="w-1/6 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Valor de obra
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            <tr> 
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                    <x-native-select wire:model="valor_urgencia" class="focus:ring-check-blue focus:border-check-blue">
                                        <option value="">...</option>
                                        <option value="baja">Baja</option>
                                        <option value="media">Media</option>
                                        <option value="alta">Alta</option>
                                    </x-native-select>
                                </td>
                                <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                    <x-native-select wire:model="valor_obra" class="focus:ring-check-blue focus:border-check-blue">
                                        <option value="">...</option>
                                        <option value="facil">Fácil</option>
                                        <option value="media">Media</option>
                                        <option value="dificil">Difícil</option>
                                    </x-native-select>
                                </td>   
                            </tr>
                        </tbody>
                    </table>
                    <table class="w-full">
                        <thead class="bg-check-blue">
                            <tr>
                                <th scope="col" class="w-1/6 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Otras diviciones
                                </th>
                                <th scope="col" class="w-1/6 px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Recomendaciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            <tr> 
                                <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-300 ">
                                    <x-native-select wire:model="otras_diviciones" class="focus:ring-check-blue focus:border-check-blue">
                                        <option value="">...</option>
                                        <option value="Mantenimiento equipos de electricidad">Mantenimiento equipos de electricidad</option>
                                        <option value="Proyectos y desarrollo aeroportuario">Proyectos y desarrollo aeroportuario</option>
                                        <option value="Mantenimiento de infraestructura y areas verdes">Mantenimiento de infraestructura y areas verdes</option>
                                        <option value="Mantenimiento de equipos de electromecanica">Mantenimiento de equipos de electromecanica</option>
                                        <option value="Planta de agua">Planta de agua</option>
                                    </x-native-select>
                                </td>
                                <td class="px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">
                                    <x-input icon="pencil" placeholder="Especifique su recomendacion" wire:model="recomendaciones"/>
                                </td>    
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- TABLA DE MATERIALES ASOCIADOS A LA OT --}}
        <div class="tabla_materiales mt-8">
            <div class="botton grid justify-items-end">
                {{-- Botton APROBAR OT --}}
                <div class="p-2 mt-auto">
                    <button type="submit" wire:click.prevent="guardar_aprobacion()" class="justify-end rounded-xl border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                        <span>
                            Aprobar
                        </span>
                    </button>
                </div>
            </div>
            <div class="overflow-auto rounded-lg shadow sm:block">
                <div class="tabla_ots" id="tabla_ot">
                    <table class="w-full">
                        <thead class="bg-check-blue">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <button class="flex items-center gap-x-2">
                                            <span class="ml-1">Código</span>
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Producto
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Cantidad
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                    Existencia
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white dark:text-gray-400">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($materiales as $item)
                            <tr>
                                <td class="w-1/6 px-4 py-4 text-xs text-gray-500 text-justify dark:text-gray-300">{{ $item->codigo_producto }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->descripcion }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->cantidad }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->existencia_total }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    <div class="p-2 mt-auto">
                                        <div class="p-2 mt-auto">
                                            <span>
                                                <x-badge.circle md negative icon="x" wire:click.prevent="eliminar_materiales({{ $item->codigo_producto }})"/>                                                
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Div para la paginacion --}}
                    <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                        {{-- Paginacion --}}
                        {{ $materiales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table para mobile app --}}
    <div class="flex justify-between p-5 lg:hidden {{ $ocultar_tabla }}">
        <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full w-1/2 mb-2 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 p-5 lg:hidden {{ $ocultar_tabla }}">
        @foreach ($data as $item)
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between mb-6">
                <img class="object-cover w-auto h-8" src="{{ asset('images/iaim/iaim-logo.png') }}" alt="">
                <x-dropdown>
                    @if($item->status == '1')
                        <x-dropdown.item label="Aprobar" wire:click.prevent="aprobar({{ $item->id }})" />
                    @endif
                    <x-dropdown.item label="Eliminar" />
                    <x-dropdown.item label="imprimir" wire:click.prevent="imprimir({{ $item->id }})"/>
                </x-dropdown>
            </div>
            <div class="text-sm font-bold text-gray-700">{{ $item->codigo_ot }}</div>
            <div class="text-sm text-gray-700">Registro: {{ $item->fecha_ot }}</div>
            <div class="text-sm text-gray-700">Coordinacion: {{ $item->coordinacion }}</div>
            <div class="text-sm font-bold text-gray-700 mt-2">Responsable</div>
            <div class="text-sm text-gray-700">Nombre: {{ $item->usr_res_nombre }}</div>
            <div class="text-sm text-gray-700">C.I.: {{ $item->usr_res_cedula }}</div>
            <div class="flex items-center justify-between">
                <div class="mt-2">
                    @if($item->status == '1')
                        <x-badge outline sky label="Registrada" />
                    @elseif($item->status == '2')
                        <x-badge sky label="Aprobada" />
                    @endif
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

