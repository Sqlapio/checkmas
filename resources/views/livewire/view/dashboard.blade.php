@php

use App\Models\Ot;
use App\Models\Tikect;
use App\Models\Estado;
use App\Models\Estadistica;
use Carbon\Carbon;

$fecha = Carbon::now();
$totalOts = Ot::where('statusOts', '5')
        ->where('updated_at', '<', $fecha)
        ->where('tipoMantenimiento', 'MC')
        ->sum('costo_preCli');

$totalEstadisticas = Estadistica::all()->sum('total_inversion_mp_mc');
        // dd($totalEstadisticas);

$totalTickets = Tikect::all()->count();

/*
Logica para calcular el Nro. de Ots finalizadas por estado
GRAFICO DE DONA
GRAFICO Nro. 1
*/
$otsList = Ot::select(DB::raw("count(*) as ots"), DB::raw("estado as estados"), DB::raw("color as colores"))
            ->where('statusOts', 5)
            ->orderBy('ots', 'desc')
            ->groupBy(DB::raw("estado, color"))
            ->limit(5)
            ->get();
$colorOts = $otsList->pluck('colores');
$estOts = $otsList->pluck('estados');
$ots = $otsList->pluck('ots');


$total_ots = Ot::select(DB::raw("count(*) as ots"), DB::raw("estado as estados"), DB::raw("color as colores"))
            ->where('statusOts', 5)
            ->orderBy('ots', 'desc')
            ->groupBy(DB::raw("estado, color"))
            ->get();


$estados = Estado::select(DB::raw("descripcion as estados"))
            ->orderBy('estados', 'asc')
            ->get();
$listaEstados = $estados->pluck('estados');

/*
Logica para calcular el porcentaje de inversion por cada estado
GRAFICO DE DONA
GRAFICO Nro. 2
*/
$porList = Estadistica::select(DB::raw("total_inversion_mp_mc as totales"), DB::raw("estado as estados"), DB::raw("color as colores"))
            ->where('total_inversion_mp_mc', '>', 0.00)
            ->orderBy('totales', 'desc')
            ->limit(5)
            ->get();
$colores = $porList->pluck('colores');
$estados = $porList->pluck('estados');
$valores = $porList->pluck('totales');

$total_inversion = Estadistica::select(DB::raw("total_inversion_mp_mc as totales"), DB::raw("estado as estados"), DB::raw("color as colores"))
            ->where('total_inversion_mp_mc', '>', 0.00)
            ->orderBy('totales', 'desc')
            ->get();


/*
Logica para calcular el Nro. de tikects creados por estado
GRAFICO DE DONA
GRAFICO Nro. 3
*/
$tikectList = Tikect::select(DB::raw("count(*) as tikects"), DB::raw("estado as estados"), DB::raw("color as colores"))
            ->orderBy('tikects', 'desc')
            ->limit(5)
            ->groupBy(DB::raw("estado, color"))
            ->get();
$colorTi = $tikectList->pluck('colores');
$estTi = $tikectList->pluck('estados');
$tikects = $tikectList->pluck('tikects');

$total_tikect = Tikect::select(DB::raw("count(*) as tikects"), DB::raw("estado as estados"), DB::raw("color as colores"))
            ->orderBy('tikects', 'desc')
            ->groupBy(DB::raw("estado, color"))
            ->get();



$tikcet_g3 = Tikect::select(DB::raw("count(*) as tikects"), DB::raw("estado as estados"))
            ->orderBy('estados', 'asc')
            ->groupBy(DB::raw("estado"))
            ->get();
$total_ticket = $tikcet_g3->pluck('tikects');
$estados_ticket = $tikcet_g3->pluck('estados');


$tikcet_ot = DB::table('ots')
            ->join('tikects', 'ots.estado_tikect', '=', 'tikects.estado')
            ->select(DB::raw("count(ots.otUid) as Ots"), DB::raw("ots.estado_tikect as estados"))
            ->orderBy('ots.estado_tikect', 'asc')
            ->groupBy(DB::raw("estados"))
            ->get();
$total_ticket_ot = $tikcet_ot->pluck('Ots');
$estados_ticket_ot = $tikcet_ot->pluck('estados');

