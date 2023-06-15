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

    </style>
<body>
    @php
        use Carbon\Carbon;
        $fecha = Carbon::now();
        $chart = new QuickChart(array(
            'width' => 180,
            'height' => 180

        ));

        $array = json_encode($totales);
        $data = str_replace('"', "'", $array);

        // dd($text2);
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

        $grafico = $chart->getUrl();

    @endphp
    <div class="container-fluid">

        {{-- Contenedor de logos --}}
        <div class="tabla_logos">
            <table style="border: 0px;">
                <tr style="border: 0px; background-color: #71cafa;">
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

        {{-- Fecha del reporte --}}
        {{-- <div class="d-flex justify-content-end">
            <p  class="fecha text-end">Fecha: {{ Carbon::parse($fecha)->format('d-m-Y') }}</p>
        </div> --}}

        <div class="">
            <p  class="fecha_rango" style="margin-bottom: 3px;">Reporte movimiento de inventario para: {{ Carbon::parse($fecha_ini_inv)->format('d-m-Y') }} al {{ Carbon::parse($fecha_fin_inv)->format('d-m-Y') }}</p>
            <p  class="fecha_rango">Producto: {{ $descripcion }}</p>
        </div>

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
        
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
