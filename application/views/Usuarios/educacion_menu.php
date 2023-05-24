<style type="text/css">
.panel-group {
    margin-bottom: 0px !important;
}
.panel {
    margin-bottom: 0px !important;
}
</style>
<!--<div class="container" style="width: 100%">
<div class="container" s>

  <div class="row">  -->
  <div class="col-sm-2">
    
   <div class="panel panel-default">
        <div class="panel-body"><div style="text-align: center; font-weight: bold; color: 	#FF7F00;">MENÚ PRINCIPAL</div></div>
    </div>

<div class="panel-group" id="AccesoUno" style="display: none">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse1"><i class="fa fa-chevron-right" aria-hidden="true"></i> CONTACTOS</a>
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item"><a href="/pollofrito/index.php/Cliente_controller/ListarCliente">- Listar Clientes</a></li>
            <li class="list-group-item"><a href="/pollofrito/index.php/Proveedor_controller/ListarProveedor">- Listar Proveedores</a></li>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="panel-group" id="AccesoDos" style="display: none">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse2"><i class="fa fa-chevron-right" aria-hidden="true"></i> VENTA</a>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
          <ul class="list-group">
            <!--<li class="list-group-item"><a href="/pgsantiago/index.php/Asignacion_controller/empezarVenta">- Post</a></li>-->
              <!--<li class="list-group-item"><a href="/pollofrito/index.php/Asignacion_controller/empezarDetVent">- ventaDetalle</a></li>-->
              <li class="list-group-item"><a href="/pollofrito/index.php/Asignacion_controller/empezarDetVentTrans">- venta</a></li>
              <li class="list-group-item" ><a href="/pollofrito/index.php/Producto_controller/ConsultarProducto">- Consultar Producto</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel-group" id="AccesoTres" style="display: none">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse3"><i class="fa fa-chevron-right" aria-hidden="true"></i> COMPRA</a>
          </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item"><a href="/pollofrito/index.php/Compra_controller/empezarCompra">- Compra</a></li>
           
          </ul>
        </div>
      </div>
    </div>
    <div class="panel-group" id="AccesoCuatro" style="display: none">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse4"><i class="fa fa-chevron-right" aria-hidden="true"></i> PRODUCTO</a>
          </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse">
          <ul class="list-group">
             <li class="list-group-item"><a href="/pollofrito/index.php/Producto_controller/ListarProducto">- Listar Producto</a></li>
             <li class="list-group-item"><a href="/pollofrito/index.php/Menu_controller/empezarMenu">- Menu y Producto preparado</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel-group" id="AccesoCinco" style="display: none">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse5"><i class="fa fa-chevron-right" aria-hidden="true"></i> FACTURACIÓN</a>
          </h4>
        </div>
        <div id="collapse5" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item"><a href="/pollofrito/index.php/Facturacion_controller/ListarFactura">- Lista Facturación</a></li>
          </ul>
        </div>
      </div>
    </div>
     <div class="panel-group" id="AccesoSeis" style="display: none">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse6"><i class="fa fa-chevron-right" aria-hidden="true"></i> COMPRAS</a>
          </h4>
        </div>
        <div id="collapse6" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item"><a href="/pollofrito/index.php/Compra_controller/ListarCompra">- Lista Compras</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel-group" id="AccesoSiete" style="display: none">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse7"><i class="fa fa-chevron-right" aria-hidden="true"></i> REPORTES</a>
          </h4>
        </div>
        <div id="collapse7" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item" id="AcSiRpU" style="display: none"><a href="/pollofrito/index.php/Reportes_controller/ListarVentasReporte">- Reporte de ventas</a></li>
            <li class="list-group-item" id="AcSiRpUE" style="display: none"><a href="/pollofrito/index.php/Reportes_controller/ListarVentasReporteEmpleado">- Reporte de ventas por empleado</a></li>
            <li class="list-group-item" id="AcSiRpD" style="display: none"><a href="/pollofrito/index.php/Reportes_controller/ListarComprasReporte">- Reporte de compras</a></li>
            <li class="list-group-item" id="AcSiRpT" style="display: none"><a href="/pollofrito/index.php/Reportes_controller/ListarProductosReporte">- Reporte de inventario</a></li>
          </ul>
        </div>
      </div>
    </div>
      <div class="panel-group" id="AccesoOcho" style="display: none">
          <div class="panel panel-info">
              <div class="panel-heading">
                  <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse9"><i class="fa fa-chevron-right" aria-hidden="true"></i> CAJA</a>
                  </h4>
              </div>
              <div id="collapse9" class="panel-collapse collapse">
                  <ul class="list-group">
                      <li class="list-group-item"><a href="/pollofrito/index.php/Asignacion_controller/arqueoCaja">- Arqueo de caja</a></li>

                  </ul>
              </div>
          </div>
      </div>
      <div class="panel-group" id="AccesoNueve" style="display: none">
          <div class="panel panel-info">
              <div class="panel-heading">
                  <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse10"><i class="fa fa-chevron-right" aria-hidden="true"></i>DEVOLUCION</a>
                  </h4>
              </div>
              <div id="collapse10" class="panel-collapse collapse">
                  <ul class="list-group">
                      <li class="list-group-item"><a href="/pollofrito/index.php/Asignacion_controller/devolucionProd">- Devolucion Producto</a></li>
                      <li class="list-group-item"><a href="/pollofrito/index.php/Asignacion_controller/ListarDevolucion">- Lista Devolucion</a></li>
                  </ul>
              </div>
          </div>
      </div>
          <div class="panel-group" id="AccesoDiez" style="display: none">
              <div class="panel panel-info">
                  <div class="panel-heading">
                      <h4 class="panel-title">
                          <a data-toggle="collapse" href="#collapse8"><i class="fa fa-chevron-right" aria-hidden="true"></i> ADMINISTRAR ACCESOS</a>
                      </h4>
                  </div>
                  <div id="collapse8" class="panel-collapse collapse">
                      <ul class="list-group">
                          <li class="list-group-item"><a href="/pollofrito/index.php/Usuarios_controller/accUserPer">- Permisos</a></li>
                         <!-- <li class="list-group-item"><a href="/pollofrito/index.php/Usuarios_controller/portadaUsuario">- Usuarios</a></li>
                          <li class="list-group-item"><a href="/pollofrito/index.php/Usuarios_controller/portadaUsuario">- Personas</a></li>-->
                      </ul>
                  </div>
              </div>
          </div>

   </div>

