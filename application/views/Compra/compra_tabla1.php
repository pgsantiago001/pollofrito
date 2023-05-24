<br>
 <div class="scrollmenu">
   <table class="table" id="tabla3" style="font-size: 85%;" width="100%">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>BARRAS</th>
                                            <th>NOMBRE</th>
                                            <th>DESCRIPCION</th>
                                            <th>CATEGORÍA</th>
                                            <th>STOCK</th>
                                            <th>ACCIONES</th>
                                          </tr>
                                        </thead>
                                        <tbody>

        <?php $productos=json_decode($productos, true);
           foreach ($productos as $key => $pro){ ?>
            <tr>
            <td><?php echo $pro['ID']; ?></td>
            <td><?php echo $pro['Barras'] ?></td>
            <td style="font-size: 90% "><?php echo $pro['Nombre']; ?></td> 
            <td style="font-size: 90% "><?php echo $pro['Descripcion'] ?></td>
            <td style="font-size: 90%;"><?php echo $pro['Categoria']; ?></td> 
            <td style="font-size: 90%;"><?php echo $pro['cant']; ?></td>  
            <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="AsignarProductoCompra(<?php echo $pro['ID']; ?>,<?php echo $compra_id; ?>)"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                                    </td>
                                                  </tr>
                                          
                                          <?php } ?>
                                        </tbody>
                                    </table>
</div>

<script type="text/javascript">

$(document).ready(function () {


    $('#tabla3').DataTable( {
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