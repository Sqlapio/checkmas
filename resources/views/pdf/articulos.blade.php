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

    .linea {
        border-top: 1px solid black;
        height: 2px;
        max-width: 100%;
        padding: 0;
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

        <br>
        <br>

        <div class="d-flex justify-content-end">
            <p  class="fecha text-end">Fecha: {{ Carbon::parse($fecha)->format('d-m-Y') }}</p>
        </div>

        <br>
        <br>

        {{-- Titulo --}}
        <p style="margin-bottom: 5px;">RESUMEN DE INVENTARIO</p>
        {{-- linia 1 --}}
        <div class="linea"></div>
        <table style="margin-top: 20px;">
            <tr>
                <th class="table-primary">ID</th>
                <th class="table-primary">Descripción</th>
                <th class="table-primary">Código</th>
                <th class="table-primary">Proveedor</th>
                <th class="table-primary">Precio Unitario</th>
                <th class="table-primary">Stock Mínimo</th>
                <th class="table-primary">Responsable</th>
            </tr>
            @foreach($data as $item)
            <tr style="font-size: 0.5rem;">
                <td width="20">{{ $item->id }}</td>
                <td width="45">{{ $item->descripcion }}</td>
                <td width="45">{{ $item->codigo }}</td>
                <td width="40">{{ $item->proveedor }}</td>
                <td width="30">{{ $item->precio_unitario }}</td>
                <td width="30">{{ $item->cantidad_minima }}</td>
                <td width="50">{{ $item->usuario_responsable }}</td>
            </tr>
            @endforeach
        </table>
        <table>
            <tr>
                <th class="table-primary" colspan="2">Total Artículos: {{ $count }}</th>
            </tr>
        </table>
        <footer class="footer">
            © SIAIM 2023. All rights reserved. by StarkMedios - Checkmas
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
