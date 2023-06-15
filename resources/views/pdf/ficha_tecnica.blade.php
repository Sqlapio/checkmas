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
        <p>Informacion de Equipo</p>
        <table>
            <tr>
                <th class="table-primary">Id</th>
                <th class="table-primary">codigo</th>
                <th class="table-primary">Qr condensadora</th>
                <th class="table-primary">Tipo condensadora</th>
                <th class="table-primary">Voltaje</th>
                <th class="table-primary">Fase</th>
                <th class="table-primary">Refrigerante</th>
                <th class="table-primary">Btu</th>
                <th class="table-primary">Compresor</th>
                <th class="table-primary">Marca</th>
                <th class="table-primary">Amperaje</th>
                <th class="table-primary">Ventilador</th>
                <th class="table-primary">Qr Evaporadora</th>
                <th class="table-primary">Oficina</th>
                <th class="table-primary">Piso</th>
                <th class="table-primary">Agencia</th>
                <th class="table-primary">Estado</th>
                <th class="table-primary">Costo</th>
            </tr>
            @foreach($data as $item)
            <tr style="font-size: 0.5rem;">
                <td>{{ $item->id }}</td>
                <td>{{ $item->uid }}</td>
                <td>{{ $item->qrConden }}</td>
                <td>{{ $item->tipoConden }}</td>
                <td>{{ $item->voltaje }}</td>
                <td>{{ $item->phases }}</td>
                <td>{{ $item->phasesripoRefri }}</td>
                <td>{{ $item->btu }}</td>
                <td>{{ $item->tipoCompresor }}</td>
                <td>{{ $item->marcaCompresor }}</td>
                <td>{{ $item->ampCompresor }}</td>
                <td>{{ $item->tipoVentilador }}</td>
                <td>{{ $item->qrEvaporador }}</td>
                <td>{{ $item->oficina }}</td>
                <td>{{ $item->piso }}</td>
                <td>{{ $item->agencia }}</td>
                <td>{{ $item->estado }}</td>
                <td>{{ $item->costo }}</td>

            </tr>
            @endforeach
        </table>
      </div>

      {{-- <div width="100%" align="center">Reporte generado {{ now() }} por: www.checkmas.com</div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    
</body>
</html>
