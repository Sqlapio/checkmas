<div>
    <div class="flex justify-between">
        <div class="w-full mt-4">
            <img src="{{ asset('images/banner_resIndex.png') }}" class="w-full" alt="">
        </div>
    </div>
    <div class="mt-2 ml-8 mb-8 w-full">
        <h1 class="px-2 text-2xl font-extrabold text-check-blue dark:text-white">
            ¡Le damos la bienvenida a CheckMas!
        </h1>
        <p class="mt-2 px-2 text-base font-bold text-gray-600">
            Cuentanos un poco mas sobre Usted para que podamos personalizar su experiencia...
        </p>

    </div>
    <div class="grid grid-cols-1 mr-4 md:grid-cols-4 ml-10 mt-12">
        <div class="p-2">
            <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">¿Cuál es el Nombre de tu Empresa?</label>
                <x-native-select wire:model.defer="tipoEmpresa" class="focus:ring-check-blue focus:border-check-blue">
                    <option></option>
                    <option value="BANCO DEL TESORO">BANCO DEL TESORO</option>
                    <option value="TRX">TRX</option>
                    <option value="IAIM">IAIM</option>
                </x-native-select>
        </div>  
    </div>
    <div class="flex items-center justify-start mt-10 ml-8">
        <button type="submit" wire:click.prevent="verRegistro()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
            <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="store" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            <span>SIGUIENTE</span>
        </button>
    </div>

</div>

