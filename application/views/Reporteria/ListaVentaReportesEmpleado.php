
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
              <label for="fecha1">Fecha Incio:</label>
        </div>
            <div class="col-sm-3">
            <div class="form-group">
                <input type='date' name="fecha1" class="form-control" />
            </div>
            </div>
            <div class="col-xs-2">
              <label for="fecha2">Fecha Final:</label>
          </div>
            <div class="col-sm-3">
             <div class="form-group">
                    <input type='date' name="fecha2" class="form-control" />
                </div>
            </div>
               <br>
           </div>
            <div class="row col-xs-12">
          <div class="col-xs-2">
              <label for="clasefaltas_id">Empleado:</label>
          </div>
          <div class="col-xs-3">
              <select class="form-control text-capitalize" name="empleado[]" id="empleado" multiple="multiple" required>
              <?php 
              $empleado=json_decode($empleado, true);
              foreach ($empleado as $em){
              echo "<option value=".$em['ID'].">".$em['Nombre']."</option>";
              }
              ?>
              </select> <br>
          </div> 
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
           <div id="tablaEmpleado"></div>           
        </div>
      </div>    
<script type="text/javascript">

// Leer record

function readRecords() {
    $.get("http://localhost/pollofrito/index.php/Reportes_controller/tablaListaVentaReportesEmpleado", {}, function (data, status) {
        $("#tablaEmpleado").html(data);
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
                url: "https://<?php print $_SERVER['HTTP_HOST'];?>/pollofrito/index.php/Reportes_controller/tablaListaVentaReportesEmpleado/",
                beforeSend: function(){
                    $("#loading").dialog({
                        modal: true, maxWidth:300, maxHeight: 100, width: 300, height: 100, dialogClass: 'hide-close',
                    });
                }
            }).done(function(data){
                $("#loading").dialog('close');
                $('#tablaEmpleado').html(data);
                //document.getElementById('menu1').click();
            }).fail(function(){
                $("#loading").dialog
            }).always(function(){});
        //}
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#empleado').multiselect({includeSelectAllOption: true});
        //$('#unidad').multiselect({includeSelectAllOption: true});
        //$('#sexo_id').multiselect({includeSelectAllOption: true});
        //$('#periodo_id').multiselect({includeSelectAllOption: true});
    });
</script>