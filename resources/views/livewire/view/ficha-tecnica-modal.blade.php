<div class="{{ $atr_showModal }} relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!--
            Background backdrop, show/hide based on modal state.
        
            Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
            Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!--
                Modal panel, show/hide based on modal state.
        
                Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        {{-- <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Ficha Tecnica</h3>
                        <div class="mt-2">
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                                <div class="p-2">
                                    <ul class="list-disc">
                                        <li>Agencia: {{ $agencia }}</li>
                                        <li>Estado: {{ $estado }}</li>
                                        <li>Oficina: {{ $oficina }}</li>
                                        <li>Piso: {{ $piso }}</li>
                                        <li>Capacidad(BTU): {{ $btu }}</li>
                                        <li>Tipo de Sistema: {{ $tipoSistema }}</li>
                                        <!-- ... -->
                                    </ul>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="p-2">
                                    <label class="font-extrabold text-black drop-shadow-lg">@lang('messages.label.qrConden')</label>
                                            {{ QrCode::size(150)->merge('/public/images/check_logo.png', .8)->generate('#'.$qrConden) }}
                                </div>
                                @if($tipoSistema != 'compacto')
                                <div class="p-2">
                                    <label class="font-extrabold text-black drop-shadow-lg">@lang('messages.label.qrEva')</label>
                                            {!! QrCode::size(150)->generate('#'.$qrEvaporador) !!}
                                </div>
                                @endif
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="flex justify-center">
                                    <label class="font-extrabold text-black text-2xl drop-shadow-lg">{{ $qrConden }}</label>      
                                </div>
                                <div class="flex justify-center">
                                    <label class="font-extrabold text-black text-2xl drop-shadow-lg">{{ $qrEvaporador }}</label>         
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button"  wire:click="closeModal" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Deactivate</button>
                    {{-- <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>

