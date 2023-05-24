<style type="text/css">
    .panel-group {
        margin-bottom: 0px !important;
    }
    .panel {
        margin-bottom: 0px !important;
    }
</style>
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="row">
                      <div class="col-md-3">
                         <button type="button" class="btn btn-warning" onclick="leerDatspspr();"><span class="glyphicon glyphicon-search">Ver Prod.</span></button>
                     </div>
                      <!-- checkbox desceuntos-->
                      <div class="row">
                              <div class="col-md-6">
                              <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" onclick="calcularDescVenta();" id="btnDescVenta">Prec. Venta</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" onclick="calcularDescNormal();" id="btnDescNormal">Desc. Normal</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" onclick="calcularDescFrecuente();" id="btnDescFrecuente">Desc. Frecuente</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" onclick="calcularDescMayoreo();" id="btnDescMayoreo">Desc. Mayoreo</button>
                                    </div>
                                  </div>
                              </div>  
                            </div>                          
                                <!--finaliza checkbox desceuntos-->
                       <div class="col-md-12">
                         <div class="pre-scrollable" >
                           <div id="lista" style="height:15%;">
                            </div>
                        </div>
                      </div>
                    </div>
                <div class="row"><!--Incia fila titulo busqueda productos R de Leon-->
                    <div class="col-md-1">
                        <h4><span class="text-primary">Busqueda</span></h4>
                    </div>
                    <div class="col-md-3">
                        <h4><span class="text-primary">Nombre</span></h4>
                    </div>
                    <div class="col-md-1" >
                        <h4><span class="text-primary" >Stock</span></h4>
                    </div>
                    <div class="col-md-1">
                        <h4><span class="text-primary">Cantidad</span></h4>
                    </div>
                    <div class="col-md-1">
                        <h4><span class="text-primary">Precio/U</span></h4>
                    </div>
                    <div class="col-md-1">
                        <h6><span class="text-primary">Desc. Normal</span></h6>
                    </div>
                    <div class="col-md-1">
                        <h6><span class="text-primary">Desc. Frecuente</span></h6>
                    </div>
                    <div class="col-md-1">
                        <h6><span class="text-primary">Desc. Mayoreo</span></h6>
                    </div>
                    <div class="col-md-1">
                        <h4><span class="text-primary">Precio/T</span></h4>
                    </div>
                    <div class="col-md-1">
                        <h4><span class="text-primary">Devolver</span></h4>
                    </div>


                </div><!--finaliza row titulo busqueda productos R de Leon-->

                <div class="row"><!--inicia row inputs busqueda productos R de Leon-->
                    <div class="col-md-1">
                        <input type="text" class="form-control" id="txtBusqueda" name="txtBusqueda" onkeyup="lista_Prod(this.value);" placeholder="BUSQUEDA"></input>
                        <input type="text" class="form-control" id="txtCodP" name="txtCodP" style="display: none" placeholder="idProducto"></input>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="txtNomP" name="txtNomP" placeholder="nombre del producto"></input>
                        <input type="text" class="form-control" id="txtBarras" name="txtBarras" placeholder="codigo barras" style="display: none"></input>
                    </div>
                    <div class="col-md-1" >
                        <input type="text" class="form-control" id="txtStock" name="txtStock" readonly ></input>
                        <input type="text" class="form-control" id="txtDescP" name="txtDescP" style="display: none" placeholder="descripcion del producto"></input>
                    </div>

                    <div class="col-md-1">
                        <input type="text" class="form-control" id="txtCantP" name="txtCantP" onkeyup="cacularP();"></input>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" id="txtPrecU" name="txtPrecU" readonly></input>
                    </div>
                    <div class="col-md-1">
                    <input type="text" class="form-control" id="txtPrecNormal" name="txtPrecNormal" readonly></input>
                    </div>
                    <div class="col-md-1">
                    <input type="text" class="form-control" id="txtPrecFrecuente" name="txtPrecFrecuente" readonly></input>
                    </div>
                    <div class="col-md-1">
                    <input type="text" class="form-control" id="txtPrecMayoreo" name="txtPrecMayoreo" readonly></input>
                    </div>
                    <div class="col-md-1">
                    <input type="text" class="form-control" id="txtPrecioT" name="txtPrecioT" readonly></input>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger" id="btnAgrDev" name="btnAgrDev" onclick="AgregarDev();"><span class="glyphicon glyphicon-minus"></span></button>
                    </div>
                </div> <!--finaliza row titulo inputs busqueda productos R de Leon-->
                <div class="row"><!--Incia fila busqueda productos R de Leon-->
                    <div class="panel-heading"  class=" p-3 mb-2 bg-primary text-white"><span class="text-primary"> DETALLE DEVOLUCIÒN</span>
                        <div class="col-md-12"><!--Incia contenedor tabla detalle productos R de Leon-->
                            <div class="pre-scrollable" ><!--Incia contenedor tabla detalle productos R de Leon-->
                                <div id="DetScroll" style="height:10%;"><!--Incia contenedor tabla detalle productos R de Leon-->
                                    <table class='table table-hover' id="tblProductoDev" name="tblProductoDev">
                                        <thead>
                                        <tr>
                                            <th style="display: none">ID</th>
                                            <th>BARRAS</th>
                                            <th>NOMBRE</th>
                                            <th>DESCRIPCION</th>
                                            <th>CANTIDAD</th>
                                            <th>PRE/U</th>
                                            <th>SUBTOTAL</th>
                                            <th>ELIMINAR</th>
                                        </tr>
                                        </thead>
                                        <tbody id="contTblDev" name="contTblDev">
                                        </tbody>
                                    </table>
                                </div><!--Finaliza fila tabla productos detalle R de Leon-->
                            </div><!--Finaliza el contenedor scrollable detalle P-->
                            <td><h4><span class="text-secondary">Monto Devolucion Q. </span><span class="text-secondary" id="txtTotDev" name="txtTotDev">---</span></h4></td>
                        </div>
                    </div>
                </div><!--Finaliza fila busqueda productos R de Leon-->
            </div>
            <!--finaliza rows de botones R de Leon-->
        </div>
        <br>
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="row">
                <div class="col-md-1">
                    <strong>
                        <span class="form-control" style="border: none"> Nit:</span>
                        <span class="form-control"  style="border: none">Nombre:</span>
                        <span class="form-control" style="border: none" >Direcciòn:</span>
                    </strong>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="txtId" name="txtId" style="display: none"></input>
                    <input type="text" class="form-control" id="txtNit" name="txtNit"></input>
                    <input type="text" class="form-control" id="txtNombreCl" name="txtNombreCl"></input>
                    <input type="text" class="form-control" id="txtDirec" name="txtDirec"></input>
                </div>
                <div class="col-md-2">
                    <strong>  <span class="form-control" style="border: none">Usuario:</span>
                        <span class="form-control" style="border: none">Fecha:</span>
                        <span class="form-control flex-wrap" style="border: none">No. Factura/boleta:</span>
                    </strong>
                </div>
                <div class="col-md-2">
                    <input type="text" readonly class="form-control"  id="idUser" name="idUser" value="<?php echo $this
                      ->session->ID; ?>" style="display:none;"></input>
                    <input type="text" readonly class="form-control" value="<?php echo $this
                      ->session->Nombre; ?>"></input>
                    <input type="text" class="form-control" id="FechDetVenta" name="FechDetVenta" readonly></input>
                    <strong>  <input type="text" class="form-control" id="NoFac" name="NoFac" readonly></input> </strong>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" onclick="empezarFacturaP();" id="btnEmpD" name="btnEmpD">Empezar Detalle</button>
                    <button type="button" class="btn btn-success" id="BtnNuevoCL" name="BtnNuevoCL" onclick="nuevoCl();"><span class="glyphicon glyphicon-plus">Nuevo Cliente</span></button>
                    <span id="textRespDet" name="textRespDet"></span>
                    <button type="button" class="btn btn-warning" id="btnAgrProd" name="btnAgrProd" onclick="DetalleP();"><span class="glyphicon glyphicon-shopping-cart">Agregar Prod.</span></button>
                </div>

            </div>
            <div class="row">
                <div class="panel-heading"  class=" p-3 mb-2 bg-primary text-white"><span class="text-primary"> DETALLE VENTA</span>
                <div class="col-md-12"><!--Incia contenedor tabla detalle productos R de Leon-->
                    <div class="pre-scrollable" ><!--Incia contenedor tabla detalle productos R de Leon-->
                        <div id="DetScroll" style="height:20%;"><!--Incia contenedor tabla detalle productos R de Leon-->
                            <table class='table table-hover' id="tblProducto" name="tblProducto">
                                <thead>
                                <tr>
                                    <th style="display: none">ID</th>
                                    <th>BARRAS</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>CANTIDAD</th>
                                    <th>PRE/U</th>
                                    <th>SUBTOTAL</th>
                                    <th>ELIMINAR</th>
                                </tr>
                                </thead>
                                <tbody id="contTbl" name="contTbl">
                                </tbody>
                            </table>
                        </div><!--Finaliza fila tabla productos detalle R de Leon-->
                    </div><!--Finaliza el contenedor scrollable detalle P-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 float-right">
                <table class="table table-sm">
                    <tbody>
                  <!--  <tr>
                        <td><h4><span class="text-primary">Descuento:   %</span></h4></td>
                        <td><input type="text"  id="txtDescuen" name="txtDescuen" class="form-control" onkeyup="calcularDescuento(); totalTotProd();"></input></td>
                    </tr> -->
                    <tr>
                        <td><h4><span class="text-primary">Efectivo:</span></h4></td>
                        <td><input type="text"  id="txtEfectivo" name="txtEfectivo" class="form-control" onkeyup="calculaCambioDev();"></input></td>
                    </tr>
                    <tr>
                        <td><h4><span class="text-primary">Cambio:</span></h4></td>
                        <td><input type="text"  id="txtCambio" name="txtCambio" class="form-control"></input></td>
                    </tr>
                    <tr>
                         <td> <h4><span class="text-warning">Diferencia de dev. Q.</span></h4></td>
                        <td> <h4><span class="text-primary" id="DifDev" name="DifDev">--</span></h4></td></h3>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <input type="text"  id="NoFactAnt" name="NoFactAnt" class="form-control" placeholder="No. Factura anterior"></input>
                <textarea name="commentDev" id="commentDev" form="usrform" placeholder="Comentario de devolucion" cols="35" rows="6"></textarea>
            </div>
            <div class="col-md-4">
                <table class="table table-sm">
                    <tbody>
                    <tr>
                        <td><h4><span class="text-primary">Neto Q.</span></h4></td>
                        <td><h4><span class="text-info" id="txtTotNeto" name="txtTotNeto">---</span></h4></td>
                    </tr>
                    <tr>
                        <td><h4><span class="text-primary">Desc. Q.</span></h4></td>
                        <td><h4><span class="text-primary" id="txtDescPor" name="txtDescPor">0</span></h4></td>
                    </tr>
                    <tr>
                        <td><h4><span class="text-primary">TOTAL. Q.</span></h4></td>
                        <td><h4><span class="text-primary" id="txtTotFinal" name="txtTotFinal">--</span></h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <input type="text"  id="PagEfect" name="PagEfect" class="form-control" placeholder="EFECTIVO Q." style="display: none" ></input>
            </div>
            <div class="col-md-3">
                <input type="text"  id="PagTar" name="PagTar" class="form-control" placeholder="TARJETA Q." style="display: none"></input>
            </div>
            <div class="col-md-2">
                <input type="text"  id="PagCheq" name="PagCheq" class="form-control" placeholder="CHEQUE Q." style="display: none"></input>
            </div>
            <div class="col-md-4">
                <span class="text-primary" id="txTotPendDiv" name="txTotPendDiv" style="display: none">Pendiente Q:</span> <span class="text-warning" id="TotPagDiv" name="TotPagDiv" style="display: none">00:00 </span>
                <select id="metPago" name="metPago" class="form-inline">
                    <option value="1">Efectivo</option>
                    <option value="2">Tarjeta</option>
                    <option value="3">Cheque</option>
                    <option value="4">Dividido</option>
                </select>
                <button type="button" id="FacturaSend" name="FacturaSend" class="btn btn-success btn-lg glyphicon glyphicon-shopping-cart" onclick="BtnPagarDev();" >PAGAR</button>


            </div>

        </div>
        </div>
    </div>
	
	<script>

    function lista_Prod(valor){
        $("#txtCodP").val('');
        $("#txtBarras").val('');
        $("#txtDescP").val('');
        $("#txtNomP").val('');
        $("#txtStock").val('');
        $("#txtCantP").val('');
        $("#txtPrecU").val('');
        $("#txtPrecMayoreo").val('');
        $("#txtPrecFrecuente").val('');
        $("#txtPrecNormal").val('');
        $("#txtPrecioT").val('');
        if(valor == ''){
            $("#txtBusqueda").focus();
        }
        else {
            document.getElementById('lista').style.display='block';
            var dataString = 'buscar='+valor;
            $.ajax({
                url:"https://<?php print $_SERVER[
                  "https_HOST"
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
                    //$('#txtCantP').focus();
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
</script>
 