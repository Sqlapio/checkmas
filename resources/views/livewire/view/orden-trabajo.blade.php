
<div class="p-3">
    <div class="items-center justify-start mb-8 mt-4 sm:flex">
        <h1 class="text-xl mb-4">Asignación de orden de trabajo</h1>
    </div>

    {{-- Tipo de mantenimiento --}}
    <div class="p-2 w-1/4">
        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.tipoMan')</label>
        <x-native-select wire:model="tipoMantenimiento"  class="focus:ring-check-blue focus:border-check-blue seleccion" id="seleccion">
            <option value="">...</option>
            <option value="MP">Preventivo</option>
            <option value="MC">Correctivo</option>
        </x-native-select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 mt-8 {{ $atr }}">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.costo_Opera')</label>
                <x-inputs.currency icon="currency-dollar" thousands="." decimal="," precision="2" wire:model="costo_oper" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.costo_preCli')</label>
                <x-inputs.currency icon="currency-dollar" thousands="." decimal="," precision="2" wire:model="costo_preCli" wire:change="$emit('calc', $event.target.value)" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.utilBruta')</label>
                <x-input icon="currency-dollar" thousands="." decimal="," precision="2" wire:model="porcen" value="{{ $porcen }}" class="cursor-none" class="focus:ring-check-blue focus:border-check-blue"/>
            </div>
            
    </div>

    <div class="mt-5">
        <div class="overflow-auto rounded-lg shadow a">
            <div class="flex justify-between">
                <input wire:model="buscar" type="search" id="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
            </div>
            <table class="w-full mt-4" id="tabla_ots_mp">
                <thead class="bg-check-blue">
                    <tr>
                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-white">
                            Código
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                    @foreach ($data_mp as $item)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->equipoUid }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Div para la paginacion --}}
            <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                {{-- Paginacion --}}
                {{ $data_mp->links() }}
            </div>
        </div>


    </div>
    <script type="text/javascript">
        $('#select').on('change',function(){
        var selectValor = $(this).val();
        //alert (selectValor);

        if (selectValor == 'opc1') {
        $('.cedula').show();
        }else {
        $('.cedula').hide();
        //alert('esta es la opcion 2')
        }
    });

    </script>
</div>









