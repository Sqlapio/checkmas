<header class="header bg-check-blue shadow py-4 px-4">
    <div class="header-content flex items-center flex-row">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        @if(Auth::user()->empresa == 'IAIM')
        <div class="flex">
            <a href class="flex flex-row items-center">
                <img src="{{ asset('images/iaim/iaim-logo-01-isotipo-1.png') }}" class="w-8 h-auto max-[320px]:ml-3 max-[420px]:ml-3 xs:ml-3 sm:ml-3" alt="">
                <span class="flex flex-col ml-3 max-[320px]:hidden max-[420px]:hidden xs:hidden sm:hidden md:flex">
                    <p class="font-semibold text-xs tracking-wide leading-none text-white">INSTITUTO AEROPUERTO INTERNACIONAL</p>
                    <p class="font-semibold text-white text-xs leading-none mt-1 uppercase">Simón Bolívar de Maiquetía</p>
                </span>
            </a>
        </div>
        @endif
        <div x-data="{ dropdownOpen: false }"  class="flex ml-auto relative p-2">
            <button @click="dropdownOpen = ! dropdownOpen" class="flex flex-row items-center">
                <img src="{{ asset('images/user.png') }}" alt class="h-10 w-10 bg-gray-200 border rounded-full" />
                <span class="flex flex-col max-[320px]:hidden max-[420px]:hidden xs:hidden sm:hidden md:flex">
                    <span class="truncate w-40 text-white font-semibold tracking-wide leading-none">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
                    <span class="truncate w-40 text-white text-xs leading-none mt-1">{{ Auth::user()->email }}</span>
                </span>
            </button>

            <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

            <div x-cloak x-show="dropdownOpen" class="absolute right-0 z-10 w-48 mt-16 overflow-hidden bg-white rounded-md shadow-xl">
                {{-- <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-italblue hover:text-white">Profile</a> --}}
                {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-italblue hover:text-white">Products</a> --}}
                <a href="{{ route('logout') }}" data-method="post" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-red-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span class="ml-3">Cerrar sesión</span>
                </a>
            </div>
        </div>
    </div>
</header>
