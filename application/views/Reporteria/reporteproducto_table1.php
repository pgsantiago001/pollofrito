<br>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#tablaCR').DataTable( {
        lengthChange: false,
        buttons: [  {
                extend: 'copy',
                text: 'Copiar'
            }, 'excel', 'pdf', {
                extend: 'colvis',
                text: 'Ver columna'
            } ],
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
  table.buttons().container()
        .appendTo( '#tablaCR_wrapper .col-sm-6:eq(0)' );
});  
</script>


 <table class="table" id="tablaCR">
    <thead>
      <tr>
       <!-- <th>No</th> -->
        <th>PROVEEDOR</th>
        <th>FECHA</th>
        <th>EMPLEADO</th>
        <th>TOTAL</th>
        <th>ESTADO</th>
      </tr>
    </thead>
    <tbody>

       <?php $listaCR=json_decode($listaCR, true);
           foreach ($listaCR as $key => $cr){ ?>
      <tr>
           <!-- <td style="font-size: 90% "><?php echo $cr['NoCompra']; ?></td> -->
            <td style="font-size: 90%;"><?php echo $cr['Proveedor']; ?></td> 
            <td style="font-size: 90%;"><?php echo $cr['fecha']; ?></td> 
            <td style="font-size: 90% "><?php echo $cr['Empleado']; ?></td>  
            <td style="font-size: 90% "><?php echo $cr['Total']; ?></td> 
            <td style="font-size: 90% "><?php echo $cr['Estado']; ?></td>  
      </tr>
      
      <?php } ?>
    </tbody>
</table>