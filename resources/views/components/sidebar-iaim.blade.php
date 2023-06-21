
<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class=" fixed shadow-2xl inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-italgray lg:translate-x-0 lg:static lg:inset-0">
<aside class="sidebar w-64 md:shadow h-full" style="background-color: rgb(230 240 234);">
    <div class="sidebar-header flex items-center justify-center">
        <div class="inline-flex">
            <a href="#" class="inline-flex flex-row items-center">
                <img src="{{ asset('images/check_logo.png') }}" alt="">
            </a>
        </div>
    </div>
    <div class="sidebar-content px-4 py-6">
            <ul class="flex flex-col w-full">

                <li class="my-px">
                    <a href="{{ route('dashboard-admin-iaim') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-700 bg-gray-100">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </span>
                        <span class="ml-3">@lang('messages.menu.dash')</span>
                    </a>
                </li>

                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 mt-6 mb-4 uppercase">@lang('messages.menu.usuarios')</span>
                </li>
                <li class="my-px">
                    <a href="{{ route('usuarios-activos') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                              </svg>                              
                        </span>
                        <span class="ml-3">Actividad de Usuarios</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="{{ route('lista-usuarios') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <span class="ml-3">@lang('messages.menu.usuarios')</span>
                        <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto">10</span>
                    </a>
                </li>

                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase cursor-pointer" onclick="ot()">Orden de Trabajo</span>
                </li>
                <div id="ot" >
                    <li class="my-px">
                        <a href="{{ route('crear-orden-trabajo') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                  </svg>                                  
                            </span>
                            <span class="ml-3">Crear</span>
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('listar-orden-trabajo') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                  </svg>                                  
                            </span>
                            <span class="ml-3">Listar</span>
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('certificar-orden-trabajo') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-check-green">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                  </svg>
                                                                    
                            </span>
                            <span class="ml-3">FINALIZAR</span>
                        </a>
                    </li>
                </div>

                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase cursor-pointer" onclick="inventario()">Inventario</span>
                </li>
                <div id="inventario">
                    <li class="my-px">
                        <a href="{{ route('iaim-articulos') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                  </svg> 
                            </span>
                            <span class="ml-3">Artículo</span>
                            <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto">01</span>
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('art-entrada') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                  </svg>                              
                            </span>
                            <span class="ml-3">Entradas</span>
                            
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('art-salida') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                  </svg>                               
                            </span>
                            <span class="ml-3">Salidas</span>
                            
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('flujo-inventario') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                  </svg> 
                            </span>
                            <span class="ml-3">Flujo de Inventario</span>
                        </a>
                    </li>
                </div>
                
                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase cursor-pointer" onclick="reportesInventario()">Reportes</span>
                </li>
                <div id="reportes">
                    <li class="my-px">
                        <a href="{{ route('reporte.articulos') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-6 w-6 bi bi-file-earmark-pdf text-red-500" viewBox="0 0 16 16"> 
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/> 
                                    <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/> 
                                </svg> 
                            </span>
                            <span class="ml-3">Artículos</span>
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('reporte.entradas') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-6 w-6 bi bi-file-earmark-pdf text-red-500" viewBox="0 0 16 16"> 
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/> 
                                    <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/> 
                                </svg> 
                            </span>
                            <span class="ml-3">Entradas</span>
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('reporte.salidas') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-6 w-6 bi bi-file-earmark-pdf text-red-500" viewBox="0 0 16 16"> 
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/> 
                                    <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/> 
                                </svg> 
                            </span>
                            <span class="ml-3">Salidas</span>
                        </a>
                    </li>
                    <li class="my-px">
                        <a href="{{ route('reporte-personalizado') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 bi bi-file-earmark-pdf text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
                                  </svg>
                                  
                            </span>
                            <span class="ml-3">Personalizado</span>
                        </a>
                    </li>
                </div>

            </ul>
        </div>
    </aside>
    <script>
        function inventario() {
          var x = document.getElementById("inventario");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }

        function reportesInventario() {
          var x = document.getElementById("reportes");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }

        function oc() {
          var x = document.getElementById("oc");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }

        function ot() {
          var x = document.getElementById("ot");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }
    </script>
</div>

