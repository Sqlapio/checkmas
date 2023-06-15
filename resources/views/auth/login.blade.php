<x-guest-layout>
    <div class="hidden xl:block">
        <div class="flex flex-wrap justify-end bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/banner2.png') }}');">
            @livewire('auth.login')
        </div>
        {{-- <div class="w-full">
            <img src="{{ asset('images/bannerV3.png') }}" class="w-full" alt="">
        </div> --}}
        <div class="w-full">
            <img src="{{ asset('images/seccionV3.png') }}" class="w-full" alt="">
        </div>
        <div>
            <footer class="bg-neutral-200 text-center text-white dark:bg-neutral-600">
                <div class="bg-neutral-300 p-4 text-center text-check-green dark:bg-neutral-700 dark:text-neutral-200">
                    © 2023 Copyright:
                    <a class="text-check-green dark:text-neutral-400 font-bold" href="https://tailwind-elements.com/">All rights reserved. by StarkMedios</a>
                </div>
            </footer>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 bg-check-blue h-screen lg:h-screen xl:hidden">
        <div class="w-full">
            <img src="{{ asset('images/banner_mobile.png') }}" class="w-full" alt="">
            <div class="flex justify-center bg-check-blue">
                @livewire('auth.login')
            </div>
        </div>
    </div>
</x-guest-layout>

