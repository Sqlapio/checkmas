@php

use App\Models\IaimOrdenTrabajo;
use App\Models\Ot;
use App\Models\Tikect;
use App\Models\Estado;
use App\Models\Iaim_Articulo;
use Carbon\Carbon;

$fecha = Carbon::now();

$ots_creadas = IaimOrdenTrabajo::select(DB::raw("count(status) as creadas"))
            ->where('status', 1)
            ->count();




$ots_aprobadas = IaimOrdenTrabajo::select(DB::raw("count(status) as creadas"))
            ->where('status', 2)
            ->count();

$ots_certificadas = IaimOrdenTrabajo::select(DB::raw("count(status) as creadas"))
            ->where('status', 3)
            ->count();

$product_inv = Iaim_Articulo::select(['descripcion', 'codigo'])->orderBy('codigo', 'asc')->get()->toArray();


$total = $ots_creadas + $ots_aprobadas + $ots_certificadas;

$porcent_Otc    = round(($ots_creadas * 100) / $total, 2);
$porcent_Ota    = round(($ots_aprobadas * 100) / $total, 2);
$porcent_Otcert = round(($ots_certificadas * 100) / $total, 2);

$data = DB::table("iaim_movimiento_inventarios")
            ->select(DB::raw("SUM(entrada) as total_mov_ent"),
                    DB::raw("SUM(salida) as total_mov_sal"), 
                    DB::raw("now() as fecha_cierre"), 
                    DB::raw("codigo as codigo"), 'descripcion',
                    DB::raw("now() as updated_at"),
                    DB::raw("SUM(entrada) - SUM(salida) as Total_existencia"))
            ->groupBy(['codigo', 'descripcion'])
            ->orderBy('codigo', 'asc')
            ->get();
$productos = $data->pluck('codigo');
$entradas = $data->pluck('total_mov_ent');
$salidas = $data->pluck('total_mov_sal');
$descripcion = $data->pluck('descripcion');

$prueba = json_encode($productos);
$text = str_replace('"', "'", $prueba);

$prueba2 = json_encode($entradas);
$text2 = str_replace('"', "'", $prueba2);

Debugbar::info($prueba, $prueba2, $text);

$qc = new QuickChart();
  $qc->setConfig("{
    type: 'pie',
    data: {
        labels: $text,
        datasets: [{ data: $text2 }],
    },
  }");
$jj = $qc->getUrl();
// echo $qc->getUrl();


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
<div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-5 gap-8">
        {{-- Total Ots --}}
        <div class="p-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">Ordenes de<br> trabajo<br>al {{ Carbon::parse($fecha)->format('d-m-Y') }}</h5>
                            <span class="font-semibold text-lg text-blueGray-700">{{ $total }}</span>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/dolar.png') }}" class="w-36" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Total Inventario $ --}}
        <div class="p-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">Inventario<br>al<br>{{ Carbon::parse($fecha)->format('d-m-Y') }} </h5>
                            <x-total_existencia />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/mantenimiento.png') }}" class="w-36" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- inventario salida --}}
        <div class="p-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <x-alerta_salida_inventario />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/check_icon.png') }}" class="w-36" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Ots aprobadas --}}
        <div class="p-2 xl:hidden 2xl:block">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">Ots<br>aprobadas <br>al {{ Carbon::parse($fecha)->format('d-m-Y') }}</h5>
                            <x-total_ots_aprobadas_iaim />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/ejecucion.png') }}" class="w-36" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         {{-- Ots finalizadas --}}
        <div class="p-2 xl:hidden 2xl:block">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-blueGray-400 uppercase text-xs mb-4">Ots<br>finalizadas <br>al {{ Carbon::parse($fecha)->format('d-m-Y') }}</h5>
                            <x-total_ots_finalizadas_iaim />
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full ">
                                <img src="{{ asset('images/ejecucion.png') }}" class="w-36" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
{{-- <div id="prueba">
    <img src="{{ $jj }}" alt="">
  </div> --}}

