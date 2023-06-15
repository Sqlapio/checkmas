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
    table, td, th, {
      border: 1px solid black;
      font-size: 0.6rem;
      padding: 8px;
      text-align: center;
    }
    
    table {
      border-collapse: collapse;
      width: 100%;

    }
    p{
        margin-bottom: 15px;
        font-weight: bold;
        font-size: 0.8rem;
        font-family: 'Creato Display', sans-serif;
    }

    .fecha{
        margin-top: 10px;
        text-align:right;
        font-weight: bold;
        font-size: 0.8rem;
    }
    .logos{
      margin: auto;
    }

    </style>
<body>
    @php
        use Carbon\Carbon;
        $fecha = Carbon::now();
    @endphp
    <div class="container-fluid">

              <img class="imagen" src="../public/images/iaim/banner.png" alt="" width="700" height="auto">

        {{-- Titulo --}}
        <p  class="fecha text-end">Fecha: {{ Carbon::parse($fecha)->format('d-m-Y h:m:s') }}</p>
        <p style="margin-left: 5px;">Orden de trabajo</p>
        
        <table>
          @foreach($data as $item)
          <tr>
            <th style="border: 0px;" colspan="2"></th>
            <th class="table-primary">CODIGO ORDEN DE TRABAJO</th>
        </tr>
        <tr>
          <td  style="border: none;" colspan="2">

          </td>
          <td>{{ $item->codigo_ot }}</td>
        </tr>
            <tr>
                <th class="table-primary">DIVISION</th>
                <th class="table-primary">COORDINACION</th>
                <th class="table-primary">FECHA</th>
            </tr>
            
            
            <tr style="font-size: 0.8rem;">
                <td>{{ $item->division }}</td>
                <td>{{ $item->coordinacion }}</td>
                <td>{{ $item->fecha_ot }}</td>
            </tr>
            @endforeach
        </table>

        <table>
          <tr>
            <th colspan="5" class="table-primary">DATOS DE LA PERSONA QUE REALIZA LA INSPECCION</th>
          </tr>
          <tr>
              <th class="table-primary">NOMBRE COMPLETO</th>
              <th class="table-primary">CEDULA DE IDENTIDAD</th>
              <th class="table-primary">CARGO</th>
              <th class="table-primary">FIRMA</th>
              <th class="table-primary">CERTIFICA INSPECCION</th>
          </tr>
          @foreach($data as $item)
          <tr style="font-size: 0.8rem;">
              <td>{{ $item->usr_res_nombre }}</td>
              <td>{{ $item->usr_res_cedula }}</td>
              <td>{{ $item->usr_res_cargo }}</td>
              <td>{{ $item->usr_res_correo }}</td>
              <td>{{ $item->aprobada_por }}</td>
          </tr>
          @endforeach
      </table>

      <table>
        <tr>
          <th colspan="3" class="table-primary">DETALLES DE LA INSPECCION</th>
        </tr>
        <tr>
            <th class="table-primary">UBICACION</th>
            <th class="table-primary">DESCRIPCION GENERAL</th>
            <th class="table-primary">REPORTADO POR:</th>
        </tr>
        @foreach($data as $item)
        <tr style="font-size: 0.8rem;">
            <td>
              {{ $item->aeropuerto }} - {{ $item->area }}
            </td>
            <td>{{ $item->descripcion_general }}</td>
            <td>{{ $item->reportado_por }}</td>
        </tr>
        @endforeach
    </table>

    <table>
      <tr>
        <th colspan="3" class="table-primary">VALORACION</th>
      </tr>
      <tr>
          <th class="table-primary">VALORACION DE LA URGENCIA</th>
          <th class="table-primary">VALORACION DE LA OBRA</th>
          <th class="table-primary">OTRAS DIVISIONES</th>
      </tr>
      @foreach($data as $item)
      <tr style="font-size: 0.8rem;">
          <td>
            {{ $item->valor_urgencia }}
          </td>
          <td>{{ $item->valor_obra }}</td>
          <td>{{ $item->otras_diviciones }}</td>
      </tr>
      @if($item->recomendaciones != null)
      <tr style="font-size: 0.8rem;">
        <td colspan="3">Recomendaciones: {{ $item->recomendaciones }}</td>
      </tr>
      @endif
      @endforeach
  </table>

  <table>
    <tr>
      <th colspan="4" class="table-primary">MATERIALES Y HERRAMIENTAS</th>
    </tr>
    <tr>
        <th class="table-primary">CODIGO PRODUCTO</th>
        <th class="table-primary">DESCRIPCION</th>
        <th class="table-primary">CATEGORIA</th>
        <th class="table-primary">CANTIDAD</th>
    </tr>
    @foreach($dataProductos as $item)
    <tr style="font-size: 0.8rem;">
        <td>
          {{ $item->codigo_producto }}
        </td>
        <td>{{ $item->descripcion }}</td>
        <td>{{ $item->categoria }}</td>
        <td>{{ $item->cantidad }}</td>
    </tr>
    @endforeach
</table>
      </div>

      {{-- <div width="100%" align="center">Reporte generado {{ now() }} por: www.checkmas.com</div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    
</body>
</html>
