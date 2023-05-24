<style type="text/css">
  
.panel-group {
    margin-bottom: 0px !important;
}

.panel {
    margin-bottom: 0px !important;
}


</style>
<div class="container" style="width: 100%">
  <div class="row"> 
  <div class="col-sm-12">
    <div class="panel panel-success">
        <div class="panel-body" style="text-align: left;">
              <div class="text-center">
      <h2  class="text-info"><span class="glyphicon"></span> BIENVENIDOS POLLO FRITO POR SU POLLO</h2> 
      <h5  class="text-info"><span class="glyphicon glyphicon-shopping-cart"></span> SISTEMA DE INVENTARIO "PGSANTIAGO"</h5>  
       
    </div>
          <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#ficha" data-toggle="tab"> Descripción </a>
                    </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade active in" id="ficha">
                    <br>
                    <div class="panel panel-primary" style="width: 100%;">
                <div class="panel-heading"><h4><div style="font-weight: bold;">Descripción del sistema</div></h4></div>
                <div class="panel-body">
                    <p>En el sistema podrá realizar procesos básicos para poder llevar el control de su tienda, controlando los productos que se vendarán así mismo como los productos que comprará, sabiendo exactamente el inventario con el que cuenta.
                    </p>
                    <br>        
                     </div>
                     </div> 
                  </div>
                </div>

        </div>

      </div>

    </div>
    
  </div>
</div>
<!-- Modal para registrar al usuario -->
<div id="RegUsuarios" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registro de Usuarios</h4>
            </div>
            <div class="modal-body">
                    <div class="container">
                        <div id="idUser" style="display: none"></div>
                        <div id="frmPersona">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="uname"><b>Nombre</b></label>
                                    <input class="form-control" id="txtNombUsr" type="text" placeholder="Ingrese su nombre"  required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="psw"><b>Direccion</b></label>
                                    <input class="form-control" id="txtDirecUsr" type="text" placeholder="ingrese su direccion"  required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="psw"><b>Dpi</b></label>
                                    <input class="form-control" id="txtDpiUsr" type="text" placeholder="ingrese su dpi"  required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="psw"><b>Telefono</b></label>
                                    <input class="form-control" id="txtTelUsr" type="text" placeholder="ingrese su telefono"  required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <button class="btn btn-success" onclick="RegPer();">Registrarse</button>
                            </div>
                         </div>
                        </div>

                        <div id="UsrPass" style="display: none">
                          <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="psw"><b>Usuario</b></label>
                                    <input class="form-control" id="UserLog" type="text" placeholder="ingrese usuario"  required>
                                </div>
                            </div>
                          </div>
                            <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="psw"><b>Contraseña</b></label>
                                    <input class="form-control" id="passLog" type="password" placeholder="ingrese contraseña"  required>
                                </div>
                            </div>
                          </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <button class="btn btn-success" onclick="UsrPssw();">Guardar usuario y contraseña</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Fin Modal Registro de usuario-->
<div class="text-center">
    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#RegUsuarios"><h4><span class="text-muted"> Registrarse</span></h4></button>
 </div>