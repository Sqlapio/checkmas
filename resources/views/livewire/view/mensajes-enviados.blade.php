<div class="p-5">
    <div class="">
        <h1 class="text-xl mb-4">Buzon de mensajes enviados</h1>
        <div class="py-5 mt-4">
            <div class="flex justify-between">
                <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
                <div type="submit" wire:click.prevent="ocultar_grid()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <span>Nuevo mensaje</span>
                </div>
            </div>
        </div>
        {{-- grid de mensajes enviados --}}
        <div class="overflow-auto rounded-lg shadow {{ $atr_grid_enviados }}">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                {{-- Tabla para mostrar los mensajes --}}
                <div class="p-8" style="">
                    <table class="w-full">
                        <tbody class="bg-white divide-y divide-gray-100">

                                @foreach ($data as $item)
                                    @if(Auth::user()->email == $item->emisor)
                                        {{-- div para los correo emitidos --}}
                                        <div class="my-4 px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap bg-gray-100 rounded-xl shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
                                            {{-- div-ime: Informacion del mensaje enviado --}}
                                            <div class="flex flex-wrap gap-x-2">
                                                <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                                                <div class="">
                                                    <h2 class="mt-1 text-sm font-bold dark:text-white text-check-blue">ENVIADO</h2>
                                                    <h2 class="mt-2 text-sm font-medium text-gray-800 dark:text-white ">Para: {{ app('App\Http\Controllers\UtilsController')->get_nombre($item->receptor) }}</h2>
                                                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">Enviado: {{ $item->fecha_envio }}</p>
                                                    {{-- Asunto --}}
                                                    <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white ">Asunto:</h2>
                                                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $item->asunto }}</p>
                                                    {{-- mensaje --}}
                                                    <h2 class="text-sm mt-2 font-medium text-gray-800 dark:text-white ">Mensaje:</h2>
                                                </div>
                                            </div>
                                            <div class="flex ml-9">
                                                <textarea class="w-full bg-transparent text-sm text-gray-600 border-none outline-none p-0 resize-none">{{ $item->mensaje }}</textarea>
                                            </div>

                                            {{-- Respuesta recibida --}}
                                            @if($item->respuesta != '')
                                            <div class="shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px] rounded-2xl px-4 border border-check-green">
                                                <div class="flex flex-wrap gap-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-4 w-5 h-5 text-check-green font-bold">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                                                    </svg> 
                                                    <p class="text-sm font-bold text-check-blue mt-4">RESPUESTA</p>
                                                </div>
                                                <div class="mr-auto rounded-lg rounded-tl-none p-4 text-sm flex flex-col relative speech-bubble-left">
                                                    <div class="flex ml-3">
                                                        <textarea class="w-full bg-transparent text-sm text-gray-600 border-none outline-none p-0 resize-none">{{ $item->respuesta }}</textarea>
                                                    </div>
                                                    <p class="text-gray-600 text-xs text-right leading-none">Recibido: {{ $item->fecha_respuesta }}</p>
                                                </div>
                                            </div>    
                                            @endif

                                            {{-- icono de enviado --}}
                                            @if($item->estatus == 1)
                                                <div class="flex flex-wrap items-center justify-end gap-x-2 mt-4">
                                                    <div class="flex rounded-full p-2 bg-gray-200">
                                                        <svg class="w-5 h-5"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier"> 
                                                                <g id="Interface / Check_Big"> <path id="Vector" d="M4 12L8.94975 16.9497L19.5572 6.34326" stroke="#008f51" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    </path> 
                                                                </g> 
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            @else
                                            {{-- icono recibido --}}
                                                <div class="flex flex-wrap items-center justify-end gap-x-2 mt-4">
                                                    @if ($item->estatus == 2)
                                                        <h2 class="text-xs font-bold dark:text-white text-check-green">Marcado como leido</h2>
                                                        <div class="flex rounded-full border border-check-green p-2 bg-gray-200">
                                                            <svg class="w-5 h-5" fill="#008f51"  viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>check-double</title> <path d="M30.844 3.602c-0.221-0.204-0.518-0.328-0.844-0.328-0.365 0-0.693 0.156-0.921 0.406l-0.001 0.001-20.121 21.993-6.076-6.036c-0.226-0.226-0.538-0.366-0.883-0.366-0.69 0-1.25 0.56-1.25 1.25 0 0.348 0.142 0.663 0.371 0.889l0 0 7 6.953 0.022 0.015 0.015 0.021c0.074 0.061 0.159 0.114 0.25 0.156l0.007 0.003c0.037 0.026 0.079 0.053 0.123 0.077l0.007 0.003c0.135 0.056 0.292 0.089 0.457 0.089 0.175 0 0.341-0.037 0.491-0.103l-0.008 0.003c0.053-0.031 0.098-0.061 0.14-0.094l-0.003 0.002c0.102-0.050 0.189-0.11 0.268-0.179l-0.001 0.001 0.015-0.023 0.020-0.014 21-22.953c0.204-0.221 0.328-0.518 0.328-0.844 0-0.365-0.156-0.693-0.406-0.921l-0.001-0.001zM8.876 15.204l0.022 0.015 0.015 0.021c0.073 0.059 0.156 0.111 0.244 0.152l0.007 0.003c0.039 0.028 0.083 0.056 0.13 0.081l0.007 0.003c0.135 0.056 0.292 0.088 0.456 0.088 0.175 0 0.34-0.037 0.491-0.102l-0.008 0.003c0.053-0.031 0.098-0.061 0.14-0.094l-0.003 0.002c0.102-0.050 0.189-0.11 0.268-0.179l-0.001 0.001 0.015-0.023 0.020-0.014 11.269-12.317c0.203-0.221 0.328-0.518 0.328-0.844 0-0.69-0.559-1.25-1.25-1.25-0.365 0-0.693 0.156-0.921 0.405l-0.001 0.001-10.39 11.357-2.833-2.814c-0.226-0.226-0.538-0.366-0.883-0.366-0.69 0-1.25 0.56-1.25 1.25 0 0.348 0.142 0.663 0.372 0.889l0 0z"></path> </g></svg>
                                                        </div>
                                                    @else
                                                        <div class="flex rounded-full p-2 bg-gray-200">
                                                            <svg class="w-5 h-5" fill="#008f51"  viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>check-double</title> <path d="M30.844 3.602c-0.221-0.204-0.518-0.328-0.844-0.328-0.365 0-0.693 0.156-0.921 0.406l-0.001 0.001-20.121 21.993-6.076-6.036c-0.226-0.226-0.538-0.366-0.883-0.366-0.69 0-1.25 0.56-1.25 1.25 0 0.348 0.142 0.663 0.371 0.889l0 0 7 6.953 0.022 0.015 0.015 0.021c0.074 0.061 0.159 0.114 0.25 0.156l0.007 0.003c0.037 0.026 0.079 0.053 0.123 0.077l0.007 0.003c0.135 0.056 0.292 0.089 0.457 0.089 0.175 0 0.341-0.037 0.491-0.103l-0.008 0.003c0.053-0.031 0.098-0.061 0.14-0.094l-0.003 0.002c0.102-0.050 0.189-0.11 0.268-0.179l-0.001 0.001 0.015-0.023 0.020-0.014 21-22.953c0.204-0.221 0.328-0.518 0.328-0.844 0-0.365-0.156-0.693-0.406-0.921l-0.001-0.001zM8.876 15.204l0.022 0.015 0.015 0.021c0.073 0.059 0.156 0.111 0.244 0.152l0.007 0.003c0.039 0.028 0.083 0.056 0.13 0.081l0.007 0.003c0.135 0.056 0.292 0.088 0.456 0.088 0.175 0 0.34-0.037 0.491-0.102l-0.008 0.003c0.053-0.031 0.098-0.061 0.14-0.094l-0.003 0.002c0.102-0.050 0.189-0.11 0.268-0.179l-0.001 0.001 0.015-0.023 0.020-0.014 11.269-12.317c0.203-0.221 0.328-0.518 0.328-0.844 0-0.69-0.559-1.25-1.25-1.25-0.365 0-0.693 0.156-0.921 0.405l-0.001 0.001-10.39 11.357-2.833-2.814c-0.226-0.226-0.538-0.366-0.883-0.366-0.69 0-1.25 0.56-1.25 1.25 0 0.348 0.142 0.663 0.372 0.889l0 0z"></path> </g></svg>
                                                        </div>  
                                                    @endif
                                                    
                                                </div>
                                            @endif
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
    </div>
        
    {{-- Formulario de mensaje --}}   
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-700 dark:border-gray-600 {{ $atr_formulario }}">
            <div class="items-center justify-start mb-8 mt-4 sm:flex">
                {{-- <h1 class="font-bold text-2xl text-check-blue drop-shadow-lg">@lang('messages.label.ots')</h1> --}}
                <h1 class="text-xl mb-4">Mensajeria Checkmas</h1>
            </div>

            <div class="border border-gray-200 rounded-lg shadow-md px-4">

                {{-- Datos del mensaje --}}
                <div class="">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
                        <div class="p-2">
                            <label class=" mb-1 block text-sm font-bold text-check-blue">De: {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</label>
                            <label class=" mb-1 block text-sm font-bold text-check-blue">Email: {{ Auth::user()->email }}</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="p-2">
                            <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Para:</label>
                            <x-receptor></x-receptor>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-2">
                            <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Asunto:</label>
                            <x-input icon="pencil" wire:model="asunto" class="focus:ring-check-blue focus:border-check-blue" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                        <div class="p-2">
                            <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Mensaje</label>
                            <x-textarea wire:model="mensaje" placeholder="Descripcion del mensaje" class="focus:ring-check-blue focus:border-check-blue" />
                        </div>
                    </div>
                </div>

                {{-- Boton de envio de mensaje --}}
                <div class="flex items-center justify-end mt-8 mb-8">
                    <button type="submit" wire:click.prevent="store()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                        <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>ENVIAR MENSAJE</span>
                    </button>
                </div>
            </div>
        
    </div>
</div>
