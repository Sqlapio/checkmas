<div class="p-4">
    <div class="items-center justify-start mb-8 mt-4 sm:flex">
        {{-- <h1 class="font-bold text-2xl text-check-blue drop-shadow-lg">@lang('messages.label.ots')</h1> --}}
        <h1 class="text-xl mb-4">Bitacora de mantenimientos</h1>
    </div>

    {{-- formulario --}}
    <div class="border border-gray-200 rounded-lg shadow-md px-4" {{ $atr_form }}>
        {{-- Datos Orden de trabajo --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 mt-8">
            {{-- <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.fechaInicio')</label>
                    <x-input type="date" wire:model="fecha_mantenimiento" id="focus"  class="focus:ring-check-blue focus:border-check-blue"/>
                </div> --}}
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Nro. de orden de trabajo</label>
                <x-ots_mantenimiento />
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Fotos del mantinimiento</label>
                <x-native-select wire:model="tipo_fotos" wire:change="$emit('selection', $event.target.value)" class="focus:ring-check-blue focus:border-check-blue">
                    <option></option>
                    <option value="antes">Antes</option>
                    <option value="despues">Despues</option>
                </x-native-select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Foto Nro. 1 - {{ $atr_fotos }}</label>
                {{-- <input wire:model="pdf_pre_oper" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:ring-check-blue focus:border-check-blue disabledDocCC"> --}}
                <input id="" wire:model="foto1" type="file" class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-green-50 file:text-check-blue
                            hover:file:bg-green-100">
                @error('foto1') <span class="error text-xs text-red-500 italic">{{ $message }}</span> @enderror
            </div>
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Foto Nro. 2 - {{ $atr_fotos }}</label>
                {{-- <input wire:model="pdf_pre_preCli" type="file" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-gray-200 outline-none focus:ring-check-blue focus:border-check-blue disabledDocCC"> --}}
                <input id="" wire:model="foto2" type="file" class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-green-50 file:text-check-blue
                            hover:file:bg-green-100">
                @error('foto2') <span class="error text-xs text-red-500 italic">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4 mt-8">
            <div class="p-2">
                <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Observaciones generales de la actividad</label>
                <x-textarea wire:model="observaciones" placeholder="Por favor indique cual es su Incidencia de forma Detallada" class="focus:ring-check-blue focus:border-check-blue" />
            </div>
        </div>

        {{-- Boton de registro --}}
        <div class="flex items-center justify-end mt-8 mb-8">
            <x-boton />
        </div>
    </div>

    {{-- Tabla --}}
    <div class="flex flex-col sm:flex" >
        <div class="mx-4 -my-2 overflow-x-auto sm:mx-4 lg:-mx-8" {{ $atr_table }}>
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="py-5 mt-4">
                    <div class="flex justify-between">
                        <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
                        <button wire:click="view()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700">
                            <span> + AGREGAR FOTO</span>
                        </button>
                    </div>
                </div>
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg shadow-lg mb-8">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="w-20 py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg>

                                        <button wire:click="order" class="flex items-center gap-x-2">
                                            <span>Nro. de orden</span>
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="w-20 px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Foto antes(1)
                                </th>
                                <th scope="col" class="w-20 px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Foto antes(2)
                                </th>
                                <th scope="col" class="w-20 px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Observaciones
                                </th>
                                <th scope="col" class="w-20 px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Foto después(1)
                                </th>
                                <th scope="col" class="w-20 px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Foto después(2)
                                </th>
                                <th scope="col" class="w-20 px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Observaciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200">
                                    <div class="inline-flex items-center gap-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $item->nro_ot }}</span>
                                    </div>
                                </td>

                                {{-- antes --}}
                                <td class="px-4 py-4 text-sm font-medium text-gray-700">
                                    <div class="flex items-center gap-x-2">
                                        <a class="ml-8" href="{{ asset('/storage/'.$item->foto1_antes) }}" target="_blank">
                                            <img src="{{ asset('/storage/'.$item->foto1_antes) }}" class="w-16 h-16 sm:w-8 h-8" />
                                        </a>
                                    </div>

                                </td>
                                <td class="px-4 py-4 text-sm font-medium text-gray-700">
                                    <div class="flex items-center gap-x-2">
                                        <a class="ml-8" href="{{ asset('/storage/'.$item->foto2_antes) }}" target="_blank">
                                            <img src="{{ asset('/storage/'.$item->foto2_antes) }}" class="w-16 h-16 sm:w-8 h-8" />
                                        </a>
                                    </div>

                                </td>
                                <td class="w-20 px-4 py-4 text-sm font-medium text-justify text-gray-700">{{ $item->observaciones_antes }}</td>

                                {{-- despues --}}
                                <td class="px-4 py-4 text-sm font-medium text-gray-700">
                                    <div class="flex items-center gap-x-2">
                                        <a class="ml-8" href="{{ asset('/storage/'.$item->foto1_despues) }}" target="_blank">
                                            <img src="{{ asset('/storage/'.$item->foto1_despues) }}" class="w-16 h-16 sm:w-8 h-8" />
                                        </a>
                                    </div>

                                </td>
                                <td class="px-4 py-4 text-sm font-medium text-gray-700">
                                    <div class="flex items-center gap-x-2">
                                        <a class="ml-8" href="{{ asset('/storage/'.$item->foto2_despues) }}" target="_blank">
                                            <img src="{{ asset('/storage/'.$item->foto2_despues) }}" class="w-16 h-16 sm:w-8 h-8" />
                                        </a>
                                    </div>
                                </td>
                                <td class="w-20 px-4 py-4 text-sm font-medium text-justify text-gray-700">{{ $item->observaciones }}</td>
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

