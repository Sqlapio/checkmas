<!DOCTYPE html>
<html>
    <head>
        <title>Check+</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            <p>RESUMEN ORDENES DE TRABAJO (Ots)</p>
            <table>
                <tr>
                    <th class="table-primary">Fec. creado</th>
                    <th class="table-primary">Fec. Cerrado</th>
                    <th class="table-primary">Nro. de ticket</th>
                    <th class="table-primary">Agencia</th>
                    <th class="table-primary">Estado</th>
                    <th class="table-primary">Observaciones</th>
                </tr>
                @foreach($data as $item)
                <tr style="font-size: 0.5rem;">
                    <td width="40">{{ Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                    <td width="45">{{ $item->fecha_fin }}</td>
                    <td width="50">{{ $item->tikect_uid }}</td>
                    <td width="60">{{ $item->agencia }}</td>
                    <td width="50">{{ $item->estado }}</td>
                    <td>{{ $item->observaciones_cierre }}</td>
                </tr>
                @endforeach
            </table>
            <table>
                <tr>
                    <th class="table-primary" colspan="2">Total tickects abiertos: {{ $count_a }}</th>
                    <th class="table-primary" colspan="2">Total tickects cerrados: {{ $count_c }}</th>
                </tr>
            </table>
          </div>
    
          {{-- <div width="100%" align="center">Reporte generado {{ now() }} por: www.checkmas.com</div> --}}
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        
    </body>
</html>
