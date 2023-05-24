
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
<style type="text/css">
  
.panel-group {
    margin-bottom: 0px !important;
}
.panel {
    margin-bottom: 0px !important;
}
</style>
  <div class="col-sm-10">
 <form method="POST" action="" id="form">
   <div class="row">
        <div class="col-xs-2">
              <label for="Categoria_id">Categoria:</label>
        </div>
             <div class="form-group">
                      <div class="col-xs-8">
                        <select class="form-control text-capitalize" name="Categoria_id" style="width:50%;" id="Categoria_id" required>
                         <option>-Elija una Opción-</option>
                         <option value="0">TODAS LAS CATEGORIAS</option>
                    <?php 
                    $categoria=json_decode($categoria, true);

                    foreach ($categoria as $cat) {
                    echo "<option value=".$cat['idgs_categoria'].">".$cat['nombre']."</option>";
                    }
                    ?>
                    </select> <br>
                      </div>
                    </div> 
               <br>
             
            </div>
             <div class="row">
          <div class="col-sm-2">
                        <input type="hidden" name="ctrl" value="1">
                        <!--<input type="submit" value="Ver" type="button" class="btn btn-success" />-->
                          <button type="button" class="btn btn-success" id="procesar">
                                <span class="glyphicon glyphicon-search">Consultar</span>
                        </button>
            </div>
        </div>
          </form>
    <div class="panel panel-success">
           <div id="tabla"></div>           
        </div>
      </div>    
      
    <!--</div>
    
  </div>
</div>-->

<script type="text/javascript">

// Leer record
function readRecords() {
    $.get("http://localhost/pollofrito/index.php/Reportes_controller/tablaListaProductosReportes", {}, function (data, status) {
        $("#tabla").html(data);
    });
}

function addRecord() {
    // get values
    if($("#codigo").val() == "" ){
      alert("Debe de llenar todos los campos..");
    }else{
    var id               = $("#producto_id").val();
 
 
    // agregar registros
    $.post("http://localhost/pollofrito/index.php/Facturacion_controller/nuevoFactura", {
        idproducto:        id,
    }, function (data, status) {
 
        // leer registros
        readRecords();
        // borrar campos
        Nuevo(); 

    });

  }
}

function GetDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#factura_id").val(id);
    $.post("http://localhost/pollofrito/index.php/Facturacion_controller/mostrar_datos_factura", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var factura = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#codigo").val(producto[0].codigo);
        }
    );
}

function DeleteRecord(id) {
    var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");
    if (conf == true) {
        $.post("http://localhost/pollofrito/index.php/Facturacion_controller/eliminarFactura", {
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
    // READ recods on page load
    readRecords(); // calling function
   // addRecordCliente();
    $("#factura_id").val(0);

});
   
</script>

<script>
    $("#procesar").click(function(){
           var post = $("#form").serialize();
            console.log(post);
            var envio = $.ajax({
                method: "POST",
                data: post,
                url: "https://<?php print $_SERVER['HTTP_HOST'];?>/pollofrito/index.php/Reportes_controller/tablaListaProductosReportes/",
                beforeSend: function(){
                    $("#loading").dialog({
                        modal: true, maxWidth:300, maxHeight: 100, width: 300, height: 100, dialogClass: 'hide-close',
                    });
                }
            }).done(function(data){
                $("#loading").dialog('close');
                $('#tabla').html(data);
                //document.getElementById('menu1').click();
            }).fail(function(){
                $("#loading").dialog
            }).always(function(){});
        //}
    });
</script>