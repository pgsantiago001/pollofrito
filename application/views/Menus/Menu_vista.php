
<div class="col-sm-10">
    <div class="row">
        <small>
            <!--<a class="navbar-brand" href="/pgsantiagoholandesa/index.php//empezarEncargo"><i class="btn btn-success">Ventas Enc.</i></a>
            <a class="navbar-brand" href="/pgsantiagoholandesa/index.php//editaCancelaEncargo"><i class="btn btn-info">Editar/Cancelar pedidos</i></a>
            <a class="navbar-brand" href="/pgsantiagoholandesa/index.php//entregarPedidos" ><i class="btn btn-primary">Entregar pedidos</i></a>
            <a class="navbar-brand" href="/pgsantiagoholandesa/index.php//tiendas"><i class="btn btn-warning">Gestiòn de tiendas</i></a>-->
        </small>
    </div>
    <div class="col-sm-12">
        <h2 class="text-muted">GESTIÓN COMBOS</h2>
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <th>
                        <strong>  <span class="form-control" style="border: none">Nombre Combo:</span>
                            <input type="text" class="form-control" id="nomMenu" name="nomMenu">
                    </th>
                    <th>
                        <span class="form-control" style="border: none">Descripción:</span>
                        <input type="text" class="form-control col-sm-1" id="descripMenu" name="descripMenu">
                    </th>
                  <th>
                        <span class="form-control" style="border: none">Precio Costo:</span>
                        <input type="text" class="form-control" id="precioCosto" name="precioCosto">
                    </th>
                    <th>
                        <span class="form-control" style="border: none">Precio Venta:</span>
                        <input type="text" class="form-control" id="precioVenta" name="precioVenta">
                    </th>
                    <th>
                        <span class="form-control" style="border: none">&nbsp;</span>
                        <button type="button" class="btn btn-primary" onclick="guardarMenu();">Guardar</button>
                    </th>
                </tr>
            </table>
            </strong>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"><!--Incia contenedor tabla detalle productos R de Leon-->
            <div class="col-md-4">
                <label for="selectProd">Producto</label>
                <select name="selectProd" id="selectProd" class="form-control">
                    <option value="0">Seleccione Producto</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="selectCombo">Combo</label>
                <select name="selectCombo" id="selectCombo" class="form-control">
                    <option value="0">Seleccione combo</option>
                </select>
            </div>
            <div class="col-md-1">
                <label for="txtPrecioProductoMenu">Precio</label>
                    <input type="number" class="form-control" id="txtPrecioProductoMenu" name="txtPrecioProductoMenu" step="0.01">
            </div>
            <div class="col-md-1">
                <label for="txtCantidad">Cantidad</label>
                    <input type="number" class="form-control" id="txtCantidad" name="txtCantidad">
            </div>
            <div class="col-md-3">
                <label for="btnAsignar">&nbsp;</label><br>
                <button type="button" class="btn btn-primary" id="btnAsignar" onclick="asignarCombos();">Asignar Productos</button>
                <button type="button" id="NwProductBtn" class="btn btn-default" data-toggle="modal" data-target="#modalProdSugeridos">
                    Ver Combos
                </button>
            </div>
        </div> <!--Finaliza el contenedor scrollable detalle P-->
    </div><br>

    <h2 class="text-muted">GESTIÓN PRODUCTOS PREPARADOS</h2>
    <hr>

    <div class="row">
        <!-- CM:: contenedor tabla producto preparado -->
        <div class="col-md-12">
            <div class="col-md-4">
                <label for="selectProdP">Producto</label>
                <select name="selectProdP" id="selectProdP" class="form-control">
                    <option value="0">Seleccione Producto</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="selectProductoPreparado">Producto preparado</label>
                <select name="selectProductoPreparado" id="selectProductoPreparado" class="form-control">
                    <option value="0">Seleccione producto preparado</option>
                </select>
            </div>
            <div class="col-md-1">
                <label for="txtPrecioProductoPreparado">Precio</label>
                    <input type="number" class="form-control" id="txtPrecioProductoPreparado" name="txtPrecioProductoPreparado" step="0.01">
            </div>
            <div class="col-md-1">
                <label for="txtCantidadProductoPreparado">Cantidad</label>
                    <input type="number" class="form-control" id="txtCantidadProductoPreparado" name="txtCantidadProductoPreparado">
            </div>
            <div class="col-md-3">
                <label for="btnAsignarProductoPreparado">&nbsp;</label><br>
                <button type="button" class="btn btn-primary" id="btnAsignarProductoPreparado" onclick="asignarProductoPreparado();">Asignar Producto Preparado</button>
                <button type="button" id="productoPreparadoBtn" class="btn btn-default" data-toggle="modal" data-target="#modalProductoPreparado">
                    Ver Productos Preparados
                </button>
            </div>
        </div>
    </div><br>

    <div class="modal modal-md fade"
      style="width: 1000px; margin-top: 25px; margin-left: auto; margin-right: auto;"
      id="modalProdSugeridos" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true"
      data-backdrop="static" data-keyboard="false" data-backdrop="static" data-keyboard="false">
        <div class="" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDICION DE COMBOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span><i></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pre-scrollable" ><!--Incia contenedor tabla detalle productos R de Leon-->
                        <div id="DetScroll" style="height:25%;"><!--Incia contenedor tabla detalle productos R de Leon-->
                            <div id="listaCombo" class="table-responsive">
                            </div>
                        </div><!--Finaliza fila tabla productos detalle R de Leon-->
                    </div><!--Finaliza el contenedor scrollable detalle P-->
                    <div class="row">
                      <div class="col-sm-3 col-sm-offset-6">
                        <strong>Precio costo</strong>
                      </div>
                      <div class="col-sm-3">
                        <strong>Precio venta</strong>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                         <input type="text" id="NombreCombo" class="form-control" placeholder="NOMBRE">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" id="DescripcionCombo" class="form-control" PLACEHOLDER="DESCRIPCION">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" id="precioCostoCombo" class="form-control" PLACEHOLDER="PRECIO COSTO">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" id="precioVentaCombo" class="form-control" PLACEHOLDER="PRECIO VENTA">
                      </div>
                    </div>
                </div>
                <hr style='margin-top: 5px; margin-bottom: 10px'>
                <div class="row" style='margin-bottom: 15px'>
                  <h5 class="modal-title" style='margin-left: 30px; margin-bottom: 10px; border-bottom: solid 1px gray'>Detalle de combo</h5>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="pre-scrollable" >
                        <div id="detalleCombo" style="height:30%;">
                        </div>
                    </div>
                   </div>
                </div>

                <div class="col-md-12">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" id="btnEditCombo" onclick="edtCombo()">Actualizar</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
                <hr style='margin-top: 5px; margin-bottom: 10px'>
            </div>
        </div>
    </div>

    <div class="modal modal-md fade"
      style="width: 1000px; margin-top: 25px; margin-left: auto; margin-right: auto;"
      id="modalProductoPreparado" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true"
      data-backdrop="static" data-keyboard="false" data-backdrop="static" data-keyboard="false">
        <div class="" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDICION DE PRODUCTOS PREPARADOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span><i></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pre-scrollable" ><!--Incia contenedor tabla detalle productos R de Leon-->
                        <div id="DetScroll" style="height:25%;"><!--Incia contenedor tabla detalle productos R de Leon-->
                            <div id="listaProductoPreparado" class="table-responsive">
                            </div>
                        </div><!--Finaliza fila tabla productos detalle R de Leon-->
                    </div><!--Finaliza el contenedor scrollable detalle P-->
                    <div class="row">
                      <div class="col-sm-4">
                        <strong>Nombre</strong>
                      </div>
                      <div class="col-sm-4">
                        <strong>Descripción</strong>
                      </div>
                      <div class="col-sm-4">
                        <strong>Precio mayoreo</strong>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                         <input type="text" id="nombreProductoPreparado" class="form-control" placeholder="NOMBRE">
                      </div>
                      <div class="col-sm-4">
                        <input type="text" id="descripcionProductoPreparado" class="form-control" PLACEHOLDER="DESCRIPCION">
                      </div>
                      <div class="col-sm-4">
                        <input type="text" id="precioMayoreoProductoPreparado" class="form-control" PLACEHOLDER="PRECIO MAYOREO">
                      </div>
                    </div>
                </div>
                <hr style='margin-top: 5px; margin-bottom: 10px'>
                <div class="row" style='margin-bottom: 15px'>
                  <h5 class="modal-title" style='margin-left: 30px; margin-bottom: 10px; border-bottom: solid 1px gray'>Detalle de Producto Preparado</h5>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="pre-scrollable" >
                        <div id="detalleProductoPreparado" style="height:30%;">
                        </div>
                    </div>
                   </div>
                </div>

                <div class="col-md-12">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" id="btnEditProductoPreparado" onclick="edtProductoPreparado()">Actualizar</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
                <hr style='margin-top: 5px; margin-bottom: 10px'>
            </div>
        </div>
    </div>





</div>

</div>

