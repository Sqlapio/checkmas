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

    .fecha{
        text-align:right;
        font-weight: bold;
        font-size: 0.9rem;
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
        <div class="d-flex justify-content-between">
            <img class="imagen" src="../public/images/check_logo.png" alt="" width="150" height="auto">
        </div>
        <div class="d-flex justify-content-end">
            <p  class="fecha text-end">Fecha: {{ Carbon::parse($fecha)->format('d-m-Y') }}</p>
        </div>

        {{-- Titulo --}}
        <p>RESUMEN ORDENES DE TRABAJO (Ots)</p>
        <table>
            <tr>
                <th class="table-primary">Fec. creada</th>
                <th class="table-primary">Fec. finalizada</th>
                <th class="table-primary">Nro. de orden</th>
                <th class="table-primary">Btu</th>
                <th class="table-primary">Agencia</th>
                <th class="table-primary">Estado</th>
                <th class="table-primary">Observaciones</th>
            </tr>
            @foreach($data as $item)
            <tr style="font-size: 0.5rem;">
                <td width="40">{{ $item->fechaInicio }}</td>
                <td width="45">{{ $item->fecha_fin }}</td>
                <td width="85">{{ $item->otUid }}</td>
                <td width="40">{{ $item->btu }}</td>
                <td width="50">{{ $item->agencia }} - {{ $item->codigo_agencia }} </td>
                <td width="50">{{ $item->estado }}</td>
                <td>{{ $item->observaciones }}</td>
            </tr>
            @endforeach
        </table>
        <table>
            <tr>
                <th class="table-primary" colspan="2">Total Ots creadas: {{ $count_r }}</th>
                <th class="table-primary" colspan="2">Total Ots aprobadas: {{ $count_a }}</th>
                <th class="table-primary" colspan="2">Total Ots en ejecución: {{ $count_e }}</th>
                <th class="table-primary" colspan="2">Total Ots finalizadas: {{ $count_f }}</th>
            </tr>
        </table>
        <footer class="footer">
            © SIAIM 2023. All rights reserved. by StarkMedios - Checkmas
        </footer>
      </div>

      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    
</body>
</html>
