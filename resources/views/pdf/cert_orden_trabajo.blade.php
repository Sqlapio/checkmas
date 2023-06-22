<!DOCTYPE html>
<html>
<head>
    <title>Check+</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link href="https://fonts.cdnfonts.com/css/creato-display" rel="stylesheet"> --}}
</head>
<style>
    @import url('https://fonts.cdnfonts.com/css/creato-display');

    body {
        font-family: 'Creato Display', sans-serif;
    }

    table,
    td,
    th,
        {
        border: 1px solid black;
        font-size: 0.6rem;
        padding: 8px;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;

    }

    p {
        margin-bottom: 15px;
        font-weight: bold;
        font-size: 0.8rem;
        font-family: 'Creato Display', sans-serif;
    }

    .fecha {
        margin-top: 10px;
        text-align: right;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .logos {
        margin: auto;
    }

    .tabla_logos {
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
    @endphp
    <div class="container-fluid">

        {{-- Contenedor de logos --}}
        <div class="tabla_logos">
            <table style="border: 0px;">
                <tr style="border: 0px; background-color: #ebf3fc;">
                    <td style="border: 0px; padding: 5px">
                        <img class="imagen" src="../public/images/iaim/iaim-logo-01.png" alt="" width="40" height="auto">
                    </td>
                    <td style="border: 0px; text-align: right;">
                        <img class="imagen" src="../public/images/check_logo.png" alt="" width="150" height="auto">
                    </td>
                </tr>
            </table>
        </div>

        {{-- Titulo --}}
        <p class="fecha text-end">Fecha: {{ Carbon::parse($fecha)->format('d-m-Y h:m:s') }}</p>
        <p style="margin-left: 5px;">Certificacion Orden de trabajo</p>

        <table>
            @foreach($data as $item)
            <tr>
                <th class="table-primary">CODIGO ORDEN DE TRABAJO</th>
            </tr>
            <tr>
                <td>{{ $item->codigo_ot }}</td>
            </tr>
            @endforeach
        </table>

        <table>
            <tr>
                <th colspan="4" class="table-primary">DATOS DE LA PERSONA QUE CERTIFICA LA ORDEN DE TRABAJO</th>
            </tr>
            <tr>
                <th class="table-primary">NOMBRE COMPLETO</th>
                <th class="table-primary">CEDULA DE IDENTIDAD</th>
                <th class="table-primary">CARGO</th>
                <th class="table-primary">FIRMA</th>
            </tr>
            @foreach($data as $item)
            <tr style="font-size: 0.8rem;">
                <td>{{ $item->usr_cer_nombre }}</td>
                <td>{{ $item->usr_cer_cedula }}</td>
                <td>{{ $item->usr_cer_cargo }}</td>
                <td>{{ $item->usr_ver_correo }}</td>
            </tr>
            @endforeach
        </table>

        <table>
            <tr>
                <th colspan="5" class="table-primary">DATOS GENERALES DE LA ACTIVIDAD REALIZADA</th>
            </tr>
            <tr>
                <th class="table-primary">FECHA INICO</th>
                <th class="table-primary">FECHA FINAL</th>
                <th class="table-primary">DIAS</th>
                <th class="table-primary">Nro. TRABAJADORES</th>
                <th class="table-primary">OBSERVACIONES</th>
            </tr>
            @foreach($data as $item)
            <tr style="font-size: 0.8rem;">
                <td>
                    {{ $item->fecha_inico_ot }}
                </td>
                <td>{{ $item->fecha_fin_ot }}</td>
                <td>{{ $item->can_dias }}</td>
                <td>{{ $item->can_trabajadores }}</td>
                <td>{{ $item->observaciones }}</td>
            </tr>
            @endforeach
        </table>

        <table>
            <tr>
                <th colspan="3" class="table-primary">REGISTRO FOTOGRAFICO DE LA ACTIVIDAD REALIZADA</th>
            </tr>
            @foreach($data as $item)
            <tr>
                <th colspan="3" class="table-primary">ANTES</th>
            </tr>
            <tr style="font-size: 0.8rem;">
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
            </tr>
            <tr>
                <th colspan="3" class="table-primary">DURANTE</th>
            </tr>
            <tr style="font-size: 0.8rem;">
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
            </tr>
            <tr>
                <th colspan="3" class="table-primary">DESPUES</th>
            </tr>
            <tr style="font-size: 0.8rem;">
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$item->foto_antes_1))) }}" style="width: 100px; height: 100px;">
                </td>
            </tr>
            @endforeach
        </table>

        <footer class="footer">
            © SIAIM 2023. All rights reserved. by StarkMedios - Checkmas
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>
</html>

