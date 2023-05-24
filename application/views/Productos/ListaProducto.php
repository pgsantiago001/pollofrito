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
        <div class="row"><!--Incia fila titulo busqueda productos R de Leon-->
            <div class="col-md-2">
                <h4><span class="text-primary">Busqueda</span></h4>
            </div>
            <div class="col-md-4">
                <h4><span class="text-primary">Nombre</span></h4>
            </div>
            <div class="col-md-1">
                <h4><span class="text-primary">Stock</span></h4>
            </div>
            <div class="col-md-1">
                <h4><span class="text-primary">Cantidad</span></h4>
            </div>
            <div class="col-md-1">
                <h4><span class="text-primary">Precio/U</span></h4>
            </div>
            <div class="col-md-2" style="display: none">
                <h4><span class="text-primary">Precio/T</span></h4>
            </div>
            <div class="col-md-1">
                <h4><span class="text-primary">Agregar Stock</span></h4>
            </div>
        </div><!--finaliza row titulo busqueda productos R de Leon-->
        <div class="row"><!--inicia row inputs busqueda productos R de Leon-->
            <div class="col-md-2">
                <input type="text" class="form-control" id="txtBusqueda" name="txtBusqueda" onkeyup="lista_Prod(this.value);" placeholder="BUSQUEDA"></input>
                <input type="text" class="form-control" id="txtCodP" name="txtCodP" style="display: none" placeholder="idProducto"></input>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="txtNomP" name="txtNomP" placeholder="nombre del producto"></input>
                <input type="text" class="form-control" id="txtBarras" name="txtBarras" placeholder="codigo barras" style="display: none"></input>
            </div>
            <div class="col-md-1">
                <input type="text" class="form-control" id="txtStock" name="txtStock" readonly></input>
                <input type="text" class="form-control" id="txtDescP" name="txtDescP" style="display: none" placeholder="descripcion del producto"></input>
            </div>

            <div class="col-md-1">
                <input type="text" class="form-control" id="txtCantP" name="txtCantP" onkeyup="cacularP();"></input>
            </div>
            <div class="col-md-1">
                <input type="text" class="form-control" id="txtPrecU" name="txtPrecU"></input>
            </div>
            <div class="col-md-1">
                <input type="text" class="form-control" id="txtPrecMayoreo" name="txtPrecMayoreo"></input>
            </div>
            <div class="col-md-1">
                <input type="text" class="form-control" id="txtPrecFrecuente" name="txtPrecMayoreo"></input>
            </div>
            <div class="col-md-1">
                <input type="text" class="form-control" id="txtPrecNormal" name="txtPrecMayoreo"></input>
            </div>
            <div class="col-md-2" style="display: none">
                <input type="text" class="form-control" id="txtPrecioT" name="txtPrecioT" readonly></input>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-success" id="btnAgrProd" name="btnAgrProd" onclick="AgregarStockProv();"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
        </div>
        <button type="button" class="btn btn-info" data-toggle="modal" onclick="Nuevo()" data-target="#myModal" ><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
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
                      <label class="control-label col-sm-2" for="esproductopreparado" required>Es producto preparado:</label>
                      <div class="col-sm-10">
                        <input type="checkbox" class="form-check-input" id="esproductopreparado" name="esproductopreparado">
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
    
<!--</div>
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
    $.get("http://localhost/pollofrito/index.php/Producto_controller/tablaProducto", {}, function (data, status) {
        $("#tabla").html(data);
    });
}

function addRecord() {
    // get values
    if($("#nombre").val()== "" || $("#descripcion").val()== "" || $("#estado").val()== "" || $("#Categoria_id").val()== ""){
      alert("Debe de llenar todos los campos..");
    }else{
 
    // agregar registros
    $.post("http://localhost/pollofrito/index.php/Producto_controller/nuevoProducto", {
        idproducto:           $("#producto_id").val(),
        codigo:               $("#codigo").val(),
        nombre:               $("#nombre").val(),
        descripcion:          $("#descripcion").val(),
        esproductopreparado:  Number($("#esproductopreparado").prop("checked")),
        costo:                $("#costo").val(),
        utilidad:             $("#utilidad").val(),
        precio_venta:         $("#precio_venta").val(),
        preciomayoreo:        $("#preciomayoreo").val(),
        preciofrecuente:      $("#preciofrecuente").val(),
        precionormal:         $("#precionormal").val(),
        stock:                $("#stock").val(),
        estado:               $("#estado").val(),
        imagen:               $("#imagen").val(),
        Categoria_id:         $("#Categoria_id").val(),
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
            if (!!+(producto[0].esproductopreparado)) {
              $("#esproductopreparado").prop("checked", true);
              $("#costo").prop("disabled", true);
              $("#utilidad").prop("disabled", true);
              $("#precio_venta").prop("disabled", true);
              $("#precio_venta").prop("disabled", true);
              $("#preciofrecuente").prop("disabled", true);
              $("#precionormal").prop("disabled", true);
              $("#stock").prop("disabled", true);
              $("#costo").val(0);
              $("#utilidad").val(0);
              $("#precio_venta").val(0);
              $("#precio_venta").val(0);
              $("#preciofrecuente").val(0);
              $("#precionormal").val(0);
              $("#stock").val(0);
            } else {
              $("#esproductopreparado").prop("checked", false);
              $("#costo").prop("disabled", false);
              $("#utilidad").prop("disabled", false);
              $("#precio_venta").prop("disabled", false);
              $("#precio_venta").prop("disabled", false);
              $("#preciofrecuente").prop("disabled", false);
              $("#precionormal").prop("disabled", false);
              $("#stock").prop("disabled", false);
            }
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