{{-- Seccion de graficos --}}
<section class="bg-white dark:bg-gray-900">
        <div class=" px-1 py-5 mx-auto">
            {{-- grid - graficos 1 y 2 --}}
            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 sm:grid-cols-1  md:grid-cols-2  lg:grid-cols-2 xl:grid-cols-2">
                <!-- Graficos de Barras 1 -->
                <div class="w-full ">
                    <h1 class="w-full text-center text-xl px-8 py-4 font-bold rounded-lg dark:bg-gray-700">
                       TOTAL ORDENES DE TRABAJO:  <span class="font-semibold text-xl text-blueGray-700">{{ $total }}</span>
                    </h1>
                    <div class="w-full shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] border border-gray-200 rounded-lg dark:bg-gray-600 pt-4 pb-6">
                        <canvas id="myChart5" style="padding: 4% 10%"></canvas>
                    </div>
                </div>
                <!-- Graficos de Barras 2 -->
                <div class="w-full">
                    <h1 class="w-full text-center text-xl font-bold px-8 py-4 rounded-lg dark:bg-gray-700">
                        ORDEN DE TRABAJO(%)
                    </h1>
                    <div class="shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] border border-gray-200 rounded-lg dark:bg-gray-600 pt-4 pb-6">
                        <canvas id="myChart6" style="padding: 4% 10%"></canvas>
                    </div>
                </div>
            </div>
            {{-- grid - grafico 3 --}}
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4 mt-8">
                <h1 class="w-full text-center font-bold text-xl px-8 py-8 rounded-lg dark:bg-gray-700">
                    MOVIMIENTOS DE INVENTARIO
                </h1>
                <div class="p-2 shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] border border-gray-200  rounded-lg min-[420px]:w-full min-[420px]:mx-0 min-[420px]:p-4">
                    {{-- Grafico de barras 2 --}}
                    <canvas id="myChart7" style="padding: 4% 10%"></canvas>
                </div>
            </div>
        </div>

</section>
        
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piechart-outlabels"></script>

<script type="text/javascript">

