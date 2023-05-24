<style type="text/css">
.panel-group {
    margin-bottom: 0px !important;
}
.panel {
    margin-bottom: 0px !important;
}
</style>
<div class="col-sm-4" >
  <div class="panel panel-success">
    <div class="panel-body"><div style="text-align: center; font-weight: bold; color: #326f8e;">DATOS DEL EMPLEADO</div>
        </div>
    <div class="col-sm-2">
      <strong>
      <span class="form-control" style="border: none;">Nombre:</span> 
      <span class="form-control" style="border: none;">Direccion:</span> 
      <span class="form-control" style="border: none;">Telefono:</span> 
      </strong>
    </div>
    <div class="col-md-4">
      <input type="text" readonly class="form-control"  id="idUser" name="idUser" value="<?php echo $this->session->ID ?>" style="display:none;"></input>
      <input type="text" readonly class="form-control" value="<?php echo $this->session->Nombre ?>"></input>
      <input type="text" readonly class="form-control" value="<?php echo $this->session->Direccion ?>"></input>
      <input type="text" readonly class="form-control" value="<?php echo $this->session->Telefono ?>"></input>
      <strong> 
    </div>
  </div>
</div>

  
  <div class="col-sm-8">
   <div class="panel panel-success">
      <div class="panel-body" style="text-align: left;">
        <div class="text-center">
      <h3  class="text-info"><span class="glyphicon glyphicon-shopping-cart"></span> SISTEMA DE FACTURACIÓN "pgsantiago" </h3>  
       <div class="panel-heading"  class=" p-3 mb-2 bg-primary text-white">
                      <div class="col-md-12"><!--Incia contenedor tabla detalle productos R de Leon-->
                              <div class="pre-scrollable" style="height:100%;">
                          <div id="listaSucursal">
                          </div>
                      </div><br>
                      </div>
                     </div>
    </div>    
      </div>
    </div>     
    </div>
    <script type="text/javascript">
    function SucursalesUsuario() {
    var idUsrLg = $("#idUser").val();
    var value = {
        'idUsrLg': idUsrLg
    };
    $.ajax({
        url:"http://localhost/pollofrito/index.php/Usuarios_controller/ObtSucursales",
        // async:false,
        type:'POST',
        data: value,
    }).done(function(resp){
        if (resp != "0")
        {
            var valores = eval(resp);
            html="<table class='table table-hover' id='tblTableSucursal'><thead><tr><th>ID</th><th>SUCURSAL</th><th>OPCION</th></tr></thead><tbody>";
            for(i=0;i<valores.length;i++){
                var idImp = valores[i]['ID'];
                html+="<tr><td>"+valores[i]['ID']+"</td><td>"+valores[i]['Empresa']+"</td><td ><a class='nav-link opc_ingresarsistema' id='" + i + "'> ACCEDER</a></td></tr>";
            }
            html+="</tbody></table>"
            $("#listaSucursal").html(html);
        }
        else {
            swal({ title: "No se encontraron ", text: "datos..!", type: "warning", timer: 900 });
        }

    });
}

window.onload=SucursalesUsuario();
</script>