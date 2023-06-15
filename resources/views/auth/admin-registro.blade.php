<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <div class="flex items-center">
                <img class="w-96 h-auto" src="{{ asset('images/check_logo.png') }}" alt="">
            </div>
        </div>
        
        @livewire('auth.registro')

    </div>
</x-guest-layout>
