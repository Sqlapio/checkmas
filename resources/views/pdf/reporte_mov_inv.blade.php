<!DOCTYPE html>
<html>
<head>
    <title>Check+</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="https://fonts.cdnfonts.com/css/creato-display" rel="stylesheet"> --}}
</head>
<style>

    @import url('https://fonts.cdnfonts.com/css/creato-display');
    body{
        font-family: 'Creato Display', sans-serif;
    }
    table, td, th {
      border: 1px solid black;
      font-size: 0.5rem;
    }
    
    table {
      border-collapse: collapse;
      width: 100%;

    }
    p{
        margin-bottom: 15px;
        font-weight: bold;
        font-size: 1rem;
        font-family: 'Creato Display', sans-serif;
    }

    .text_rango{
        margin-bottom: 3px;
        font-size: 0.7rem;
        font-family: 'Creato Display', sans-serif;
    }

    .fecha{
        text-align:right;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .fecha_rango{
        text-align:left;
        font-size: 0.8rem;
        font-family: 'Creato Display', sans-serif;
    }


    .linea {
        border-top: 1px solid black;
        height: 2px;
        max-width: 100%;
        padding: 0;
        margin: 20px auto 0 auto;
    }

    #main {
        width: 100%;
        height: 100px;
        border: 1px solid #c3c3c3;
        display: flex;
        justify-content: space-between;
    }

    .chart{
        margin-top: 20px;
    }

    .circulo {
        display: block;
        padding: 5px
        border: 1px solid blue;    
        background-color: yellow;
        height: 6px;
        width: 6px;
        border-radius: 50%; 
    }

    .leyenda{
        display: inline-block;
    }

    .t{
        border: none;
    }

    .tabla_logos{
        margin-bottom: 20px;
    }

    .footer {
        position: fixed;
        bottom: 12px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align: center;
        line-height: 35px;
        padding: 10px;
        font-size: 12px;
    }

    </style>
