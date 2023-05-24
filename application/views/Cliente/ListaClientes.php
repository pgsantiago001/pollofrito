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
    
      <!--aqui termina el panel-->
  <div class="col-sm-10">

    <div class="panel panel-success">
        <button type="button" class="btn btn-info" data-toggle="modal" onclick="Nuevo()" data-target="#myModal" ><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>   

                      <div id="tabla"></div>         

                      <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog">
                          
                             <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">CLIENTE</h4>
                              </div>
          <div class="modal-body">
              <form id="guardando" class="form-horizontal" action="" onsubmit="">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="nombre" required>Cliente:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" placeholder="Nombres y Apellidos" name="nombre">
                      </div>
                    </div>   
                    <!--<div class="form-group">
                      <label class="control-label col-sm-2" for="sitioweb" required>Web:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="sitioweb" placeholder="Sitio Web" name="sitioweb">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-sm-2" for="telefono" required>Teléfono:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono">
                      </div>
                    </div>-->  
                     <div class="form-group">
                      <label class="control-label col-sm-2" for="nit" required>Nit:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nit" placeholder="Nit" name="nit">
                      </div>
                    </div> 
                   <!-- <div class="form-group">
                      <label class="control-label col-sm-2" for="nombres_cont" required>Contacto:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombres_cont" placeholder="Nombres" name="nombres_cont">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="apellidos_cont" required>Apellidos:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellidos_cont" placeholder="Nombres" name="apellidos_cont">
                      </div>
                    </div>  
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="correoelectronico_cont" required>Correo:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="correoelectronico_cont" placeholder="Nombres" name="correoelectronico_cont">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="telefono_cont" required>Teléfono:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono_cont" placeholder="Nombres" name="telefono_cont">
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="direccion_cont" required>Dirección:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="direccion_cont" placeholder="Dirección" name="direccion_cont">
                      </div>
                    </div> 

                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="addRecord()">Guardar</button>
                      </div>
                    </div>
                    <input type="hidden" id="cliente_id" name="cliente_id">
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        
      </div>
    </div>

                        <!--CONTENIDO MODAL-->
           
        </div>
        </div>

   <!--     </div>

     </div>
   </div>-->

   <script type="text/javascript">


   function Nuevo() {
      $("#nombre").val("");
      $("#sitioweb").val("");
      $("#telefono").val("");
      $("#nit").val("");
      $("#nombres_cont").val("");
      $("#apellidos_cont").val("");
      $("#correoelectronico_cont").val("");
      $("#telefono_cont").val("");
      $("#direccion_cont").val("");
      $("#cliente_id").val(0);
   }

   // Leer record
   function readRecords() {
       $.get("http://localhost/pollofrito/index.php/Cliente_controller/tablaCliente", {}, function (data, status) {
           $("#tabla").html(data);
       });
   }

   function addRecord() {
       // get values
       if($("#nombre").val()== "" || $("#nit").val()== "" ){
         alert("Debe de llenar todos los campos..");
       }else{
       var id                      = $("#cliente_id").val();
       var nombre                  = $("#nombre").val();
       var sitioweb                = $("#sitioweb").val();
       var telefono                = $("#telefono").val();
       var nit                     = $("#nit").val();
       var nombres_cont            = $("#nombres_cont").val();
       var apellidos_cont          = $("#apellidos_cont").val();
       var correoelectronico_cont  = $("#correoelectronico_cont").val();
       var telefono_cont           = $("#telefono_cont").val();
       var direccion_cont          = $("#direccion_cont").val();

       // agregar registros
       $.post("http://localhost/pollofrito/index.php/Cliente_controller/nuevoCliente", {
           idcliente:                 id,
           nombre:                    nombre,
           sitioweb:                  sitioweb,
           telefono:                  telefono,
           nit:                       nit,
           nombres_cont:              nombres_cont,
           apellidos_cont:            apellidos_cont,
           correoelectronico_cont:    correoelectronico_cont,
           telefono_cont:             telefono_cont,
           direccion_cont:            direccion_cont
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
       $("#cliente_id").val(id);
       $.post("http://localhost/pollofrito/index.php/Cliente_controller/mostrar_datos_cliente", {
               id: id
           },
           function (data, status) {
               // PARSE json data
               var cliente = JSON.parse(data);
               // Assing existing values to the modal popup fields
               $("#nombre").val(cliente[0].nombre);
               $("#sitioweb").val(cliente[0].sitioweb);
               $("#telefono").val(cliente[0].telefono);
               $("#nit").val(cliente[0].nit);
               $("#nombres_cont").val(cliente[0].nombres_cont);
               $("#apellidos_cont").val(cliente[0].apellidos_cont);
               $("#correoelectronico_cont").val(cliente[0].correoelectronico_cont);
               $("#telefono_cont").val(cliente[0].telefono_cont);
               $("#direccion_cont").val(cliente[0].direccion_cont);
           }
       );
   }

   function DeleteRecord(id) {
       var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");
       if (conf == true) {
           $.post("http://localhost/pollofrito/index.php/Cliente_controller/eliminarCliente", {
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
       $("#cliente_id").val(0);

   });

   </script>