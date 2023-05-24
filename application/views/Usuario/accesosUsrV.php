<div class="col-sm-10">

        <div class="row">
            <h4 class="text-muted">Acceso a usuarios</h4>
         </div>
        <div class="row"><!--Incia fila titulo busqueda productos R de Leon-->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista Usuarios
                        <button type="button" class="btn btn-link" onclick="UsuarioLoadAcc();"> <span>Ver usuarios</span> </button>
                    </div>
                    <div class="panel-body">
                        <div class="pre-scrollable">
                            <div id="lstaUsr" style="height: 20%;">

                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>

       <!--finaliza row titulo busqueda productos R de Leon-->

      <div class="row"><!--inicia row inputs busqueda productos R de Leon-->
        <div class="col-md-12">
         <div class="panel panel-default">
         <div class="panel-heading">Asignar o quitar accesos <br>
             <strong class="align-center">Usuario:</strong> <strong id="userLog" class="text-info"></strong><input type="text" id="IduserLog" style="display: none">
         </div>
         <div class="panel-body">
             <div class="row">
            <div class="col-md-2">
                <div class="alert alert-success" role="alert">
                    <strong>CONTACTOS</strong>
                    <p>Ver clientes y contactos</p>
                    <span class="glyphicon glyphicon-user"></span><input type="checkbox"  class="chAcUno" id="chAcUno" name="chAcUno">
                </div>
            </div>
             <div class="col-md-2">
                 <div class="alert alert-info" role="alert">
                     <strong>VENTA</strong>
                     <p>Realizar ventas</p>
                     <span class="glyphicon glyphicon-barcode"></span> <input type="checkbox" id="chAcDos">
                 </div>
            </div>
             <div class="col-md-2">
                 <div class="alert alert-success" role="alert">
                     <strong>COMPRA</strong>
                     <p>Realizar compras</p>
                     <span class="glyphicon glyphicon-shopping-cart"></span> <input type="checkbox" id="chAcTres">
                 </div>
             </div>

             <div class="col-md-2">
                 <div class="alert alert-info" role="alert">
                     <strong>PRODUCTO</strong>
                     <p>Agregar y listar prod.</p>
                     <span class="glyphicon glyphicon-indent-left"></span> <input type="checkbox" id="chAcCuatro">
                 </div>

             </div>
             <div class="col-md-2">
                 <div class="alert alert-success" role="alert">
                     <strong>Facturacion</strong>
                     <p>Ver facturas.</p>
                     <span class="glyphicon glyphicon-align-justify"></span> <input type="checkbox" id="chAcCinco">
                 </div>
            </div>
             <div class="col-md-2">
                 <div class="alert alert-info" role="alert">
                     <strong>COMPRAS</strong>
                     <p>Ver compras.</p>
                     <span class="glyphicon glyphicon-list-alt"></span> <input type="checkbox" id="chAcSeis">
                 </div>
            </div>
        </div>
             <div class="row">
                 <div class="col-md-2">
                     <div class="alert alert-info" role="alert">
                         <strong>Reportes</strong><br>
                         <span>Ver reportes</span><input type="checkbox"  class="align-center" id="chAcSiete"><br>
                         <span>Reporte de ventas  </span> <input type="checkbox"  id="chAcRepVen"><br>
                         <span>Reporte de ventas empleado  </span> <input type="checkbox"  id="chAcRepVenE"><br>
                         <span>Reporte de compras  </span> <input type="checkbox" id="chAcRepCom"><br>
                         <span>Reporte de inventario  </span> <input type="checkbox" id="chAcRepInv">
                         <br> <span class="glyphicon glyphicon-file"></span>
                     </div>
                 </div>
                 <div class="col-md-2">
                     <div class="alert alert-success" role="alert">
                         <strong>Caja</strong>
                         <p>Arqueo de caja</p>
                         <span class="glyphicon glyphicon-inbox"></span> <input type="checkbox" id="chAcOcho">
                     </div>
                 </div>
                 <div class="col-md-2">
                     <div class="alert alert-info" role="alert">
                         <strong>Devolucion</strong>
                         <p>Realizar y listar Dev.</p>
                         <span class="glyphicon glyphicon-copy"></span> <input type="checkbox" id="chAcNueve">
                     </div>
                 </div>
                <div class="col-md-2" style="display: none" id="AccVerUsr">
                     <div class="alert alert-success" role="alert">
                         <strong>Accesos</strong>
                         <p>Admin. Accesos</p>
                         <span class="glyphicon glyphicon-tasks"></span> <input type="checkbox" id="chAcDiez">
                     </div>
                 </div>

             </div>


        </div>
        </div>
        </div>
     </div>
      <!--finaliza row titulo inputs busqueda productos R de Leon-->


</div>
