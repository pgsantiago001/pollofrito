<br>

<script type="text/javascript">



$(document).ready(function () {

    $('#tablaProducto').DataTable( {
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

 <table class="table" id="tablaProducto">
    <thead>
      <tr>
        <th>ID</th>
        <th>CODIGO</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>ES PRODUCTO PREPARADO</th>
        <th>COSTO</th>
        <th>UTILIDAD</th>
        <th>P/VENTA</th>
        <th>P/MAYOREO</th>
        <th>P/FRECUENTE</th>
        <th>P/NORMAL</th>
        <th>STOCK</th>
       <!-- <th>ESTADO</th>
        <th>IMAGEN</th>-->
        <th>CATEGORÍA</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>

       <?php
       $producto = json_decode($producto, true);
       foreach ($producto as $key => $prod) { ?>
      <tr>
            <td style="font-size: 50% "><?php echo $prod[
              "idgs_producto"
            ]; ?></td> 
            <td style="font-size: 90%;"><?php echo $prod["codigo"]; ?></td> 
            <td style="font-size: 90%;"><?php echo $prod["nombre"]; ?></td> 
            <td style="font-size: 90%;"><?php echo $prod[
              "descripcion"
            ]; ?></td> 
            <td style="font-size: 90% ">
              <input type="checkbox" disabled 
                <?php echo $prod["esproductopreparado"] == 1
                  ? "checked"
                  : ""; ?>
              >
            </td> 
            <td style="font-size: 90% "><?php echo $prod["costo"]; ?></td>  
            <td style="font-size: 90% "><?php echo $prod["utilidad"]; ?></td> 
            <td style="font-size: 90% "><?php echo $prod[
              "precio_venta"
            ]; ?></td>  
            <td style="font-size: 90% "><?php echo $prod[
              "preciomayoreo"
            ]; ?></td> 
            <td style="font-size: 90% "><?php echo $prod[
              "preciofrecuente"
            ]; ?></td> 
            <td style="font-size: 90% "><?php echo $prod[
              "precionormal"
            ]; ?></td> 
            <td style="font-size: 90% "><?php echo $prod["stock"]; ?></td> 
<!--<td style="font-size: 90% "><?php echo $prod["estado"]; ?></td>   
            <td style="font-size: 90% "><?php echo $prod["imagen"]; ?></td> -->
            <td style="font-size: 90% "><?php echo $prod["NombreCat"]; ?></td> 

        <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="GetDetails(<?php echo $prod[
          "idgs_producto"
        ]; ?>)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
          <button type="button" class="btn btn-default" onclick="DeleteRecord(<?php echo $prod[
            "idgs_producto"
          ]; ?>)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        </td>
      </tr>
      
      <?php }
       ?>
    </tbody>
</table>
