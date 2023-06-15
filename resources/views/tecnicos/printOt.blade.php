<x-layout-print-ot>
    <div class="p-6 border border-gray-200 rounded-lg">
        {{-- <div class="flex items-center justify-end">
            <img class="w-40 h-auto" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
          </div> --}}
        <label class="mb-1 block text-xl font-medium text-italblue">ORDEN DE TRABAJO</label>
        {{-- fecha de inicio --}}
        <div class="flex flex-wrap justify-start border border-gray-500 rounded-lg shadow-md mt-4 p-4">
            <div class="p-2">
                <label class="mb-1 block text-sm font-medium text-italblue">Fecha de Inicio</label>
                <x-input icon="pencil" wire:model="ampCompresor" value="{{ $data->fechaInicio }}" class="border border-black cursor-none" />
            </div>
            <div class="p-2">
                <label class="mb-1 block text-sm font-medium text-italblue">Nro. de Orden</label>
                <x-input icon="pencil" wire:model="ampCompresor" value="{{ $data->otUid }}" class="w-60 border border-black cursor-none"  />
            </div>
        </div>
        {{-- Datos del tecnico/supervisor --}}
        <label class="mb-1 block text-sm font-medium text-italblue mt-4">Tecnico/Supervidor Responsable</label>
        <div class="flex flex-wrap justify-start border border-gray-500 rounded-lg shadow-md mt-2 p-4">
            <div class="p-2">
                <label class="mb-1 block text-sm font-medium text-italblue">Nombre y Apellido(tecnico)</label>
                <x-input icon="pencil" wire:model="ampCompresor" value="{{ $data->tecRes_NomApe }}" class="border border-black cursor-none"  />
            </div>
            <div class="p-2">
                <label class="mb-1 block text-sm font-medium text-italblue">Supervisor</label>
                <x-input icon="pencil" wire:model="ampCompresor" value="{{ $data->owner }}" class="border border-black cursor-none"  />
            </div>
        </div>

        {{-- Datos del equipo --}}
        <label class="mb-1 block text-sm font-medium text-italblue mt-4">Datos del Equipo</label>
        <div class="flex flex-wrap justify-start border border-gray-500 rounded-lg shadow-md mt-2 p-4">
            <div class="p-2">
                <label class="mb-1 block text-sm font-medium text-italblue">Nro. de Equipo</label>
                <x-input icon="pencil" wire:model="ampCompresor" value="{{ $data->equipoUid }}" class="border border-black cursor-none"  />
            </div>
            <div class="p-2">
                <label class="mb-1 block text-sm font-medium text-italblue">Tipo de Mantenimiento</label>
                @if($data->tipoMantenimiento == 'MC')
                <x-input icon="pencil" wire:model="ampCompresor" value="Mantenimiento Correctivo" class="border border-black cursor-none"  />
                @endif
                @if($data->tipoMantenimiento == 'MP')
                <x-input icon="pencil" wire:model="ampCompresor" value="Mantenimiento Preventivo" class="border border-black cursor-none"  />
                @endif

            </div>
        </div>

        <div class="relative overflow-x-auto">
            {{-- <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-12">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th colspan="2" scope="col" class="px-6 py-3 text-center">
                            CONTRATISTA
                        </th>
                        
                        <th scope="col" class="px-6 py-3 text-center">
                            CONTRATANTE
                        </th>
                        
                    </tr>
                </thead>
            </table> --}}
                {{-- <tbody> --}}
                    {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"> --}}
                        <div class="flex mt-10 border border-gray-500 rounded-lg mb-1">
                            <div class="flex-1 w-72 items-center ml-24 ">
                                <label class=" mb-1 block text-sm font-medium text-black text-center">CONTRATISTA</label>
                            </div>
                            <div class="flex-1 w-32 items-center ml-10 ">
                                <label class=" mb-1 block text-sm font-medium text-black text-center">CONTRATANTE</label>
                            </div>
                        </div>
                        
                        <th colspan="2" scope="row" class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex flex-wrap justify-start border border-gray-500 rounded-lg shadow-md p-4">
                                    <div class="p-2 border-black border-t-2 border-b-2 border-l-2 ">
                                        <label class=" mb-1 block text-sm font-medium text-black text-center">Tecnico</label>
                                        <x-input class="border border-black" class="w-44 h-20 border border-black cursor-none"/>
                                        <label class="mt-3 mb-2 block text-sm font-medium text-black ">Nombre: {{ $data->tecRes_NomApe }}</label>
                                        <label class=" mb-1 block text-sm font-medium text-black ">Cargo: Tecnico</label>
                                        <div class="flex justify-start mt-2">
                                            <img class="w-10 h-auto" src="{{ asset('images/LOGO_TRX.png') }}" alt="">
                                          </div>
                                    </div>
                                    <div class="p-2 border-black border-t-2 border-b-2 border-r-2">
                                        <label class=" mb-1 block text-sm font-medium text-black text-center">Supervisor</label>
                                        <x-input class="border border-black" class="h-20 border border-black cursor-none"/>
                                        <label class="mt-3 mb-2 block text-sm font-medium text-black ">Nombre: {{ $data->owner }}</label>
                                        <label class="mb-1 block text-sm font-medium text-black ">Cargo: Supervisor</label>
                                        
                                    </div>
                                <div class="p-2 border-black border-t-2 border-b-2 border-r-2">
                                    <label class=" mb-1 block text-sm font-medium text-black text-center">Supervisor Contratante</label>
                                    <x-input class="border border-black" class="h-20 border border-black cursor-none"/>
                                        <label class="mt-3 mb-2 block text-sm font-medium text-black ">Nombre: _____________________</label>
                                        <label class=" mb-1 block text-sm font-medium text-black "> Cargo: _______________________</label>
                                        <div class="flex justify-end mt-2">
                                            <img class="w-20 h-auto" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
                                          </div>
                                </div>
                            </div>
                        </th>

                        <label class="mt-8 block text-sm text-gray-100 text-center">CheckMas-Key: {{ $keySecurity }}</label>
        </div>

        
    </div>
</x-layout-print-ot>

