<br>
<script type="text/javascript">
$(document).ready(function () {

    $('#tablaCompra').DataTable( {
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


 <table class="table" id="tablaCompra">
    <thead>
      <tr>
        <th>No</th>
        <th>PROVEEDOR</th>
        <th>FECHA</th>
        <th>EMPLEADO</th>
        <th>TOTAL</th>
        <th>ESTADO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

       <?php $compras=json_decode($compras, true);
           foreach ($compras as $key => $com){ ?>
      <tr>
            <td style="font-size: 90% "><?php echo $com['NoCompra']; ?></td> 
            <td style="font-size: 90%;"><?php echo $com['Proveedor']; ?></td>  
            <td style="font-size: 90%;"><?php echo $com['fecha']; ?></td> 
            <td style="font-size: 90% "><?php echo $com['Empleado']; ?></td>  
            <td style="font-size: 90% "><?php echo $com['Total']; ?></td> 
            <td style="font-size: 90% "><?php echo $com['Estado']; ?></td>  

        <td> <form action="/pollofrito/index.php/Compra_controller/empezarDetalleCompra/<?php echo $com['NoCompra']; ?>" name="formVerDetalle" method="POST" enctype="multipart/form-data">
          <button type="submit" class="btn btn-default" value="formVerDetalle"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
         
          <button type="button" class="btn btn-default" onclick=""><i class="fa fa-trash" aria-hidden="true"></i></button>.
           </form>
        </td>
      </tr>
      
      <?php } ?>
    </tbody>
</table>
