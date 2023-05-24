<br>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#tablaVR').DataTable( {
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
        .appendTo( '#tablaVR_wrapper .col-sm-6:eq(0)' );
});  
</script>


 <table class="table" id="tablaVR">
    <thead>
      <tr>
        <th>DOCUMENTO No</th>
        <th>CLIENTE</th>
        <th>FECHA</th>
        <th>EMPLEADO</th>
        <th>TOTAL</th>
        <th>ESTADO</th>
      </tr>
    </thead>
    <tbody>

       <?php $listaVR=json_decode($listaVR, true);
           foreach ($listaVR as $key => $vr){ ?>
      <tr>
            <td style="font-size: 90% "><?php echo $vr['NoFactura']; ?></td> 
            <td style="font-size: 90%;"><?php echo $vr['Cliente']; ?></td> 
            <td style="font-size: 90%;"><?php echo $vr['fecha']; ?></td> 
            <td style="font-size: 90% "><?php echo $vr['Empleado']; ?></td>  
            <td style="font-size: 90% "><?php echo $vr['Total']; ?></td> 
            <td style="font-size: 90% "><?php echo $vr['Estado']; ?></td>  
      </tr>
      
      <?php } ?>
    </tbody>
</table>