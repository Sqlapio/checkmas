<div class="min-h-screen flex flex-col gap-4 sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        <x-jet-authentication-card-logo />
    </div>
    <div class="mx-auto w-full sm:max-w-md mb-8 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="grid grid-cols-4">
            <div class="col-span-4">
                <div class="grid grid-cols-1 md:grid-cols- gap-1">
                    {{-- email --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.email')</label>
                        <x-input wire:model="email" icon="user" class="focus:ring-check-blue focus:border-check-blue" />
                    </div>
                    {{-- password --}}
                    <div class="p-2">
                        <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">@lang('messages.label.pass')</label>
                        <x-inputs.password wire:model="password" class="focus:ring-check-blue focus:border-check-blue" />
                    </div>
                </div>
            </div>
        </div>
        {{-- Boton de registro --}}
        <div class="flex items-center justify-end mt-8 mb-8">
            <button type="submit" wire:click.prevent="recuperar_pass()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="recuperar_pass" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span>Registrar tu nueva contraseña</span>
            </button>
        </div>
    </div>
</div>

