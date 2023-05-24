<link href="../../theme/css/select2.css" rel="stylesheet" type="text/css" />
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
          <div class="row"><!--Incia fila 1-->
              <div class="col-xs-3">
                <div class="panel panel-default">
                <form action="http://localhost/pollofrito/index.php/Compra_controller/comprar" name="formComprar" method="POST">
                <?php $usuario =$this->session->ID;  ?>
                  <select class="form-control" name="proveedor" id="proveedor">
                      <option></option>
                      <?php 
                        $proveedor=json_decode($proveedor, true);
                        foreach($proveedor as $prov){
                        echo "<option value=".$prov['idgs_proveedor'].">".$prov['nombre']."-".$prov['nit']."</option>";
                        }
                      ?>
                  </select>
                </div>
              </div>
              <div class="col-xs-3">
                <input class="form-control" type="date" name="fecha">
              </div>
              <div class="col-xs-3">
                <input class="form-control" type="text" name="numerocompra" placeholder="No. Compra">
              </div>
              <div class="col-xs-3">
              <input type="hidden"  value="<?php echo $usuario ?>" name="usuario" ">
    <button type="submit" class="btn btn-info" value="formComprar" ><i class="fa fa-plus-square" aria-hidden="true"></i> Empezar</button>
     
              </div>
            </form>
          </div> <!--Finaliza fila 1--> 
    </div><!--Final panel-->
    
  </div>
<!--</div>-->
<script type="text/javascript">

$(document).ready(function () {


    $('#tabla3').DataTable( {
        lengthChange: false,
        language: {
                        processing:     "Procesando...",
                        search:         "Buscar&nbsp;:",
                        lengthMenu:     "",

                        info:           "Del registro START al END de TOTAL Registros",
                        infoEmpty:      "Sin registros",
                        infoFiltered:   "",
                        infoPostFix:    "",
                        loadingRecords: "Cargando...",
                        zeroRecords:    "No se encontró ningún resultado",
                        emptyTable:     "Por el momento no se encuentran registros.",
                        paginate: {
                            first:      "Primero",
                            previous:   "Anterior",
                            next:       "Siguiente",
                            last:       "Último"
                        }
                    } 
    } );
 
});
   
</script>
<script src="../../theme/js/select2.min.js" type="text/javascript"></script>
<script>
  $(document).ready(function(){
    $('#proveedor').select2({
    placeholder: "Seleccione proveedor",
    allowClear: true,
    minimumInputLength: 2
    });
  });
</script>


<!-- ajax: {
          url: '/pollofrito/index.php/Asignacion_controller/vender',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }-->
   
    