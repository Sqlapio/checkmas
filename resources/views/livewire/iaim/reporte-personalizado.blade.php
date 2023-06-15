<div>
    @php
    use App\Models\Iaim_Categoria;
    use App\Models\Iaim_Articulo;
    $categorias = Iaim_Categoria::all();
    $articulos = Iaim_Articulo::all();
    @endphp
    <div class="p-5">
        <h1 class="text-xl mb-4">Modulo de reportes personalizados</h1>
        <div class="overflow-auto rounded-lg shadow md:block">
            <h1 class="text-xl p-4">Movimientos de inventario</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 mt-8 p-4">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Fecha Inicio</label>
                    <x-input type="date" wire:model.defer="fecha_inicio_inv"  class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Fecha Fin</label>
                    <x-input type="date" wire:model.defer="fecha_fin_inv"  class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Articulo</label>
                    <x-native-select wire:model.defer="codigo" class="focus:ring-check-blue focus:border-check-blue">
                        <option value="">...</option>
                            @foreach($articulos as $item)
                                <option value="{{ $item->codigo }}">{{ $item->descripcion }}</option>
                            @endforeach
                    </x-native-select>
                </div>
                
                <div class="p-2 mt-auto">
                    <button type="submit" wire:click.prevent="genera_reporte_inv()" class="w-full justify-end rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                        <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="genera_reporte_inv" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>GENERAR REPORTE</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-auto rounded-lg shadow md:block mt-4">
            <h1 class="text-xl mb-4 p-4">Ordenes de trabajo</h1>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 mt-8 p-4">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Fecha Inicio</label>
                    <x-input type="date" wire:model="fecha_inicio_ot"  class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Fecha Fin</label>
                    <x-input type="date" wire:model="fecha_fin_ot"  class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Estatus</label>
                    <x-native-select wire:model="estatus" class="focus:ring-check-blue focus:border-check-blue">
                        <option value="">...</option>
                        <option value="1">Registrada</option>
                        <option value="2">Aprobada</option>
                        <option value="3">Certificada</option>
                    </x-native-select>
                </div>
                
                <div class="p-2 mt-auto">
                    <button type="submit" wire:click.prevent="genera_reporte_ot()" class="w-full justify-end rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                        <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="genera_reporte_ot" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>GENERAR REPORTE</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