@endphp
<x-app-layout>
    <style>
        .mobile{
            padding-left: 0;
            padding-right: 0;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
            display: block;
            width: auto;
        }
        @media only screen and (max-width: 768px){
                .mobile 
                {
                    padding-left: 0;
                    padding-right: 0;
                    margin-left: 10px;
                    margin-right: 10px;
                    margin-bottom: 10px;
                    display: block;
                    width: auto;
                    height: auto;
                }
        }
        @media only screen and (max-width: 320px){
                .mobile 
                {
                    padding-left: 0;
                    padding-right: 0;
                    margin-left: 10px;
                    margin-right: 10px;
                    margin-bottom: 10px;
                    display: block;
                    width: auto;
                    height: auto;
                }
        }
    </style>
    <div class="flex flex-wrap">
        {{-- Total Ots --}}
        <div class="w-full md:w-1/2 lg:w-6/12 xl:w-3/12 px-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">inversion($)<br>Ots<br>al {{ Carbon::parse($fecha)->format('d-m-Y') }}</h5>
                            <x-inversion />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/dolar.png') }}" class="w-36" alt="">
                                {{-- <i class="far fa-chart-bar"></i> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <p class="text-sm text-blueGray-400 mt-4">
                        <x-porInver_ots_cerradas/>
                        <span class="whitespace-nowrap"></span></p> --}}
                </div>
            </div>
        </div>
        {{-- Total Tickets --}}
        <div class="w-full md:w-1/2 lg:w-6/12 xl:w-3/12 px-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">tickets emitidos<br>por la agencia<br>al {{ Carbon::parse($fecha)->format('d-m-Y') }} </h5>
                            <x-tikects_abiertos />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/mantenimiento.png') }}" class="w-36" alt="">
                                {{-- <i class="far fa-chart-bar"></i> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <p class="text-sm text-blueGray-400 mt-4">
                        <x-porcen_tikects_cerrados />
                        <span class="whitespace-nowrap"></span></p> --}}
                </div>
            </div>
        </div>
        {{-- Ots Finalizadas --}}
        <div class="w-full md:w-1/2 lg:w-6/12 xl:w-3/12 px-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">Ots<br>finalizadas<br>al {{ Carbon::parse($fecha)->format('d-m-Y') }}</h5>
                            <x-ots_finalizadas />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/check_icon.png') }}" class="w-36" alt="">
                                {{-- <i class="far fa-chart-bar"></i> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <p class="text-sm text-blueGray-400 mt-4">
                        <span class="text-orange-500 mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span class="whitespace-nowrap"></span></p> --}}
                </div>
            </div>
        </div>
        {{-- Ots en ejecucion --}}
        <div class="w-full md:w-1/2 lg:w-6/12 xl:w-3/12 px-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">Ots<br>en ejecucion<br>al {{ Carbon::parse($fecha)->format('d-m-Y') }}</h5>
                            <x-total_ots_ejecucion />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/ejecucion.png') }}" class="w-36" alt="">
                                {{-- <i class="far fa-chart-bar"></i> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <p class="text-sm text-blueGray-400 mt-4">
                        <x-porcen_ots_ejecucion />
                        <span class="whitespace-nowrap"></span></p> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Seccion de graficos --}}
    <section class="bg-white dark:bg-gray-900">
        <div class=" px-1 py-5 mx-auto">
            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 sm:grid-cols-1  md:grid-cols-1  lg:grid-cols-1 xl:grid-cols-3">
                
                <!-- Graficos de torta -->
                <div class="w-full ">
                    <h1 class="w-full text-center text-xs px-8 py-4 font-bold rounded-lg dark:bg-gray-700">
                        OTS FINALIZADAS POR ESTADO
                    </h1>

                    <div class="w-full shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] border border-gray-200 rounded-lg dark:bg-gray-600 pt-4 pb-6">
                        <canvas id="myChart3" width="270" height="270"></canvas>
                    </div>
                    {{-- <button id="pdf" onclick="downloadPDF()">PDF</button> --}}
                    <div class="mx-auto mt-8 w-full sm:w-auto divide-y">
                        @foreach($total_ots as $item)
                        <div class="flex items-center">
                            <div class="w-3 h-3 mr-3 rounded-full" style="background-color:{{ $item->colores }}"></div>
                            <span class="text-xs">{{ $item->estados }}</span>
                            <span class="ml-auto text-xs">{{ $item->ots }}</span>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
                <!-- Graficos de dona 2 -->
                <div class="w-full ">
                    <h1 class="w-full text-center font-bold text-xs px-8 py-4 rounded-lg dark:bg-gray-700">
                        INVERSION POR ESTADOS
                    </h1>
                                           
                    <div class="w-full shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] border border-gray-200 rounded-lg dark:bg-gray-600 pt-4 pb-6">
                        <canvas id="myChart2" width="270" height="270"</canvas>
                    </div>
                    <div class="mx-auto mt-8 w-full sm:w-auto divide-y">
                        @foreach($total_inversion as $item)
                        <div class="flex items-center">
                            <div class="w-3 h-3 mr-3 rounded-full" style="background-color:{{ $item->colores }}"></div>
                            <span class="text-xs">{{ $item->estados }}</span>
                            <span class="ml-auto text-xs">{{ number_format($item->totales, 2, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Graficos de dona 3 -->
                <div class="w-full">
                    <h1 class="w-full text-center text-xs font-bold px-8 py-4 rounded-lg dark:bg-gray-700">
                        TICKETS GENERADOS
                    </h1>
                    <div class="shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] border border-gray-200 rounded-lg dark:bg-gray-600 pt-4 pb-6">
                        <canvas id="chartDoughnut" width="270" height="270"></canvas>
                    </div>
                    <div class="mx-auto mt-8 w-full sm:w-auto divide-y">
                        @foreach($total_tikect as $item)
                        <div class="flex items-center">
                            <div class="w-3 h-3 mr-3 rounded-full" style="background-color:{{ $item->colores }}"></div>
                            <span class="text-xs">{{ $item->estados }}</span>
                            <span class="ml-auto text-xs">{{ $item->tikects }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4 mt-8">
            <h1 class="w-full text-center font-bold text-xs px-8 py-4 rounded-lg dark:bg-gray-700">
                ORDENES DE TRABAJO (OTS) VS TICKETS REGISTRADOS
            </h1>
            <div class="p-2 shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] border border-gray-200  rounded-lg min-[420px]:w-full min-[420px]:mx-0 min-[420px]:p-4">
                {{-- Grafico de barras 2 --}}
                {{-- <p class=" mt-5 mb-0 font-sans font-bold leading-normal dark:text-white dark:opacity-60 text-2xl text-center">Ordenes de trabajo(Ots) vs Tickets cerrados por estado</p> --}}
                <canvas id="myChart5" style="padding: 4% 10%"></canvas>
            </div>
        </div>
        {{-- <div>
            <canvas id="chartDoughnut" width="300" height="300" style="border:1px solid #d3d3d3;"></canvas>
        </div> --}}
        
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piechart-outlabels"></script>
<script type="text/javascript">


        // **************GRAFICO DONA 2*****************
        //**********************************************
        var estados = @json($estados);
        var valores = @json($valores);
        var colores = @json($colores);
        const suma = @json($totalEstadisticas);
        const dataDona2 = {
            labels: estados,
            datasets: [{
                label: 'Inversion($)',
                data: valores,
                backgroundColor: colores,
                hoverOffset: 4,
                cutout: '90%',
                borderRadius: 20
            }]
        };
        const doughnutLabelsLine = {
            id: 'doughnutLabelsLine',
            afterDraw(chart, args, options) {
                const { ctx, chartArea: { top, bottom, left, right, width, height } } = chart;

                // console.log(chart.data.datasets)
                chart.data.datasets.forEach((dataset, i) => {
                    // console.log(chart.getDatasetMeta(i))
                    chart.getDatasetMeta(i).data.forEach((datapoint, index) => {
                        // console.log(dataset)
                        const { x, y } = datapoint.tooltipPosition();

                        ctx.fillStyle = 'black';
                        // ctx.fill();
                        ctx.fillRect(x, y, 2, 2);

                        const halfwidth = width / 2;
                        const halfheight = height / 2;

                        const xLine = x >= halfwidth ? x + 15 : x - 15;
                        const yLine = y >= halfheight ? y + 15 : y - 15;
                        const extraLine = x >= halfwidth ? 120 : -120;

                        ctx.beginPath();
                        ctx.moveTo(x, y);
                        ctx.lineTo(xLine, yLine);
                        ctx.lineTo(width / 2 + 30 + extraLine, yLine);
                        ctx.strokeStyle = 'black';
                        ctx.stroke();

                        //text
                        const textWidth = ctx.measureText(chart.data.labels[index]).width;
                        // console.log(textWidth);
                        ctx.font = '10px Arial';

                        const textPosition = x >= halfwidth ? 'left' : 'right';
                        ctx.textAlign = textPosition;
                        ctx.textBaseline = 'middle';
                        // ctx.fillStyle = dataset.backgroundColor[index];
                        
                        const extraLine_text = x >= halfwidth ? 123 : -123;
                        const porcen = chart.data.datasets[0].data[index] * 100 / suma;
                        if(porcen < 3){
                            ctx.textBaseline = 'bottom';
                        }
                        if(porcen >= 4){
                            ctx.textBaseline = 'top';
                        }
                        ctx.fillText((porcen).toFixed(2) + "%", width / 2 + 30 + extraLine_text , yLine);
                        // (chart.data.datasets[0].data[index] * 100) / sum)
                    })
                })
            }
        }
        const config = {
            type: 'doughnut', 
            data: dataDona2,
            options: {
                layout: {
                    padding: 23
                },
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
            plugins: [doughnutLabelsLine]
        };
        new Chart(
            document.getElementById('myChart2'), 
            config
        );
        //**********************************************
        //***********FIN DE DONA 2**********************



        //************GRAFICO DONA 3********************
        //**********************************************
        var estTi = @json($estTi);
        var tikects = @json($tikects);
        var colorTi = @json($colorTi);
        const suma2 = @json($totalTickets);
        const dataDoughnut = {
            datasets: [
                {
                    label: "Total ticket",
                    data: tikects, 
                    backgroundColor: colorTi, 
                    hoverOffset: 4,
                    cutout: '90%',
                    borderRadius: 20 
                },
            ], 
        };
        const doughnutLabelsLine2 = {
            id: 'doughnutLabelsLine2',
            afterDraw(chart, args, options) {
                const { ctx, chartArea: { top, bottom, left, right, width, height } } = chart;

                // console.log(chart.data.datasets)
                chart.data.datasets.forEach((dataset, i) => {
                    // console.log(chart.getDatasetMeta(i))
                    chart.getDatasetMeta(i).data.forEach((datapoint, index) => {
                        // console.log(dataset)
                        const { x, y } = datapoint.tooltipPosition();

                        ctx.fillStyle = 'black';
                        // ctx.fill();
                        ctx.fillRect(x, y, 2, 2);

                        // console.log('ancho:', width, 'alto:', height, 'mitadAncho:', width/2, 'mitadlargo:', height/2, 'puntoMedio:', width / 2 + 30)

                        const halfwidth = width / 2;
                        const halfheight = height / 2;

                        const xLine = x >= halfwidth ? x + 15 : x - 15;
                        const yLine = y >= halfheight ? y + 15 : y - 15;
                        const extraLine = x >= halfwidth ? 120 : -120;

                        ctx.beginPath();
                        ctx.moveTo(x, y);
                        ctx.lineTo(xLine, yLine);
                        ctx.lineTo(width / 2 + 30 + extraLine, yLine);
                        ctx.strokeStyle = 'black';
                        ctx.stroke();

                        //lineas media
                        // ctx.beginPath();
                        // ctx.moveTo(width / 2 + 30, 20);
                        // ctx.lineTo(width / 2 + 30, 242 + 30);
                        // ctx.stroke();

                        //lineas izquierda
                        // ctx.beginPath();
                        // ctx.moveTo(50, 20);
                        // ctx.lineTo(50, 242 + 30);
                        // ctx.stroke();

                        //lineas derecha
                        // ctx.beginPath();
                        // ctx.moveTo(width, 20);
                        // ctx.lineTo(width, 242 + 30);
                        // ctx.stroke();

                        //text
                        const textWidth = ctx.measureText(chart.data.labels[index]).width;
                        // console.log(textWidth);
                        ctx.font = '11px Arial';

                        const textPosition = x >= halfwidth ? 'left' : 'right';
                        ctx.textAlign = textPosition;
                        ctx.textBaseline = 'middle';
                        // ctx.fillStyle = dataset.backgroundColor[index];
                        
                        const extraLine_text = x >= halfwidth ? 123 : -123;
                        ctx.fillText((chart.data.datasets[0].data[index] * 100 / suma2).toFixed(0) + "%", width / 2 + 30 + extraLine_text , yLine);
                        // console.log('coordenada:', xLine , yLine)
                    })
                })
            }
        }
        const configDoughnut = {
            type: "doughnut", 
            data: dataDoughnut, 
            options: {
                layout: {
                    padding: 25
                },
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
            plugins: [doughnutLabelsLine2]
        };
        var chartBar = new Chart(
            document.getElementById("chartDoughnut")
            , configDoughnut
        );
        //**********************************************
        //***********FIN GRAFICO DONA 3*****************



        // **********GRAFICO BARRAS + LIENA*********************
        //******************************************************
        var estadosUnion = @json($estados_ticket);
        var tikectsUnion = @json($total_ticket);
        var tikects_ot_Union = @json($total_ticket_ot);
        var color_union = @json($colorTi);
        const labelsEstados = estadosUnion;
        const dataUnion = {
            labels: estadosUnion,
            datasets: [{
                type: 'bar',
                label: 'Tickets registrados',
                data: tikectsUnion,
                borderColor: 'rgb(41,94,164)',
                backgroundColor: 'rgb(41,94,164)',
                borderRadius: 10,
                barPercentage: 0.5


            }, {
                type: 'bar',
                label: 'Ots registradas',
                data: tikects_ot_Union,
                fill: false,
                borderColor: 'rgb(255,154,52)',
                backgroundColor: 'rgb(255,154,52)',
                borderRadius: 10,
                barPercentage: 0.5

            }]
        };
        const configBarUnion = {
            type: 'scatter'
            , data: dataUnion
            , options: {
                plugins: {
                    title: {
                        display: false,
                        text: 'Custom Chart Title'
                    }
                }
                , scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        new Chart(
            document.getElementById('myChart5')
            , configBarUnion
        );
        //*******************************************************
        //************FIN GRAFICO BARRAS + LINEA*****************

        // **************GRAFICO DONA 1*****************
        //**********************************************
        var estOts = @json($estOts);
        var ots = @json($ots);
        var colorOts = @json($colorOts);
        const suma3 = @json($totalOts);
        const dataDona3 = {
            labels: estOts,
            datasets: [{
                label: 'Inversion($)',
                data: ots,
                backgroundColor: colorOts,
                hoverOffset: 4,
                cutout: '90%',
                borderRadius: 20
            }]
        };
        const doughnutLabelsLine3 = {
            id: 'doughnutLabelsLine3',
            afterDraw(chart, args, options) {
                const { ctx, chartArea: { top, bottom, left, right, width, height } } = chart;

                // console.log(chart.data.datasets)
                chart.data.datasets.forEach((dataset, i) => {
                    // console.log(chart.getDatasetMeta(i))
                    chart.getDatasetMeta(i).data.forEach((datapoint, index) => {
                        // console.log(dataset)
                        const { x, y } = datapoint.tooltipPosition();

                        ctx.fillStyle = 'black';
                        // ctx.fill();
                        ctx.fillRect(x, y, 2, 2);

                        const halfwidth = width / 2;
                        const halfheight = height / 2;

                        const xLine = x >= halfwidth ? x + 15 : x - 15;
                        const yLine = y >= halfheight ? y + 15 : y - 15;
                        const extraLine = x >= halfwidth ? 120 : -120;

                        ctx.beginPath();
                        ctx.moveTo(x, y);
                        ctx.lineTo(xLine, yLine);
                        ctx.lineTo(width / 2 + 30 + extraLine, yLine);
                        ctx.strokeStyle = 'black';
                        ctx.stroke();

                        //lineas media
                        // ctx.beginPath();
                        // ctx.moveTo(width / 2 + 30, 20);
                        // ctx.lineTo(width / 2 + 30, 242 + 30);
                        // ctx.stroke();

                        //lineas izquierda
                        // ctx.beginPath();
                        // ctx.moveTo(50, 20);
                        // ctx.lineTo(50, 242 + 30);
                        // ctx.stroke();

                        //lineas derecha
                        // ctx.beginPath();
                        // ctx.moveTo(width, 20);
                        // ctx.lineTo(width, 242 + 30);
                        // ctx.stroke();

                        //text
                        const textWidth = ctx.measureText(chart.data.labels[index]).width;
                        // console.log(textWidth);
                        ctx.font = '11px Arial';

                        const textPosition = x >= halfwidth ? 'left' : 'right';
                        ctx.textAlign = textPosition;
                        ctx.textBaseline = 'middle';
                        // ctx.fillStyle = dataset.backgroundColor[index];
                        
                        const extraLine_text = x >= halfwidth ? 123 : -123;
                        ctx.fillText((chart.data.datasets[0].data[index]).toFixed(0), width / 2 + 30 + extraLine_text , yLine);
                        // (chart.data.datasets[0].data[index] * 100) / sum)
                    })
                })
            }
        }
        const config3 = {
            type: 'doughnut', 
            data: dataDona3,
            options: {
                layout: {
                    padding: 23
                },
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
            plugins: [doughnutLabelsLine3]
        };
        new Chart(
            document.getElementById('myChart3'), 
            config3
        );
        //**********************************************
        //***********FIN DE DONA 1**********************

</script>
</x-app-layout>