// **********GRAFICO BARRAS 1 *********************
//******************************************************
        var ots_creadas         = @json($ots_creadas);
        var ots_aprobadas       = @json($ots_aprobadas);
        var ots_certificadas    = @json($ots_certificadas);
        var total               = @json($total);
        const dataUnion = {
            labels: ['Mes en curso']
            , datasets: [{
                type: 'bar',
                label: 'Creadas',
                data: [ots_creadas],
                backgroundColor: 'rgb(178, 214, 237)',
                borderRadius: 10,
                // borderSkipped: 30,
                barPercentage: 0.5
            }, {
                type: 'bar',
                label: 'Aprobadas',
                data: [ots_aprobadas],
                fill: false,
                backgroundColor: 'rgb(242, 146, 141)',
                borderRadius: 10,
                // borderSkipped: 30,
                barPercentage: 0.5
            }, {
                type: 'bar',
                label: 'Finalizada',
                data: [ots_certificadas],
                fill: false,
                backgroundColor: 'rgb(217, 186, 244)',
                borderRadius: 10,
                // borderSkipped: 30,
                barPercentage: 0.5
            }, {
                type: 'bar',
                label: 'Total',
                data: [total],
                fill: false,
                backgroundColor: 'rgb(47, 162, 235)',
                borderRadius: 10,
                // borderSkipped: 30,
                barPercentage: 0.5
            }]
        };
        const configBarUnion = {
            type: 'scatter',
            data: dataUnion,
            options: {
                plugins: {
                    title: {
                        display: false,
                        text: 'Custom Chart Title'
                    },
                    legend: {
                        display: true,
                        position: 'left',
                        // labels: { color: 'darkred', }
                    },
                    datalabels: {
                        color: 'rgb(0,0,0)',
                        font: {
                            size: 15
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        };
        new Chart(
            document.getElementById('myChart5')
            , configBarUnion
        );

// **********GRAFICO BARRAS 2*********************
//******************************************************
        var porcent_Otc = @json($porcent_Otc);
        var porcent_Ota = @json($porcent_Ota);
        var porcent_Otcert = @json($porcent_Otcert);
        const dataUnion2 = {
            labels: ['Mes en curso']
            , datasets: [{
                type: 'bar',
                label: 'Creadas(%)',
                data: [porcent_Otc],
                backgroundColor: 'rgb(178, 214, 237)',
                borderRadius: 10,
                // borderSkipped: 30,
                barPercentage: 0.5
            }, {
                type: 'bar',
                label: 'Aprobadas(%)',
                data: [porcent_Ota],
                fill: false,
                backgroundColor: 'rgb(242, 146, 141)',
                borderRadius: 10,
                // borderSkipped: 30,
                barPercentage: 0.5
            }, {
                type: 'bar',
                label: 'Finalizada(%)',
                data: [porcent_Otcert],
                fill: false,
                backgroundColor: 'rgb(217, 186, 244)',
                borderRadius: 10,
                // borderSkipped: 30,
                barPercentage: 0.5
            }]
        };
        const configBarUnion2 = {
            type: 'scatter',
            data: dataUnion2,
            options: {
                plugins: {
                    title: {
                        display: false,
                        text: 'Custom Chart Title'
                    },
                    legend: {
                        display: true,
                        position: 'left',
                        // labels: { color: 'darkred', }
                    },
                    datalabels: {
                        color: 'rgb(0,0,0)',
                        font: {
                            size: 15
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        };
        new Chart(
            document.getElementById('myChart6'), configBarUnion2
        );

        


// **********GRAFICO BARRAS 3*********************
//******************************************************
        var productos         = @json($productos);
        var entradas       = @json($entradas);
        var salidas    = @json($salidas);
        var descripcion    = @json($product_inv);
        // console.log(descripcion[0].descripcion, productos);
        const data3 = {
            labels: productos,
            datasets: [{
                type: 'bar',
                label: 'Entradas',
                data: entradas,
                backgroundColor: 'rgb(160, 213, 210)',
                borderRadius: 10,
                // borderSkipped: 30,
                categoryPercentage: 0.5,
                barPercentage: 1.0
            },{
                type: 'bar',
                label: 'Salidas',
                data: salidas,
                backgroundColor: 'rgb(242, 146, 141)',
                borderRadius: 10,
                // borderSkipped: 30,
                categoryPercentage: 0.5,
                barPercentage: 1.0
            }]
        };
        const statusTracker = {
            id: 'statusTracker',
            beforeDatasetsDraw(chart, args, pluginOptions) {
                const {ctx, chartArea: {top, bottom, left, right, width, height}, scales: {x,y}} = chart;

                ctx.save();
                drawLines();
                function drawLines() {
                    ctx.beginPath();
                    ctx.lineWidth = 3;
                    ctx.strokeStyle = 'rgb(255,0,0)';
                    ctx.moveTo(left, y.getPixelForValue(400));
                    ctx.lineTo(right, y.getPixelForValue(400));
                    ctx.stroke();
                    ctx.closePath();
                    ctx.restore();
                }
        
            }
        }
        const configBar3 = {
            type: 'bar',
            data: data3,
            options: {
                plugins: {
                    title: {
                        display: false,
                        text: 'Custom Chart Title'
                    },
                    legend: {
                        display: true,
                        position: 'left',
                        // labels: { color: 'darkred', }
                    },
                    datalabels: {
                        color: '#000000',
                        font: {
                            size: 12
                        }
                    },
                    tooltip: {
                        callbacks: {
                            beforeTitle: function(context){
                                return 'Producto:';
                            },
                            title: function(context){
                                    return context[0].label;
                            },
                            afterTitle: function(context){
                                var resultado = descripcion.find( des => des.codigo === context[0].label );
                                return resultado.descripcion;
                            },
                            beforeBody: function(context){
                                return '================';
                            }
                        }
                    },
                }
            },
            plugins: [ChartDataLabels, statusTracker]
        };
        new Chart(
            document.getElementById('myChart7'),
            configBar3
        );


</script>
</x-app-layout>

