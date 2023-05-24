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

                        <div class="modal fade" id="myModal" role="dialog">

                          <div class="modal-dialog">

                             <!-- Modal content-->

                            <div class="modal-content">

                              <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title">PRODUCTO</h4>

                              </div>

          <div class="modal-body">

              <form id="guardando" class="form-horizontal" action="" onsubmit="">

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="codigo" required>Codigo:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="codigo" placeholder="Nombre" name="codigo">

                      </div>

                    </div>   

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="nombre" required>Nombre:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">

                      </div>

                    </div>

                     <div class="form-group">

                      <label class="control-label col-sm-2" for="descripcion" required>Descripción:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion">

                      </div>

                    </div>  

                     <div class="form-group">

                      <label class="control-label col-sm-2" for="costo" required>Costo:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="costo" placeholder="Costo" name="costo">

                      </div>

                    </div> 

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="utilidad" required>Utilidad:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="utilidad" placeholder="Utilidad" name="utilidad">

                      </div>

                    </div> 

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="precio_venta" required>P/Venta:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="precio_venta" placeholder="Precio de Venta" name="precio_venta">

                      </div>

                    </div>  

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="preciomayoreo" required>P/Mayoreo:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="preciomayoreo" placeholder="Precio de Mayoreo" name="preciomayoreo">

                      </div>

                    </div>

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="preciofrecuente" required>P/Frecuente:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="preciofrecuente" placeholder="Precio de Frecuente" name="preciofrecuente">

                      </div>

                    </div>

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="precionormal" required>P/Normal:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="precionormal" placeholder="Precio de Normal" name="precionormal">

                      </div>

                    </div>

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="stock" required>Stock:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="stock" placeholder="Cantidad en el inventario" name="stock">

                      </div>

                    </div> 

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="estado" required>Estado:</label>

                      <div class="col-sm-10">

                        <select class="form-control text-capitalize" name="estado" id="estado"  style="width:50%;"  required>

                          <option value="Activo">Activo</option>

                          <option value="Inactivo">Inactivo</option>

                          </select> <br>

                            </div>

                    </div> 

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="imagen" required>Imagen:</label>

                      <div class="col-sm-10">

                        <input type="text" class="form-control" id="imagen" placeholder="Imagen" name="imagen">

                      </div>

                    </div> 

                    <div class="form-group">

                      <label class="control-label col-sm-2" for="Categoria_id" required>Categoría:</label>

                      <div class="col-sm-10">

                        <select class="form-control text-capitalize" name="Categoria_id" style="width:50%;" id="Categoria_id" required>

                    <?php
                    $categoria = json_decode($categoria, true);

                    foreach ($categoria as $cat) {
                      echo "<option value=" .
                        $cat["idgs_categoria"] .
                        ">" .
                        $cat["nombre"] .
                        "</option>";
                    }
                    ?>

                    </select> <br>

                      </div>

                    </div> 



                    <div class="form-group">        

                      <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="addRecord()">Guardar</button>

                      </div>

                    </div>

                    <input type="hidden" id="producto_id" name="prodcuto_id">

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



      <div class="row"><!--Incia fila busqueda productos R de Leon-->

          <div class="col-md-12">

              <div class="pre-scrollable" >

                  <div id="lista" style="height:0%;">



                  </div>

              </div>

          </div>

      </div><!--Finaliza fila busqueda productos R de Leon-->



    </div>

<!--    

</div>

  </div>-->



