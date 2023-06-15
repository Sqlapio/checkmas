<div class="flex flex-col">

        <div class="mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8" {{ $atr_table }}>
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <h1 class="font-bold text-2xl text-gray-700 drop-shadow-lg">Ordenes de trabajo asignadas</h1>
				<div class="py-5 mt-4">
					<div class="flex justify-between">
						<input wire:model="buscar" type="search" name="buscar" class="border-b border-gray-200 py-2 text-sm rounded-full sm:w-1/3 md:w-1/4 shadow-lg focus:ring-check-blue focus:border-check-blue" placeholder="Buscar..." autocomplete="off">
					</div>
				</div>
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg shadow-lg mb-8">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                          </svg> 
                                        <button wire:click="order" class="flex items-center gap-x-2">
                                            <span>Orden de Trabajo</span>
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                    Fecha Incio
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                    Responsable
                                </th>
								<th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                    Ficha Equipo
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                    Supervisor
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                    Estatus
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                    Accion
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
							@foreach ($data as $item)
							<tr>
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                    <div class="inline-flex items-center gap-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                          </svg>
                                          
                                          
                                        <span>{{ $item->otUid }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->fechaInicio }}</td>
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2 mr">
                                        <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('images/admi.png') }}" alt="">
                                        <div>
                                            <h2 class="text-sm font-medium text-gray-800 dark:text-white ">{{ $item->tecRes_NomApe }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $item->tecRes_email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 w-8 text-sm whitespace-nowrap">
                                    <div class="flex items-center justify-between gap-x-2">
                                        <button wire:click="showFicha({{ $item->id }}, '{{ $item->equipoUid }}')" class="flex text-blue-900 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                            {{ $item->equipoUid }}
                                        </button>
                                    </div>
                                </td>
                                
                                {{-- Owner --}}
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('images/supervi.png') }}" alt="">
                                        <div>
                                            {{-- <h2 class="text-sm font-medium text-gray-800 dark:text-white ">Arthur Me</h2> --}}
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $item->owner }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Estatus de las Ordenes de trabajo --}}
                                @if($item->statusOts == '1')
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-sky-500 bg-sky-100/60 dark:bg-gray-800">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>

                                            <h2 class="text-sm font-normal">Creada</h2>
                                        </div>
                                    </td>
                                @endif
                                @if($item->statusOts == '2')
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-green-500 bg-green-100/60 dark:bg-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                              </svg>                                              
                                            <h2 class="text-sm font-normal">Aprobada</h2>
                                        </div>
                                    </td>
                                @endif
                                @if($item->statusOts == '3')
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-orange-500 bg-orange-100/60 dark:bg-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                              </svg>                                              
                                            <h2 class="text-sm font-normal">Ejecucion</h2>
                                        </div>
                                    </td>
                                @endif
                                @if($item->statusOts == '4')
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-yellow-500 bg-yellow-100/60 dark:bg-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                              </svg>                                              
                                            <h2 class="text-sm font-normal">Supervicion</h2>
                                        </div>
                                    </td>
                                @endif
                                @if($item->statusOts == '5')
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center font-bold px-3 py-1 rounded-full gap-x-2 text-green-700 bg-green-100/60 dark:bg-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                              </svg>                                              
                                            <h2 class="text-sm font-normal">Finalizada</h2>
                                        </div>
                                    </td>
                                @endif

                                {{-- Cambio de estatus --}}
                                @if(Auth::user()->rol == 7)
                                <td class="px-4 py-4 text-sm whitespace-nowrap">

                                    {{-- Estatus ejecucion --}}
                                    @if($item->statusOts == '3')
                                    <button type="submit" wire:click="updateStatusSupervisor({{ $item ->id }}, '3')" class=" text-orange-500 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                          </svg>                                              
                                    </button>
                                    @else
                                    <button type="submit" wire:click="updateStatusSupervisor({{ $item ->id }}, '3')" class=" text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                          </svg>                                              
                                    </button>
                                    @endif

                                    {{-- Estatus supervicion --}}
                                    @if($item->statusOts == '4')
                                    <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '4')" class="text-yellow-500 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                          </svg>                                               
                                    </button>
                                    @else
                                    <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '4')" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                          </svg>                                               
                                    </button>
                                    @endif

                                    {{-- Estatus finalizada --}}
                                    @if($item->statusOts == '5')
                                    <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '5')" class="text-green-700 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                          </svg>                                               
                                    </button>
                                    @else
                                    <button type="submit" wire:click="updateStatusSupervisor({{ $item->id }}, '5')" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-4 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                          </svg>                                               
                                    </button>
                                    @endif

                                    {{-- Imprime orden --}}
                                    <button wire:click="ePrint({{ $item->id }})" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                          </svg>                                      
                                    </button>


                                    {{-- Resetear status --}}
                                    @if(Auth::user()->email == 'richardmaclaud@hotmail.com')
                                    <button type="submit" wire:click="resetearStatus({{ $item->id }}, '5')" class="flex ml-9 mt-2 items-end text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <span class="text-xs">Resetar estatus</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-orange-500 ml-3 w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                          </svg>                                          
                                    </button>
                                    @endif
                                    
                                </td>
                                @else
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    <button wire:click="ePrint({{ $item->id }})" class="text-gray-400 transition-colors duration-200 font-extrabold  dark:hover:text-indigo-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                          </svg>
                                                                               
                                    </button>
                                </td>
                                @endif
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
            </div>
        </div>

        {{-- formulario cierre de ots --}}
        <div class="border border-gray-200 rounded-lg shadow-md px-4" {{ $atr_form }}>
            {{-- Datos Orden de trabajo --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 mt-8">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Nro. de orden</label>
                    <x-input icon="pencil" wire:model="nro_ot" class="focus:ring-check-blue focus:border-check-blue cursor-none"/>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4 mt-8">
                <div class="p-2">
                    <label class="opacity-60 mb-1 block text-sm font-medium text-italblue">Observaciones</label>
                    <x-textarea wire:model="observaciones" placeholder="Por favor indique cual es su Incidencia de forma Detallada" class="focus:ring-check-blue focus:border-check-blue" />
                </div>
            </div>
            {{-- Boton de registro --}}
            <div class="flex items-center justify-end mt-8 mb-8">
                <button type="submit" wire:click.prevent="actualiza_estatus()" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-check-blue py-2 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="actualiza_estatus" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span>Finalizar orden de trabajo</span>
                </button>
            </div>
        </div>
</div>