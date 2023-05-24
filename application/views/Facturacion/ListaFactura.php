
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

    <div class="panel panel-success">
                          <div id="tabla"></div>
        </div>
      </div>
    <!-- </div>
  </div>
</div>-->
<script type="text/javascript">
// Leer record
function readRecords() {
    $.get("http://localhost/pollofrito/index.php/Facturacion_controller/tablaFactura", {}, function (data, status) {
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