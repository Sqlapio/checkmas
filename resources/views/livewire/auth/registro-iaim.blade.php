<div class="min-h-screen flex flex-col gap-4 sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        <x-jet-authentication-card-logo />
    </div>
    <div class="mx-auto max-w-full sm:max-w-md mb-8 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="grid grid-cols-4">
            <div class="col-span-4">
                {{-- Nombre y apellido --}}
                <div class="grid grid-cols-2 md:grid-cols-2 gap-1">
                    {{-- Nombre --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Nombre</label>
                        <x-input wire:model="nombre" icon="user"  class="focus:ring-check-blue focus:border-check-blue"/>
                    </div>

                    {{-- Apellido --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Apellido</label>
                        <x-input wire:model="apellido" icon="user"  class="focus:ring-check-blue focus:border-check-blue"/>
                    </div>
                </div>
                {{-- Cedula y cargo --}}
                <div class="grid grid-cols-2 md:grid-cols-2 gap-1">
                    {{-- cedula --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Cédula</label>
                        <x-input wire:model="ci_rif" icon="user"  class="focus:ring-check-blue focus:border-check-blue"/>
                    </div>
                    {{-- cargo --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Cargo</label>
                        <x-native-select wire:model="cargo" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="Intendente">INTENDENTE</option>
                            <option value="Jefe de division">JEFE DE DIVISION</option>
                            <option value="Contratado">CONTRATADO</option>
                            <option value="Director">DIRECTOR</option>
                        </x-native-select>
                    </div>
                </div>
                {{-- Devicion y Coordinacion --}}
                <div class="grid grid-cols-2 md:grid-cols-2 gap-1">
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Divison</label>
                        <x-native-select wire:model="division" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="dhiav">DHIAV</option>
                            <option value="n/a">No aplica</option>
                        </x-native-select>
                    </div>
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Coordinacion</label>
                        <x-native-select wire:model="coordinacion" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="iaim_sm">SERVICIO DE MANTENIMIENTO</option>
                            <option value="n/a">No Aplica</option>
                        </x-native-select>
                    </div>
                </div>
                {{-- email --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.email')</label>
                    <x-input wire:model="email" icon="user"  class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                {{-- password --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.pass')</label>
                    <x-inputs.password wire:model="password"  class="focus:ring-check-blue focus:border-check-blue"/>
                </div>
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Firma digital</label>
                    <input id="" wire:model="firma_digital" type="file" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-green-50 file:text-check-blue
                    hover:file:bg-green-100 mt-2">
                    @error('imgPlacaCompresor') <span class="error text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols- gap-1 px-3 mt-4">
                    <div class="relative flex items-start">
                        <div class="text-sm">
                            <p class="text-red-500">NOTA: Sí la firma digital no es cargada el sistema utilizara su nombre de usuario para identificar sus acciones</p>
                        </div>
                    </div>
                </div>
                {{-- Terminos y condiciones --}}
                <div class="grid grid-cols-1 md:grid-cols- gap-1 px-3 mt-8">
                    <div class="relative flex items-start">
                        <div class="flex h-5 items-center">
                            <x-checkbox id="checkbox" wire:model.defer="terminos"/>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="comments" class="font-medium text-gray-700">Terminos y Condiciones</label>
                            <p class="text-gray-500">La utilización del Portal, sus servicios o contenidos implica la aceptación plena y sin reservas de todas las disposiciones contenidas en la versión publicada en el momento en que el usuario acceda al sitio.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center mt-4">
            <button type="submit" wire:click.prevent="store()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span> REGISTRAR</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols- gap-1 px-3 mt-4">
            <div class="relative flex items-start">
                <div class="ml-3 text-sm">
                    <p class="text-gray-500"></p>
                </div>
            </div>
        </div>
    </div>
</div>
