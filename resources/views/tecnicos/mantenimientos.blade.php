<x-layout-tecnicos>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            @livewire('view.mantenimientos')

            @push('modals')
            @livewire('view.ficha-tecnica-modal')
            @endpush
        </div>
    </div>

</x-layout-tecnicos>

