<div class="p-5">
    <div class="">
        <h1 class="text-xl mb-4">Buzon de mensajes recibidos</h1>
        <div class="py-5 mt-4">
            <div class="flex justify-between">
                <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
                {{-- <div type="submit" wire:click.prevent="ocultar_grid()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <span>Nuevo mensaje</span>
                </div> --}}
            </div>
        </div>

        {{-- grid de mensajes recibidos --}}
        <div class="overflow-auto rounded-lg shadow {{ $atr_table_recibidos }}">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                {{-- Tabla para mostrar los mensajes --}}
                <div class="p-8">
                    <table class="w-full">
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($data as $item)
                                {{-- div para los correo recibidos --}}
                                @if($item->estatus == '1')
                                <div class="my-4 px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap bg-gray-100 rounded-xl shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                                        {{-- div-ime: Informacion del mensaje enviado --}}
                                        <div class="flex flex-wrap gap-x-2">
                                            <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                                            <div>
                                                <h2 class="text-sm mt-1 font-bold dark:text-white text-check-blue ">RECIBIDO</h2>
                                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">De: {{ app('App\Http\Controllers\UtilsController')->get_nombre($item->emisor) }}</h2>
                                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Recibido el: {{ $item->fecha_recibido }}</p>
                                                {{-- asunto --}}
                                                <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white ">Asunto:</h2>
                                                <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $item->asunto }}</p>
                                                {{-- mensaje --}}
                                                <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white ">Mensaje:</h2>
                                            </div>
                                        </div>
                                        <div class="flex ml-9">
                                            <textarea class="w-full text-sm text-gray-600 border-none outline-none p-0 bg-transparent resize-none">{{ $item->mensaje }}</textarea>
                                        </div>
                                        {{-- Iconos --}}
                                    <div class="flex flex-wrap items-center justify-end gap-x-2 mt-2">
                                        @if($item->fecha_respuesta != null)
                                            <p class="text-xs font-normal text-check-green dark:text-gray-400">Respondiste el: {{ $item->fecha_respuesta }}</p>
                                        @else
                                            {{-- Marcar como leido --}}
                                            <div class="flex items-center justify-center p-1">
                                                <div wire:click="acciones({{ $item->id }}, '1')" class="relative flex flex-col items-center group rounded-full p-2 bg-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer text-green-800 font-extrabold">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
                                                    </svg>
                                                    <div class="absolute top-0 flex-col items-center hidden mt-6 group-hover:flex">
                                                        <div class="w-3 h-3 -mb-2 rotate-45 bg-black"></div>
                                                        <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Marcar como leido</span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Responder --}}
                                            <div class="flex items-center justify-center p-1">
                                                <div wire:click="acciones({{ $item->id }}, '2')" class="relative flex flex-col items-center group rounded-full p-2 bg-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer text-green-800 font-extrabold">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                                                    </svg>
                                                    <div class="absolute top-0 flex-col items-center hidden mt-6 group-hover:flex">
                                                        <div class="w-3 h-3 -mb-2 rotate-45 bg-black"></div>
                                                        <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Responder</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        

                                        {{-- Eliminar --}}
                                        <div class="flex items-center justify-center p-1">
                                            <div wire:click="acciones({{ $item->id }}, '3')" class="relative flex flex-col items-center group rounded-full p-2 bg-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                <div class="absolute top-0 flex-col items-center hidden mt-6 group-hover:flex">
                                                    <div class="w-3 h-3 -mb-2 rotate-45 bg-black"></div>
                                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Eliminar</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="my-4 px-4 py-4 text-sm font-medium border border-check-green text-gray-700 whitespace-nowrap bg-gray-100 rounded-xl shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                                    {{-- div-ime: Informacion del mensaje enviado --}}
                                    <div class="flex flex-wrap gap-x-2">
                                        <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                                        <div>
                                            <h2 class="text-sm mt-1 font-bold dark:text-white text-check-blue ">RECIBIDO</h2>
                                            <h2 class="text-sm font-medium text-gray-800 dark:text-white ">De: {{ app('App\Http\Controllers\UtilsController')->get_nombre($item->emisor) }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Recibido el: {{ $item->fecha_recibido }}</p>
                                            {{-- asunto --}}
                                            <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white ">Asunto:</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $item->asunto }}</p>
                                            {{-- mensaje --}}
                                            <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white ">Mensaje:</h2>
                                        </div>
                                    </div>
                                    <div class="flex ml-9">
                                        <textarea class="w-full text-sm text-gray-600 border-none outline-none p-0 bg-transparent resize-none">{{ $item->mensaje }}</textarea>
                                    </div>
                                    {{-- Iconos --}}
                                    <div class="flex flex-wrap items-center justify-end gap-x-2 mt-2">
                                        @if($item->fecha_respuesta != null)
                                            <p class="text-xs font-normal text-check-green dark:text-gray-400">Respondiste el: {{ $item->fecha_respuesta }}</p>
                                        @else
                                            {{-- Marcar como leido --}}
                                            <div class="flex items-center justify-center p-1">
                                                <div wire:click="acciones({{ $item->id }}, '1')" class="relative flex flex-col items-center group rounded-full p-2 bg-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer text-green-800 font-extrabold">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
                                                    </svg>
                                                    <div class="absolute top-0 flex-col items-center hidden mt-6 group-hover:flex">
                                                        <div class="w-3 h-3 -mb-2 rotate-45 bg-black"></div>
                                                        <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Marcar como leido</span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Responder --}}
                                            <div class="flex items-center justify-center p-1">
                                                <div wire:click="acciones({{ $item->id }}, '2')" class="relative flex flex-col items-center group rounded-full p-2 bg-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer text-green-800 font-extrabold">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                                                    </svg>
                                                    <div class="absolute top-0 flex-col items-center hidden mt-6 group-hover:flex">
                                                        <div class="w-3 h-3 -mb-2 rotate-45 bg-black"></div>
                                                        <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Responder</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        

                                        {{-- Eliminar --}}
                                        <div class="flex items-center justify-center p-1">
                                            <div wire:click="acciones({{ $item->id }}, '3')" class="relative flex flex-col items-center group rounded-full p-2 bg-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                <div class="absolute top-0 flex-col items-center hidden mt-6 group-hover:flex">
                                                    <div class="w-3 h-3 -mb-2 rotate-45 bg-black"></div>
                                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Eliminar</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Div para la paginacion --}}
                    <div class="bg-white px-4 py-3 items-center justify-between border-gray-200 sm:px-6">
                        {{-- Paginacion --}}
                        {{ $data->links() }}
                    </div>
                    {{-- Fin Div paginacion --}}
                </div>
            </div>
        </div>

        {{-- Respuesta --}}
        <div class="overflow-auto rounded-lg shadow {{ $atr_form_respuesta }}">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                {{-- Tabla para mostrar los mensajes --}}
                <div class="p-2">
                    <table class="w-full">
                        <tbody class="bg-white divide-y divide-gray-100">
                            {{-- div para los correo emitidos --}}
                            <div class="my-4 px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap bg-gray-100 rounded-xl shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                                {{-- div-ime: Informacion del mensaje enviado --}}
                                <div class="flex flex-wrap gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-check-green w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                                      </svg>
                                    <div class="">
                                        <input type="hidden" value="{{ $res_id }}">
                                        <h2 class="mt-1 text-sm font-bold dark:text-white text-check-blue">RESPUESTA</h2>
                                        <h2 class="mt-2 text-sm font-medium text-gray-800 dark:text-white ">Para: {{ $res_para }}</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Enviado el: {{ $res_enviado }}</p>
                                        {{-- Asunto --}}
                                        <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white ">Asunto:</h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $res_asunto }}</p>
                                        {{-- mensaje --}}
                                        <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white">Mensaje:</h2>
                                    </div>
                                </div>
                                <div class="flex ml-7">
                                    <textarea class="w-full text-sm text-gray-600 bg-transparent border-none outline-none focus:outline-none p-0 resize-none">{{ $res_mensaje }}</textarea>
                                </div>
                            </div>

                            <div class="flex items-center justify-center border-2 rounded-xl boder-check-blue">
                                <div class="flex-initial w-full">
                                    <textarea rows="1" wire:model="respuesta" class="w-full bg-transparent text-sm text-gray-600 rounded-md p-2 focus:outline-none border-none outline-none resize-none focus:ring-check-blue focus:border-check-blue"></textarea>
                                  </div>
                                  <div class="flex items-center justify-end">
                                    <button type="submit" wire:click.prevent="respuesta({{ $res_id }})" class="ml-3 inline-flex justify-center rounded-xl border border-transparent bg-green-700 py-3 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                                        <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-6 w-6 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                        <span>Enviar</span>
                                    </button>
                                </div>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>