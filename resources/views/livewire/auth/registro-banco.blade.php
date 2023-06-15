<div class="min-h-screen flex flex-col gap-4 sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        <x-jet-authentication-card-logo />
    </div>
    <div class="mx-auto max-w-full sm:max-w-md mb-8 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="grid grid-cols-4">
            <div class="col-span-4">
                <div class="grid grid-cols-2 md:grid-cols-2 gap-1">
                    {{-- Nombre --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.nombre')</label>
                        <x-input wire:model="nombre" icon="user"  class="focus:ring-check-blue focus:border-check-blue"/>
                    </div>
                    {{-- Apellido --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.apellido')</label>
                        <x-input wire:model="apellido" icon="user"  class="focus:ring-check-blue focus:border-check-blue"/>
                    </div>
                </div>
                {{-- Telefono --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.telefono')</label>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                        <x-native-select wire:model="prefijo" class="focus:ring-check-blue focus:border-check-blue">
                            <option></option>
                            <option value="0212">0212</option>
                            <option value="0412">0412</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                        </x-native-select>
                        <x-input wire:model="telefono" right-icon="phone" class="focus:ring-check-blue focus:border-check-blue w-full"/>   
                    </div>
                    {{-- <x-input wire:model="telefono" icon="phone" class="focus:ring-check-blue focus:border-check-blue"/> --}}
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
                {{-- rol --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.rol')</label>
                    <x-native-select wire:model="rol" class="focus:ring-check-blue focus:border-check-blue">
                        <option></option>
                        <option value="3">@lang('messages.label.gteBanco')</option>
                        <option value="4">@lang('messages.label.gteServicios')</option>
                    </x-native-select>
                </div>
                {{-- agencia --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.agencia')</label>
                    <x-agencias></x-agencias>
                </div>
                {{-- estado --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.estado')</label>
                    <x-estados></x-estados>
                </div>
                <div class="grid grid-cols-1 md:grid-cols- gap-1 px-3 mt-4">
                    <div class="relative flex items-start">
                        <div class="flex h-5 items-center">
                            <x-checkbox id="checkbox" wire:model.defer="terminos"/>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="comments" class="font-medium text-gray-700">Terminos y Condiciones</label>
                            <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
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
                    <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                </div>
            </div>
        </div>
    </div>
</div>