<body>
    @php
        use Carbon\Carbon;
        $fecha = Carbon::now();

        $chart = new QuickChart(array(
            'width' => 180,
            'height' => 180

        ));

        $chart_bar = new QuickChart(array(
            'width' => 280,
            'height' => 180

        ));

        $chart_bar_sal = new QuickChart(array(
            'width' => 280,
            'height' => 180

        ));

        $array = json_encode($totales);
        $data = str_replace('"', "'", $array);


        $chart->setConfig("
            {
                type: 'doughnut',
                data: {
                    datasets: [
                    {
                        data: $data,
                        backgroundColor: ['rgb(0 24 90)', 'rgb(101 169 225)', 'rgb(237 89 42)'],
                        borderWidth: 0,
                    },
                    ],
                },
                options: {
                    cutoutPercentage: 80,
                    legend: {
                        display: false,
                    },
                    plugins: {
                        datalabels: {
                            display: false,
                        },
                    },
                },
            }
        ");
        $chart_bar->setConfig("

            {
                type: 'horizontalBar',
                data: {
                    labels: $fecha_entradas,
                    datasets: [
                        { 
                            data: $entradas,
                            backgroundColor: 'rgb(0 24 90)',
                            borderRadius: 10,
                            categoryPercentage: 0.5,
                            barPercentage: 0.5
                        },
                    ],
                },
                options: {
                    legend: {
                        display: false,
                    },
                    plugins: {
                        datalabels: {
                            display: true,
                            align: 'end',
                            anchor: 'end',
                            padding: 4,
                            color: 'rgb(0 24 90)'
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 50,
                            top: 10,
                            bottom: 10  
                        }
                    }
                }
            }

        ");
        $chart_bar_sal->setConfig("

            {
                type: 'horizontalBar',
                data: {
                    labels: $fecha_salidas,
                    datasets: [
                        { 
                            data: $salidas,
                            backgroundColor: 'rgb(237 89 42)',
                            borderRadius: 10,
                            categoryPercentage: 0.5,
                            barPercentage: 0.5
                        },
                    ],
                },
                options: {
                    legend: {
                        display: false,
                    },
                    plugins: {
                        datalabels: {
                            display: true,
                            align: 'end',
                            anchor: 'end',
                            padding: 4,
                            color: 'rgb(237 89 42)'
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 50,
                            top: 10,
                            bottom: 10  
                        }
                    }
                    
                }
            }

        ");

        $grafico = $chart->getUrl();
        $grafico_bar = $chart_bar->getUrl();
        $grafico_bar_sal = $chart_bar_sal->getUrl();

    @endphp
    <div class="container-fluid">

        {{-- Contenedor de logos --}}
        <div class="tabla_logos">
            <table style="border: 0px;">
                <tr style="border: 0px; background-color: #ebf3fc;">
                    <td style="border: 0px; padding: 5px">
                        <img class="imagen" src="../public/images/iaim/iaim-logo.png" alt="" width="40" height="auto">
                    </td>
                    <td style="border: 0px; text-align: right;">
                        <img class="imagen" src="../public/images/check_logo.png" alt="" width="150" height="auto">
                    </td>
                </tr>
            </table>
        </div>

        <br>
        <br>

        {{-- Parte 1 --}}
        <div class="">
            <p  class="fecha_rango" style="margin-bottom: 3px;">Reporte movimiento de inventario para: {{ Carbon::parse($fecha_ini_inv)->format('d-m-Y') }} al {{ Carbon::parse($fecha_fin_inv)->format('d-m-Y') }}</p>
            <p  class="fecha_rango">Producto: {{ $descripcion }}</p>
        </div>

        {{-- linia 1 --}}
        <div class="linea"></div>
        <table style="border: 0px;">
            <tr style="border: 0px;">
                {{-- chart --}}
                <td width="20" style="border: 0px;">
                    <div class="chart">
                        <img src="{{'data:image/png;base64,' . base64_encode(file_get_contents(@$grafico))}}" alt="image" >
                    </div>
                </td>
                {{-- leyenda --}}
                <td width="70" style="border: 0px;">
                    <div>
                        <table style="border: 0px;">
                            <tr style="border: 0px;">
                                <td style="border: 0px;">
                                    <div style="height: 10px;
                                                width: 10px;
                                                background-color: rgb(0 24 90);
                                                border-radius: 50%;">
                                    </div>
                                </td>
                                <td style="border: 0px; font-size: 0.7rem;">Total entradas</td>
                            </tr>
                            <tr style="border: 0px;">
                                <td style="border: 0px;">
                                    <div style="height: 10px;
                                                width: 10px;
                                                background-color: rgb(101 169 225);
                                                border-radius: 50%;">
                                    </div>
                                </td>
                                <td style="border: 0px; font-size: 0.7rem;">Total salidas</td>
                            </tr>
                            <tr style="border: 0px;">
                                <td style="border: 0px;">
                                    <div style="height: 10px;
                                                width: 10px;
                                                background-color: rgb(237 89 42);
                                                border-radius: 50%;">
                                    </div>
                                </td>
                                <td style="border: 0px; font-size: 0.7rem;">Total existencia</td>
                            </tr>
                        </table>
                    </div>
                </td>
                {{-- calculos --}}
                <td width="70" style="border: 0px;">
                    <div>
                        <table style="border: 0px;">
                            <tr style="border: 0px;">

                                <td style="border: 0px; font-size: 0.7rem; font-weight: bold;">{{ $total_mov_ent }}</td>
                                <td style="border: 0px; font-size: 0.7rem; font-weight: bold;">100%</td>

                            </tr>
                            <tr style="border: 0px;">

                                <td style="border: 0px; font-size: 0.7rem; font-weight: bold;">{{ $total_mov_sal }}</td>
                                <td style="border: 0px; font-size: 0.7rem; font-weight: bold;">{{ round(($total_mov_sal * 100) / $total_mov_ent, 2) }}%</td>

                            </tr>
                            <tr style="border: 0px;">

                                <td style="border: 0px; font-size: 0.7rem; font-weight: bold;">{{ $Total_existencia }}</td>
                                <td style="border: 0px; font-size: 0.7rem; font-weight: bold;">{{ round(($Total_existencia * 100) / $total_mov_ent, 2) }}%</td>

                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <br>
        <br>
        <br>

        {{-- Parte 2 --}}
        <div class="">
            <p  class="fecha_rango" style="margin-bottom: 3px;">Detalle de movimientos</p>
        </div>
        <table style="border: 0px;">
            <tr style="border: 0px;">
                <td style="border: 0px;">
                    <p  class="fecha_rango" style="">Entradas</p>
                    <div class="linea"></div>
                </td>
                <td style="border: 0px;">
                    <p  class="fecha_rango" style="">Salidas</p>
                    <div class="linea"></div>
                </td>
            </tr>
            <tr style="border: 0px;">
                <td style="border: 0px;">
                    <div class="chart">
                        <img src="{{'data:image/png;base64,' . base64_encode(file_get_contents(@$grafico_bar))}}" alt="image" >
                    </div>
                </td>
                <td style="border: 0px;">
                    <div class="chart">
                        <img src="{{'data:image/png;base64,' . base64_encode(file_get_contents(@$grafico_bar_sal))}}" alt="image" >
                    </div>
                </td>
            </tr>
        </table>

        <footer class="footer">
            © SIAIM 2023. All rights reserved. by StarkMedios - Checkmas
        </footer>
  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
