<!------ Include the above in your HEAD tag ---------->

<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">gnar Municipios al usuario</h2>
                     <h3><b>Evento: </b> <?php $compra=json_decode($compra, true); echo $compra[0]['idgs_compra']; ?></h3>
                      <br>
                     
                      <div class="col-xs-3">
                        <select class="form-control">
                          <option>Oscar piedrsanta</option>
                          <option>Antonio Hernandez</option>
                          <option>Cesar Oliva</option>
                        </s
    
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                <!--CONTENIDO-->

                     <h2>Asielect>
                      </div>
                       <div class="col-xs-3">
                         <input class="form-control" type="date" name="fecha">
                       </div>
                      <button type="button" class="btn btn-info" data-toggle="modal" onclick="Nuevo()" data-target="#myModal" ><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar Producto</button>   

                      <div id="tabla"></div> 
                             

                      <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog modal-lg">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Producto</h4>
                              </div>
                              <div class="modal-body">
                                <div class="scrollmenu">
                                    <div id="tabla1"></div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                            
                          </div>
                        </div>

                <!--CONTENIDO-->
                </div>
            </div>
 
        </div>
    </div>
</div>

<script type="text/javascript">

  // Leer record
function readRecords() {
    $.get("http://localhost/pollofrito/index.php/Compra_controller/tablacompra/<?php echo $compra_id;?>", {}, function (data, status) {
        $("#tabla").html(data);
    });
}
function readRecordss() {
    $.get("http://localhost/pollofrito/index.php/Compra_controller/tablacompra1/<?php echo $compra_id;?>", {}, function (data, status) {
        $("#tabla1").html(data);
    });
}


function AsignarProductoCompra(producto_id, compra_id) {
    // get values
    var cant = prompt("Ingrese la cantidad:", '');

    if(cant == ""){
      alert("Debe ingresar una cantidad");
    }else{
   // var nombre = $("#nombre").val();
   // var caracteristicas = $("#caracteristicas").val();
   // var id = $("#municipio_id").val();
 
    // agregar registros
    $.post("http://localhost/pollofrito/index.php/Compra_controller/asignar_producto_recibir_compra", {
        producto_id: producto_id,
        compra_id:   compra_id,
        cant: cant
    }, function (data, status) {
        // close the popup
        
        //$("#myModal").modal("hide");
 
        // leer registros

        readRecords();
        readRecordss();
        // borrar campos
       /* $("#nombre").val("");
        $("#caracteristicas").val("");*/

    });

  }
}

function BorrarProductoCompra(id) {
    var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");
    if (conf == true) {
        $.post("http://localhost/pollofrito/index.php/Compra_controller/BorrarProductoCompra", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

$(document).ready(function () {

    readRecords();
    readRecordss();
 
});
   
</script>