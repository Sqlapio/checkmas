<div class="overflow-x-auto border border-gray-200 dark:border-gray-700 md:rounded-lg shadow-lg my-10">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400 w-20">
                    
                </th>
                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400 w-20">
                    <div class="flex items-center gap-x-3">
                        <button class="flex items-center gap-x-2">
                            <span class="ml-1">Estado</span>
                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                            </svg>
                        </button>
                    </div>
                </th>

                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400 w-20">
                    Inversion($)
                </th>

                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400 w-20">
                    Porcentaje Inv.(%)
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
            @foreach ($data as $item)
            <tr>
                <td class="px-4 py-4 text-xl font-bold text-gray-700 dark:text-gray-200 text-center">
                    <div class="inline-flex items-center gap-x-3 rounded-lg" style="color: {{ $item->colores }}; background-color: {{ $item->colores }};">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>

                    </div>
                </td>
                <td class="px-4 py-4 text-sm font-extrabold text-gray-500 dark:text-gray-300">{{ $item->estados }}</td>
                <td class="px-4 py-4 text-sm font-extrabold text-gray-500 dark:text-gray-300 text-center">{{ number_format($item->totales, 2, ',', '.') }}$</td>
                <td class="px-4 py-4 text-sm font-extrabold text-gray-500 dark:text-gray-300 text-center">{{ app('App\Http\Controllers\UtilsController')->porcenInverPorEstado($item->totales) }}%</td>
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

