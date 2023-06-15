<div class="min-h-screen flex flex-col gap-4 sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-l hover:bg-gradient-to-r from-cyan-500 to-blue-500">
    <div>
        <x-jet-authentication-card-logo />
    </div>
    <div class="mx-auto max-w-full sm:max-w-md mb-8 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="grid grid-cols-4">
            <div class="col-span-4">
                <div class="grid grid-cols-2 md:grid-cols- gap-1">
                    {{-- Nombre --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.nombre')</label>
                        <x-input wire:model="nombre" icon="user" />
                    </div>
                    {{-- Apellido --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.apellido')</label>
                        <x-input wire:model="apellido" icon="user" />
                    </div>
                </div>
                {{-- Telefono --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.telefono')</label>
                    <x-input wire:model="telefono" icon="phone"/>
                </div>
                {{-- email --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.email')</label>
                    <x-input wire:model="email" icon="user" />
                </div>
                {{-- password --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.pass')</label>
                    <x-inputs.password wire:model="password" />
                </div>
                {{-- estado --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.estado')</label>
                    <x-input wire:model="estado" icon="user" />
                </div>
                {{-- agencia --}}
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.agencia')</label>
                    <x-input wire:model="agencia" icon="user" />
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
            <button type="submit" wire:click.prevent="store()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-red-200 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-200">
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
