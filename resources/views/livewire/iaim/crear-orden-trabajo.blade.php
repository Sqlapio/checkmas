@php
use App\Models\Iaim_Articulo;
use App\Models\IaimOrdenTrabajo;
$articulos = Iaim_Articulo::all();
$ots = IaimOrdenTrabajo::all();

@endphp
<div class="p-5">
    <h1 class="text-xl mb-2 fobt-bold">Orden de Trabajo</h1>
    <h1 class="text-sm mb-2">Código: {{ $codigo_ot }}</h1>
    <div class="overflow-auto rounded-lg shadow md:block">
        {{-- Fecha --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Fecha</label>
                <x-input icon="pencil" wire:model="fecha_ot" value="{{ $fecha_ot }}" class="focus:ring-check-blue focus:border-check-blue cursor-none"/>
            </div>
        </div>
        <div class="{{ $ocultar }}">
        {{-- Aeropuerto y area --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Reportado por:</label>
                <x-input icon="pencil" wire:model.defer="reportado_por"  class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Aeropuerto</label>
                <x-native-select id="aeropuerto" wire:model.defer="aeropuerto"  class="focus:ring-check-blue focus:border-check-blue">
                    <option value="">...</option>
                    <option value="nacional">Nacional</option>
                    <option value="internacional">Internacional</option>
                    <option value="edif_sede">Edificio Sede</option>
                </x-native-select>
            </div>
            <div class="p-2 ocultar" id="nacional" style="display:none;">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Area</label>
                <x-native-select wire:model.defer="area" class="focus:ring-check-blue focus:border-check-blue">
                    <option value="">...</option>
                    <option value="aeropostal">Aeropostal</option>
                    <option value="conviasa">Conviasa</option>
                </x-native-select>
            </div>
            <div class="p-2 ocultar" id="internacional" style="display:none;">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Area</label>
                <x-native-select wire:model.defer="area" class="focus:ring-check-blue focus:border-check-blue">
                    <option value="">...</option>
                    <option value="copa">Copa</option>
                    <option value="america">América</option>
                </x-native-select>
            </div>
            <div class="p-2 ocultar" id="edif_sede" style="display:none;">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Area</label>
                <x-native-select wire:model.defer="area" class="focus:ring-check-blue focus:border-check-blue">
                    <option value="">...</option>
                    <option value="no_aplica">No aplica</option>
                </x-native-select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Descripción General</label>
                <x-textarea wire:model.defer="descripcion_general" placeholder="Describa especificamente la razón del reporte" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>   
        </div>
        {{-- Botton guardar ot --}}
        <div class="p-2 {{ $save }}">
            <button type="submit" wire:click.prevent="store_ot()" class="justify-end rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store_ot" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span>GUARDAR</span>
            </button>
        </div>
        </div>
        <div class="p-2">
            <button type="submit" wire:click.prevent="mostrar_grid()" class="justify-end rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="mostrar_grid" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span>AGREGAR MATERIALES</span>
            </button>
        </div>
        <div class="{{ $grid }}">
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-4 mb-4 mt-8">
                <div class="p-2 cursor-none">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Código Ot</label>
                    <x-native-select wire:model.defer="codigo_ot" class="focus:ring-check-blue focus:border-check-blue">
                        <option value="">...</option>
                            @foreach($ots as $item)
                                <option value="{{ $item->codigo_ot }}">{{ $item->codigo_ot }}</option>
                            @endforeach
                    </x-native-select>
                </div>   
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Producto</label>
                    <x-native-select wire:model.defer="codigo_producto" class="focus:ring-check-blue focus:border-check-blue">
                        <option value="">...</option>
                            @foreach($articulos as $item)
                                <option value="{{ $item->codigo }}">{{ $item->codigo }} - {{ $item->descripcion }}</option>
                            @endforeach
                    </x-native-select>
                </div>
                <div class="p-2" x-data="{ count: 0 }" class="flex items-center gap-x-3">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Cantidad</label>
                    <x-inputs.number wire:model.defer="cantidad" class="number"/>
                </div>
                {{-- Botton agregar materiales --}}
                <div class="p-2 mt-auto">
                    <button type="submit" wire:click.prevent="agregar_materiales()" class="justify-end rounded-xl border border-transparent bg-check-blue py-1 px-1 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>  
                        </span>
                    </button>
                </div>
            </div>
                <table class="w-full mt-2">
                    <thead class="bg-check-blue">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-white">
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
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                                Producto
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                                Categoría
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                                Cantidad
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                                Existencia Total
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">    
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($data as $item)
                        <tr>
                            <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                <div class="inline-flex items-center gap-x-3 ">
                                    <span>{{ $item->codigo_producto }}</span>  
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->descripcion }}</td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->categoria }}</td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->cantidad }}</td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->existencia_total }}</td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                <div class="p-2 mt-auto">
                                    <button type="submit" wire:click.prevent="eliminar_materiales({{ $item->codigo_producto }})" class="justify-end rounded-xl border border-transparent bg-red-600 py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                              </svg>                                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                {{-- Paginacion --}}
                {{ $data->links() }}
            </div>
            <div class="p-2">
                <button type="submit" wire:click.prevent="mostrar_grid()" class="flex justify-end rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="mostrar_grid" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span>FINALIZAR</span>
                </button>
            </div>
        </div>
        
    </div>
    <script>
        $(document).ready(function() {
            $('#aeropuerto').on('change', function(){
                var value = $(this).val();
                console.log(value);
                $("div.ocultar").hide();
                $("#"+value).show();
            });
        });

        $('.number').on('input', function () { 
            this.value = this.value.replace(/[^1-9]/g,'');
        });

        $('.cantidad').on('input', function () { 
            this.value = this.value.replace(/[^1-9.,]/g,'');
        });
    </script>

    </script>
</div>

