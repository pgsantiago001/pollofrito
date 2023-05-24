<br>
<script type="text/javascript">
$(document).ready(function () {

    $('#tablaFactura').DataTable( {
        lengthChange: false,
        language: {
                        processing:     "Procesando...",
                        search:         "Buscar&nbsp;:",
                        lengthMenu:     "",
                        info:           "Del registro START al END de TOTAL Registros",
                        infoEmpty:      "Sin registros",
                        infoFiltered:   "",
                        infoPostFix:    "",
                        loadingRecords: "Cargando...",
                        zeroRecords:    "No se encontró ningún resultado",
                        emptyTable:     "Por el momento no se encuentran registros.",
                        paginate: {
                            first:      "Primero",
                            previous:   "Anterior",
                            next:       "Siguiente",
                            last:       "Último"
                        }
                    } 
    } );
 
});  
</script>


 <table class="table" id="tablaFactura">
    <thead>
      <tr>
        <th>No</th>
        <th>CLIENTE</th>
        <th>PAGO</th>
        <th>FECHA</th>
        <th>EMPLEADO</th>
        <th>TOTAL</th>
        <th>ESTADO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

       <?php $factura=json_decode($factura, true);
           foreach ($factura as $key => $fac){ ?>
      <tr>
            <td style="font-size: 90% "><?php echo $fac['NoFactura']; ?></td> 
            <td style="font-size: 90%;"><?php echo $fac['Cliente']; ?></td> 
            <td style="font-size: 90%;"><?php echo $fac['Pago']; ?></td> 
            <td style="font-size: 90%;"><?php echo $fac['fecha']; ?></td> 
            <td style="font-size: 90% "><?php echo $fac['Empleado']; ?></td>  
            <td style="font-size: 90% "><?php echo $fac['Total']; ?></td> 
            <td style="font-size: 90% "><?php echo $fac['Estado']; ?></td>  

        <td> <form action="/pollofrito/index.php/Asignacion_controller/empezarDetalle/<?php echo $fac['NoFactura']; ?>" name="formVerDetalle" method="POST" enctype="multipart/form-data">
          <button type="submit" class="btn btn-default" value="formVerDetalle"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
         
          <button type="button" class="btn btn-default" onclick=""><i class="fa fa-trash" aria-hidden="true"></i></button>.
           </form>
        </td>
      </tr>
      
      <?php } ?>
    </tbody>
</table>