<script type="text/javascript">



    function lista_Prod(valor){

        $("#txtCodP").val('');

        $("#txtBarras").val('');

        $("#txtDescP").val('');

        $("#txtNomP").val('');

        $("#txtStock").val('');

        $("#txtCantP").val('');

        $("#txtPrecU").val('');

        $("#txtPrecioT").val('');

        if(valor == ''){

            $("#txtBusqueda").focus();

        }

        else {

            document.getElementById('lista').style.display='block';

            var dataString = 'buscar='+valor;

            $.ajax({

                url:"https://<?php print $_SERVER[
                  "HTTP_HOST"
                ]; ?>/pollofrito/index.php/Producto_controller/listProdVenta",

                type:'GET',

                crossDomain : true,

                cache: false,

                data:dataString,

				 dataType: "json",

            }).done(function(resp){

                if (resp != "")

                {

                    var valores = {};

                    

                  console.log(resp);

                 valores = eval(resp);

                    if(valores.length>0){

                        

                  

                    //var nomb =  valores[0]['nombre'];

                    //  var Desc = valores[0]['descripcion'];

                    //   var codBarras = valores[0]['codigo'];

                    $("#txtCodP").val(valores[0]['idgs_producto']);

                    $("#txtBarras").val(valores[0]['codigo']);

                    $("#txtNomP").val(valores[0]['nombre']+' / '+ valores[0]['descripcion']);

                    $("#txtDescP").val(valores[0]['descripcion']);

                    $("#txtStock").val(valores[0]['stock']);

                    $("#txtCantP").val('1');

                    $("#txtPrecU").val(valores[0]['precio_venta']);

                    $("#txtPrecMayoreo").val(valores[0]['preciomayoreo']);

                    $("#txtPrecFrecuente").val(valores[0]['preciofrecuente']);

                    $("#txtPrecNormal").val(valores[0]['precionormal']);

                    html="<table class='table table-hover'><thead><tr><th>ID</th><th>BARRAS</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CATEGORIA</th><th>STOCK</th><th>SELECCIONAR</th></tr></thead><tbody>";

                    for(i=0;i<valores.length;i++){

                        datos=valores[i]['idgs_producto']+"*"+valores[i]['codigo']+"*"+valores[i]['nombre']+"*"+valores[i]['descripcion']+"*"+valores[i]['NombreCat']+"*"+valores[i]['stock'];

                        html+="<tr><td>"+valores[i]['idgs_producto']+"</td><td>"+valores[i]['codigo']+"</td><td>"+valores[i]['nombre']+"</td><td>"+valores[i]['descripcion']+"</td><td>"+valores[i]['NombreCat']+"</td><td>"+valores[i]['stock']+"</td><td><button type='button' class='btn btn-primary btn-sm' name='agregar' id='" + i + "'><span class='glyphicon glyphicon-ok btn_add'></span></button></td></tr>";

                    }



                    html+="</tbody></table>"

                    $("#lista").html(html);

                    $('#txtCantP').focus();

                    }

                }

                else {

                    $("#txtCodP").val('---');

                    $("#txtDescP").val('---');

                    $("#txtNomP").val('---');

                    $("#txtStock").val('---');

                    $("#txtCantP").val('---');

                    $("#txtPrecU").val('---');

                    $("#txtPrecioT").val('---');

                }

            });

            //cacularP();

            setTimeout('cacularP()',600);

        }

    }





function Nuevo() {

   $("#codigo").val("");

   $("#nombre").val("");

   $("#descripcion").val("");

   $("#costo").val("");

   $("#utilidad").val("");

   $("#precio_venta").val("");

   $("#preciomayoreo").val("");

   $("#preciofrecuente").val("");

   $("#precionormal").val("");

   $("#stock").val("");

   $("#estado").val("");

   $("#imagen").val("");

   $("#Categoria_id").val("");

   $("#producto_id").val(0);  

}



// Leer record

function readRecords() {

    $.get("http://localhost/pollofrito/index.php/Producto_controller/tablaConsultarProducto", {}, function (data, status) {

        $("#tabla").html(data);

    });

}



function addRecord() {

    // get values

    if($("#nombre").val()== "" || $("#descripcion").val()== "" || $("#estado").val()== "" || $("#Categoria_id").val()== ""){

      alert("Debe de llenar todos los campos..");

    }else{

    var id               = $("#producto_id").val();

    var codigo           = $("#codigo").val();

    var nombre           = $("#nombre").val();

    var descripcion      = $("#descripcion").val();

    var costo            = $("#costo").val();

    var utilidad         = $("#utilidad").val();

    var precio_venta     = $("#precio_venta").val();

    var preciomayoreo    = $("#preciomayoreo").val();

    var preciofrecuente  = $("#preciofrecuente").val();

    var precionormal     = $("#precionormal").val();

    var stock            = $("#stock").val();

    var estado           = $("#estado").val();

    var imagen           = $("#imagen").val();

    var Categoria_id     = $("#Categoria_id").val();

 

    // agregar registros

    $.post("http://localhost/pollofrito/index.php/Producto_controller/nuevoProducto", {

        idproducto:        id,

        codigo:            codigo,

        nombre:            nombre,

        descripcion:       descripcion,

        costo:             costo,

        utilidad:          utilidad,

        precio_venta:      precio_venta,

        preciomayoreo:     preciomayoreo,

        preciofrecuente:   preciofrecuente,

        precionormal:      precionormal,

        stock:             stock,

        estado:            estado,

        imagen:            imagen,

        Categoria_id:      Categoria_id

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

    $("#producto_id").val(id);

    $.post("http://localhost/pollofrito/index.php/Producto_controller/mostrar_datos_producto", {

            id: id

        },

        function (data, status) {

            // PARSE json data

            var producto = JSON.parse(data);

            // Assing existing values to the modal popup fields

            $("#codigo").val(producto[0].codigo);

            $("#nombre").val(producto[0].nombre);

            $("#descripcion").val(producto[0].descripcion);

            $("#costo").val(producto[0].costo);

            $("#utilidad").val(producto[0].utilidad);

            $("#precio_venta").val(producto[0].precio_venta);

            $("#preciomayoreo").val(producto[0].preciomayoreo);

            $("#preciofrecuente").val(producto[0].preciofrecuente);

            $("#precionormal").val(producto[0].precionormal);

            $("#stock").val(producto[0].stock);

            $("#estado").val(producto[0].estado);

            $("#imagen").val(producto[0].imagen);

            $("#Categoria_id").val(producto[0].idcat);

        }

    );

}



function DeleteRecord(id) {

    var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");

    if (conf == true) {

        $.post("http://localhost/pollofrito/index.php/Producto_controller/eliminarProducto", {

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

    $("#producto_id").val(0);



});

   

</script>