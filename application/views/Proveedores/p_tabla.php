<br>

<script type="text/javascript">



$(document).ready(function () {

    $('#tablaP').DataTable( {
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


 <table class="table" id="tablaP">
    <thead>
      <tr>
        <th>CÓDIGO</th>
        <th>NIT</th>
        <th>NOMBRE</th>
        <th>WEB</th>
        <th>TEL</th>
        <th>CONTACTO</th>
        <th>APELLIDO_CONTAC</th>
        <th>EMAIL</th>
        <th>CEL</th>
        <th>DIRECCIÓN</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>

       <?php $proveedor=json_decode($proveedor, true);
           foreach ($proveedor as $key => $pro){ ?>
      <tr>
            <td style="font-size: 90% "><?php echo $pro['idgs_proveedor']; ?></td> 
            <td style="font-size: 90%;"><?php echo $pro['nit']; ?></td> 
            <td style="font-size: 90%;"><?php echo $pro['nombre']; ?></td> 
            <td style="font-size: 90%;"><?php echo $pro['sitioweb']; ?></td> 
            <td style="font-size: 90% "><?php echo $pro['telefono']; ?></td>  
            <td style="font-size: 90% "><?php echo $pro['nombres_cont']; ?></td> 
            <td style="font-size: 90% "><?php echo $pro['apellidos_cont']; ?></td>  
            <td style="font-size: 90% "><?php echo $pro['correoelectronico_cont']; ?></td> 
            <td style="font-size: 90% "><?php echo $pro['telefono_cont']; ?></td>   
            <td style="font-size: 90% "><?php echo $pro['direccion_cont']; ?></td> 

        <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="GetDetails(<?php echo $pro['idgs_proveedor']; ?>)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-default" onclick="DeleteRecord(<?php echo $pro['idgs_proveedor']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </td>
      </tr>
      
      <?php } ?>
    </tbody>
</table>

