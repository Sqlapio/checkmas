<div class="p-5">
    <h1 class="text-xl mb-4">Memoria Fotográfica</h1>
    <div class="py-5 mt-4">
        <div class="flex justify-between">
            <input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
        </div>
    </div>
    <div class="overflow-auto rounded-lg shadow hidden md:block">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <div class="flex items-center gap-x-3">
                            <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                            <button class="flex items-center gap-x-2">
                                <span>@lang('messages.tablas.ot')</span>
                                <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                    <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                    <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                </svg>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Ubicacion
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Fotos Antes
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        Fotos Despues
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                @foreach ($data as $item)
                <tr>
                    {{-- Orden de trabajo --}}
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                        <div class="flex items-center gap-x-2 mr-8">
                            <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/orden-de-trabajo.png') }}" alt="">
                            <div>
                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">{{ $item->nro_ot }}</h2>
                            </div>
                        </div>
                    </td>

                    {{-- Ubicacion --}}
                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                        <div class="flex items-center gap-x-2 mr-8">
                            <img class="object-cover w-7 h-7 rounded-full" src="{{ asset('images/admi.png') }}" alt="">
                            <div>
                                <h2 class="text-sm font-medium text-gray-800 dark:text-gray-400">Agencia: {{ $item->agencia }}</h2>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Estado: {{ $item->estado }}</p>
                            </div>
                        </div>
                    </td>

                    {{-- antes --}}
                    <td class="px-4 py-4 text-sm font-medium text-gray-700">
                        <div class="flex items-center gap-x-2">
                            <a class="p-2" href="{{ asset('/storage/'.$item->foto1_antes) }}" target="_blank">
                                <img src="{{ asset('/storage/'.$item->foto1_antes) }}" class="w-16 h-16" />
                            </a>
                            <a class="p-2" href="{{ asset('/storage/'.$item->foto2_antes) }}" target="_blank">
                                <img src="{{ asset('/storage/'.$item->foto2_antes) }}" class="w-16 h-16" />
                            </a>
                        </div>
                        
                    </td>

                    {{-- despues --}}
                    <td class="px-4 py-4 text-sm font-medium text-gray-700">
                        <div class="flex items-center gap-x-2">
                            <a class="p-2" href="{{ asset('/storage/'.$item->foto1_despues) }}" target="_blank">
                                <img src="{{ asset('/storage/'.$item->foto1_despues) }}" class="w-16 h-16" />
                            </a>
                            <a class="p-2" href="{{ asset('/storage/'.$item->foto2_despues) }}" target="_blank">
                                <img src="{{ asset('/storage/'.$item->foto2_despues) }}" class="w-16 h-16" />
                            </a>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Div para la paginacion --}}
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            {{-- Paginacion --}}
            {{ $data->links() }}
        </div>
        {{-- Fin Div paginacion --}}
    </div>
        {{-- Tabla Responsive para movil --}}
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 md:hidden rounded-lg p-1 shadow-sm shadow-indigo-100">
            @foreach ($data as $item)
            <div class="bg-white p-4 rounded-xl  shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                <a href="{{ asset('/storage/'.$item->foto1_antes) }}" target="_blank">
                    <img src="{{ asset('/storage/'.$item->foto1_antes) }}" class="h-56 w-full rounded-md object-cover"/>
                    <div class="mt-2">
                        <!-- Oden de trabajo -->
                        <dl>
                            <div>
                                <dd class="text-sm text-gray-500">Orden de trabajo</dd>
                            </div>
                            <div>
                                <dd class="font-medium">Nro. {{ $item->nro_ot }}</dd>
                            </div>
                        </dl>
                        <!-- Div contenido -->
                        <div class="mt-6 flex items-center gap-8 text-xs">
                            <!-- Estado -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Estado</p>
                                    <p class="font-medium">{{ $item->estado }}</p>
                                </div>
                            </div>
                            <!-- Agencia -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Agencia</p>
                                    <p class="font-medium">{{ $item->agencia }}</p>
                                </div>
                            </div>
                            <!-- Foto -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Foto</p>
                                    <p class="font-medium">Antes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-white p-4 rounded-xl  shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                <a href="{{ asset('/storage/'.$item->foto2_antes) }}" target="_blank">
                    <img src="{{ asset('/storage/'.$item->foto2_antes) }}" class="h-56 w-full rounded-md object-cover"/>
                    <div class="mt-2">
                        <!-- Oden de trabajo -->
                        <dl>
                            <div>
                                <dd class="text-sm text-gray-500">Orden de trabajo</dd>
                            </div>
                            <div>
                                <dd class="font-medium">Nro. {{ $item->nro_ot }}</dd>
                            </div>
                        </dl>
                        <!-- Div contenido -->
                        <div class="mt-6 flex items-center gap-8 text-xs">
                            <!-- Estado -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Estado</p>
                                    <p class="font-medium">{{ $item->estado }}</p>
                                </div>
                            </div>
                            <!-- Agencia -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Agencia</p>
                                    <p class="font-medium">{{ $item->agencia }}</p>
                                </div>
                            </div>
                            <!-- Foto -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Foto</p>
                                    <p class="font-medium">Antes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-white p-4 rounded-xl  shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                <a href="{{ asset('/storage/'.$item->foto1_despues) }}" target="_blank">
                    <img src="{{ asset('/storage/'.$item->foto1_despues) }}" class="h-56 w-full rounded-md object-cover"/>
                    <div class="mt-2">
                        <!-- Oden de trabajo -->
                        <dl>
                            <div>
                                <dd class="text-sm text-gray-500">Orden de trabajo</dd>
                            </div>
                            <div>
                                <dd class="font-medium">Nro. {{ $item->nro_ot }}</dd>
                            </div>
                        </dl>
                        <!-- Div contenido -->
                        <div class="mt-6 flex items-center gap-8 text-xs">
                            <!-- Estado -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Estado</p>
                                    <p class="font-medium">{{ $item->estado }}</p>
                                </div>
                            </div>
                            <!-- Agencia -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Agencia</p>
                                    <p class="font-medium">{{ $item->agencia }}</p>
                                </div>
                            </div>
                            <!-- Foto -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Foto</p>
                                    <p class="font-medium">Despues</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-white p-4 rounded-xl  shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                <a href="{{ asset('/storage/'.$item->foto2_despues) }}" target="_blank">
                    <img src="{{ asset('/storage/'.$item->foto2_despues) }}" class="h-56 w-full rounded-md object-cover"/>
                    <div class="mt-2">
                        <!-- Oden de trabajo -->
                        <dl>
                            <div>
                                <dd class="text-sm text-gray-500">Orden de trabajo</dd>
                            </div>
                            <div>
                                <dd class="font-medium">Nro. {{ $item->nro_ot }}</dd>
                            </div>
                        </dl>
                        <!-- Div contenido -->
                        <div class="mt-6 flex items-center gap-8 text-xs">
                            <!-- Estado -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Estado</p>
                                    <p class="font-medium">{{ $item->estado }}</p>
                                </div>
                            </div>
                            <!-- Agencia -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Agencia</p>
                                    <p class="font-medium">{{ $item->agencia }}</p>
                                </div>
                            </div>
                            <!-- Foto -->
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-check-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Foto</p>
                                    <p class="font-medium">Despues</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                {{-- Paginacion --}}
                {{ $data->links() }}
            </div>
        </div>

</div>

