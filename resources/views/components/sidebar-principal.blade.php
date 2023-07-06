@php
use App\Models\User;
use App\Models\Tikect;
use App\Models\MensajeEnviado;
use App\Models\MensajeRecibido;
use App\Models\FichaTecnica;
use App\Models\Ot;
    $rol = Auth::user()->rol;
    $nroUserBT = User::where('empresa', 'Banco del Tesoro')->count();
    $nroEquipos = FichaTecnica::all()->count();
    $nroOts = Ot::count();

    if($rol == 1 || $rol <= 4){
        $nroUser = $nroUserBT;
        $nroTikect = Tikect::count();  
    }else{
        $nroUser = User::count();
        $nroTikect = Tikect::count();     
    }

    $me = MensajeEnviado::where('emisor', Auth::user()->email)->count();
    $mr = MensajeRecibido::where('receptor', Auth::user()->email)->count();
@endphp
<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class=" fixed shadow-2xl inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-italgray lg:translate-x-0 lg:static lg:inset-0">
<aside class="sidebar w-64 md:shadow h-full" style="background-color: rgb(230 240 234);">
    <div class="sidebar-header flex items-center justify-center">
        <div class="inline-flex">
            <a href="#" class="inline-flex flex-row items-center">
                {{-- <svg class="w-10 h-10 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.757 2.034a1 1 0 01.638.519c.483.967.844 1.554 1.207 2.03.368.482.756.876 1.348 1.467A6.985 6.985 0 0117 11a7.002 7.002 0 01-14 0c0-1.79.684-3.583 2.05-4.95a1 1 0 011.707.707c0 1.12.07 1.973.398 2.654.18.374.461.74.945 1.067.116-1.061.328-2.354.614-3.58.225-.966.505-1.93.839-2.734.167-.403.356-.785.57-1.116.208-.322.476-.649.822-.88a1 1 0 01.812-.134zm.364 13.087A2.998 2.998 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879.586.585.879 1.353.879 2.121s-.293 1.536-.879 2.121z" clip-rule="evenodd" />
                </svg> --}}
                {{-- <span class="leading-10 text-gray-100 text-2xl font-bold ml-1 uppercase">Brandname</span> --}}
                <img src="{{ asset('images/check_logo.png') }}" alt="">
            </a>
        </div>
    </div>
    <div class="sidebar-content px-4 py-6">
            <ul class="flex flex-col w-full">
                @if($rol == 1 || $rol == 2 || $rol == 5 || $rol == 6)
                <li class="my-px">
                    <a href="{{ route('dashboard-admin') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-700 bg-gray-100">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </span>
                        <span class="ml-3">@lang('messages.menu.dash')</span>
                    </a>
                </li>
                @endif
                @if($rol == 5 || $rol == 2)
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
                        <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto">{{$nroUser}}</span>
                    </a>
                </li>
                @endif
                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">@lang('messages.menu.administracion')</span>
                </li>
                @if($rol == 5 || $rol == 6 || $rol == 7)
                <li class="my-px">
                    <a href="{{ route('lista-tikects') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <img class="object-cover w-auto h-4" src="{{ asset('images/DEL-TESORO-COLOR.png') }}" alt="">
                        </span>
                        <span class="ml-3">@lang('messages.menu.ticket')</span>
                        <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto">{{$nroTikect}}</span>
                    </a>
                </li>
                @endif
                @if($rol == 1 || $rol == 2 || $rol == 3 || $rol == 4)
                <li class="my-px">
                    <a href="{{ route('lista-tikects') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                              </svg>                              
                        </span>
                        <span class="ml-3">@lang('messages.menu.ticket')</span>
                        <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto">{{$nroTikect}}</span>
                    </a>
                </li>
                @endif
                @if($rol == 2 || $rol == 3 || $rol == 4)
                <li class="my-px">
                    <a href="{{ route('crear-tikect') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-check-green">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <span class="ml-3">@lang('messages.menu.crearTicket')</span>
                    </a>
                </li>
                @endif
                @if($rol == 5 || $rol == 6 || $rol == 7)
                {{-- Crear Ots --}}
                <li class="my-px">
                    <div href="" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 cursor-pointer">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                              </svg>                              
                        </span>
                        <span class="ml-3" onclick="ot()">@lang('messages.menu.crearOts')</span>
                    </div>
                </li>
                <div id="ot" class="mt-3 mb-3" style="display:none;">
                    {{-- Mto. Preventivo --}}
                    <li class="ml-5">
                        <a href="{{ route('crear-mto-preventivo') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                  </svg>                                                           
                            </span>
                            <span class="ml-3">Mto. Preventivo</span>
                        </a>
                    </li>
                    {{-- Mto. Correctivo --}}
                    <li class="ml-5">
                        <a href="{{ route('crear-mto-correctivo') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-check-green">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  </svg>                                                                
                            </span>
                            <span class="ml-3">Mto. Correctivo</span>
                        </a>
                    </li>
                </div>
                @endif
                @if($rol == 1 || $rol == 2 || $rol == 3 || $rol == 4 || $rol == 5 || $rol == 6)
                <li class="my-px">
                    <a href="{{ route('dash-mantenimientos') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                              </svg>                              
                        </span>
                        <span class="ml-3">@lang('messages.menu.listaOts')</span>
                        <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto">{{$nroOts}}</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="{{ route('equipos') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                              </svg>                              
                        </span>
                        <span class="ml-3">Equipos</span>
                        <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto">{{$nroEquipos}}</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="{{ route('dash-mantenimientos-culminados') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                              </svg>                                                          
                        </span>
                        <span class="ml-3">Memoria Fotográfica</span>
                    </a>
                </li>
                @endif
                @if($rol == 5)
                <li class="my-px">
                    <a href="{{ route('bitacora') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                              </svg>                              
                        </span>
                        <span class="ml-3">Bitacoras</span>
                    </a>
                </li>
                @endif
                {{-- <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Mensajeria</span>
                </li>
                <li class="my-px">
                        <a href="{{ route('mensajes-enviados') }}" class="relative flex flex-row items-center h-12 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                            <div class="absolute bottom-auto top-0 inline-block whitespace-nowrap rounded-full bg-red-600 px-1.5 py-1 text-center align-baseline text-xs font-bold leading-none text-white">
                                {{ $me }}
                            </div>
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>                              
                            </span>
                            <span class="ml-3">Enviados</span>
                            <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto"></span>
                        </a>
                </li>
                <li class="my-px">
                    <a href="{{ route('mensajes-recibidos') }}" class="relative flex flex-row items-center h-12 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <div class="absolute bottom-auto top-0 inline-block whitespace-nowrap rounded-full bg-red-600 px-1.5 py-1 text-center align-baseline text-xs font-bold leading-none text-white">
                            {{ $mr }}
                        </div>
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>                              
                        </span>
                        <span class="ml-3">Recibidos</span>
                        <span class="flex items-center justify-center text-xs text-check-blue font-bold bg-green-100 h-6 px-2 rounded-full ml-auto"></span>
                    </a>
                </li> --}}
                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">@lang('messages.menu.reportes')</span>
                </li>
                <li class="my-px">
                    <a href="{{ route('reporte.ots') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-6 w-6 bi bi-file-earmark-pdf" viewBox="0 0 16 16"> 
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/> 
                                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/> 
                            </svg> 
                        </span>
                        <span class="ml-3">Ots</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="{{ route('reporte.tickets') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-6 w-6 bi bi-file-earmark-pdf" viewBox="0 0 16 16"> 
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/> 
                                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/> 
                            </svg>
                        </span>
                        <span class="ml-3">@lang('messages.reportes.ticket')</span>
                    </a>
                </li>
                {{-- @if($rol == 5)
                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Configuracion</span>
                </li>
                <li class="my-px">
                    <a href="{{ route('valor-tonelada') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>                              
                        </span>
                        <span class="ml-3">Tonelada($)</span>
                    </a>
                </li>
                @endif --}}
            </ul>
        </div>
    </aside>
    <script>
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
