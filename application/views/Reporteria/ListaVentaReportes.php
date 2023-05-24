<?php if (!defined("BASEPATH")) {
  exit("No direct script access allowed");
} ?>
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
    <div class="row">
            <table border="1" style="float: left;" width="50%">
                <tr>
                  <td>
                    <H4>VENTAS A LA FECHA</H4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div id="tabla"></div>
                  </td>
                </tr>
          </table>

          <table border="1" width="50%">
            <tr>
            <td>
              <h4>PRODUCTOS VENDIDOS</h4>
            </td>
          </tr>
          <tr>
            <td>
              <div id="tablaProductos"></div>
            </td>
          </tr>
          </table> 
          </div>  
      
    <!-- </div>
    
  </div>
</div>          -->

<script type="text/javascript">

// Leer record
function readRecords() {
    $.get("http://localhost/pollofrito/index.php/Reportes_controller/tablaListaVentaReportes", {}, function (data, status) {
        $("#tabla").html(data);
    });
}
function readRecordss() {
   $.get("http://localhost/pollofrito/index.php/Reportes_controller/tablaListaVentaReportesProductos", {}, function (datas, status) {
       $("#tablaProductos").html(datas);
   });
}





$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
    readRecordss(); 
   // addRecordCliente();

});
   
</script>

<script>
    $("#procesar").click(function(){
           var post = $("#form").serialize();
            console.log(post);
            var envio = $.ajax({
                method: "POST",
                data: post,
                url: "https://<?php print $_SERVER[
                  "HTTP_HOST"
                ]; ?>/pollofrito/index.php/Reportes_controller/tablaListaVentaReportes/",
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
<script>
    $("#procesar").click(function(){
           var post = $("#form").serialize();
            console.log(post);
            var envio = $.ajax({
                method: "POST",
                data: post,
                url: "https://<?php print $_SERVER[
                  "HTTP_HOST"
                ]; ?>/pollofrito/index.php/Reportes_controller/tablaListaVentaReportesProductos/",
                beforeSend: function(){
                    $("#loading").dialog({
                        modal: true, maxWidth:300, maxHeight: 100, width: 300, height: 100, dialogClass: 'hide-close',
                    });
                }
            }).done(function(data){
                $("#loading").dialog('close');
                $('#tablaProductos').html(data);
                //document.getElementById('menu1').click();
            }).fail(function(){
                $("#loading").dialog
            }).always(function(){});
        //}
    });
</script>