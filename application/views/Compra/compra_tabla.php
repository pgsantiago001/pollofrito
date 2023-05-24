<style>
    input[type="button"]:hover{
        background-color:slategray;
        cursor: pointer;
    }
    input[type="button"].arit{
        background-color:maroon;
    }
    input[type="button"].igual{
        background-color: green;
    }
    input[type="button"].clear{
        background-color:orangered;
    }
  
    form{
        background-color:white;
    }
    input[type="text"]{
        background-color:black;
        border:0px;
        width:250px;
        height: 40px;
        font-size: 20px;
        color: white;
        text-align: right;
        pointer-events: none;
    }
    input[name="txtcaja"]{
        margin-bottom: 5px;
        font-size: 26px;
    }
    input[name="txtcaja1"]{
        height: 20px;
        font-size: 16px;
    }
    input[name="txtcaja2"]{
        margin-bottom: 5px;
        font-size: 26px;
    }
    input[type="button"]{
        font-size: 18px;
        font-weight:lighter;
        font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, "sans-serif";
        width:60px;border:0px;
        height: 60px;
        color: white;
        background-color:blue;
        margin-bottom: 5px;
        }
    body{
        background-color:#f1f1f1;
    }
</style>
<br>
 <div class="scrollmenu">
 <table class="table" id="tabla4">
    <thead>
        <tr>
            <th>ID</th>
            <th>BARRAS</th>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>CANTIDAD</th>
            <th>CONTO/U</th>
            <th>SUBTOTAL</th>
            <th>Botones</th>
          </tr>
        </thead>
        <tbody>
         <?php $totales=0;  ?>
          <?php $productos=json_decode($productos, true);
                foreach ($productos as $key => $prod){ ?>

        <?php $total=0;
              $subtotal=0;
              $precio=0;

            $total= $prod['Cant'];
            $precio = $prod['PrecioC'];
            $subtotal = $total*$precio;


         ?>
          <tr>
            <td><?php echo $prod['id']; ?></td>
            <td><?php echo $prod['Barras'] ?></td>
            <td style="font-size: 90%;"><?php echo $prod['CODIGO']; ?></td>
            <td style="font-size: 90%;"><?php echo $prod['Nombre']; ?></td>
            <td style="font-size: 90%;"><?php echo $prod['Descripcion']; ?></td>
            <td style="font-size: 90%;"><?php echo $prod['Cant']; ?></td>
            <td style="font-size: 90%;"><?php echo $prod['PrecioC'] ?></td>
            <td style="font-size: 90%;"><?php echo $subtotal ?></td>
<td><button type="button" class="btn btn-default" onclick="BorrarProductoCompra(<?php echo $prod['id']; ?>,<?php echo $prod['Cant']; ?>,<?php echo $prod['CODIGO']; ?>,<?php echo $compra_id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
          </tr>
            <?php $totales=$totales+$subtotal; ?>
          <?php } ?>

        </tbody>
    </table>
    <div class=row>
        <div class="col-xs-3">
            <label>Total Item(s):</label>
        </div>
        <div class="col-xs-3">
            <label>5:</label>
        </div>
        <div class="col-xs-3">
            <label>Neto:</label>
        </div>
        <div class="col-xs-3">
            <label id="totalventa"><?php echo $totales; ?></label>
        </div>
    </div>
   <!-- <div class="row">
        <div class="col-xs-3">
            <label>Descuento (%):</label>
        </div>
        <div class="col-xs-3">
           <input type="text" name="impuesto" id="impuesto" onchange="subtotal();">
        </div>
        <div class="col-xs-3">
        </div>
        <div class="col-xs-3">
            <label id="totaldescuento"></label>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <label>IVA:</label>
        </div>
        <div class="col-xs-3">
            <select>
                <option>IVA</option>
                <option>Otro</option>
            </select>
        </div>
        <div class="col-xs-3">
            
        </div>
        <div class="col-xs-3">
         <label>1515</label>
    </div>
    </div>-->

    <div class="row">
        <div class="col-xs-3">
            
        </div>
        <div class="col-xs-3">
            
        </div>
        <div class="col-xs-3">
            
        </div>
        <div class="col-xs-3">
            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#pagarModal" value="0.00" >PAGAR</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pagarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
       <center>
      
<form name="f1" action="/pollofrito/index.php/Compra_controller/GenerarCompra" method="post" id="frmenviar">

 <!--<div class="list-group" name="tipopago" form="frmenviar">
  <a href="javascript:void(0)" value="Efectivo" id="cash" onclick="paymentType(1);" class="list-group-item active" >Efectivo</a>
  <a href="javascript:void(0)" value="Cheque"   id="check" onclick="paymentType(2);" class="list-group-item">Cheque</a>
  <a href="javascript:void(0)" value="Tarjeta"  id="card" onclick="paymentType(3);" class="list-group-item" >Tarjeta</a>
</div>-->
<select class="form-control" name="tipopago" form="frmenviar" required>
    <option>-Elija una Opción-</option>
    <option value="Efectivo">Efectivo</option>
    <option value="Cheque">Cheque</option>
    <option value="Tarejta">Tarjeta</option>
</select>
<input type="text" name="txtcaja" value="<?php echo $totales; ?>" form="frmenviar">
<input type="hidden" name="compra_id" value="<?php echo $compra_id; ?>" form="frmenviar">
<br>
<br>
<input type="text" name="txtcaja1">
<br>
<input type="text" name="txtcaja2" value="0">
<br>
<!--<input type="button" class="arit" onClick="arit('%')" value="%">
<input type="button" onClick="raiz()" value="√">
<input type="button" onClick="escribir('7')" value="x²">
<input type="button" onClick="escribir('7')" value="¹/×"> -->
<br>
<!--<input type="button" class="clear" onClick="document.f1.txtcaja2.value='0'" value="CE">-->
<input type="button" class="clear" onClick="document.f1.reset(); blocdel = false;" value="C">
<input type="button" class="clear" onClick="deletecarac()" value="◄">
 
<!--<input type="button" class="arit" onClick="arit('/')" value="÷">-->
<br>
<input type="button" onclick="escribir(this.value)" value="7">
<input type="button" onclick="escribir(this.value)" value="8">
<input type="button" onclick="escribir(this.value)" value="9">
<!--<input type="button" class="arit" onClick="arit('*')" value="×">-->
<br>
<input type="button" onclick="escribir(this.value)" value="4">
<input type="button" onclick="escribir(this.value)" value="5">
<input type="button" onclick="escribir(this.value)" value="6">
<!--<input type="button" class="arit" onClick="arit('-')" value="-">-->
<br>
<input type="button" onclick="escribir(this.value)" value="1">
<input type="button" onclick="escribir(this.value)" value="2">
<input type="button" onclick="escribir(this.value)" value="3">
<!--<input type="button" class="arit" onClick="arit('+')" value="+">-->
<br>
<!--<input type="button" class="arit" onClick="masmenos()" value="±">-->
<input type="button" onclick="escribir(this.value)" value="0">
<input type="button" onClick="escribir('.')" value=".">
<!--<input type="button" class="igual" onClick="cambio()" value="0.00">-->
<br>
<div class="col-xs-12">
    <input type="text" name="btnvuelto" id="btnvuelto" value="0"> 
</div><br>
<div class="row">
    <div class="col-xs-12">
<td><button class="btn-info btn-lg" type="submit"><span class="glyphicon glyphicon-floppy-disk" value="frmenviar"></span>
      </i>Confirmar</button></td>
    </form>
    </div>
</div>
</form>
</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

$(document).ready(function () {


    $('#tabla4').DataTable( {
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

<script>
    function subtotal(){
    
    var totals   = $('#totales').val();
    var numero = $('#impuesto').val();
 
    console.log(totals);
    console.log(numero);

    var totalcondescuento = numero*totals;
    totalcondescuento = parseFloat(totalcondescuento);
    
    $('#totaldescuento').html('el total es:"'+totalcondescuento+'"');
}
</script>

<script type="text/javascript">
    var borrar = false;
    function deletecarac(){
        var caja2 = document.f1.txtcaja2.value;
            if (caja2 == "" || caja2 == "0" || caja2.length == 1 && blocdel!=true){
                document.f1.txtcaja2.value = "0";
            }
            else if(blocdel!=true){
                var res = caja2.substring(0,caja2.length-1);
                document.f1.txtcaja2.value = res;
            }
    }
   function escribir(n){
        
       var caja   = document.f1.txtcaja.value;
       var caja2  = document.f1.txtcaja2.value;
     
        if (borrar) {
            //alert("se borro");
            document.f1.txtcaja2.value="";
            borrar = false;
            document.f1.txtcaja2.value = n;
            

            
        }
        else if (caja2 == "0" && n != "."){
            cajao = caja2.replace("0", "")
            document.f1.txtcaja2.value = cajao + n;
            document.f1.btnvuelto.value = eval((caja0 + n) - caja);
            
        }
        else{
            document.f1.txtcaja2.value = caja2 + n;
            document.f1.btnvuelto.value = eval((caja2 + n) - caja);
        }
    }

    function cambio(){
        var caja   = document.f1.txtcaja.value;
        var caja2  = document.f1.txtcaja2.value;
        var vuelto = caja2 - caja; 
        document.f1.btnvuelto.value = vuelto;
        document.f1.btnvuelto.value = "";
        console.log(caja2);
    }
    //function raiz(){
    //    var caja1 = document.f1.txtcaja1.value;
    //    var caja2 = document.f1.txtcaja2.value;
    //    document.f1.txtcaja1.value = "Math.sqrt("+ caja2 + caja1 +")";
    //    document.f1.txtcaja2.value = "";
    //}
    //function arit(o){
    //    var caja1 = document.f1.txtcaja1.value;
    //    var caja2 = document.f1.txtcaja2.value;
    //   var unum = caja1.substring(caja1.length-1);
    //   calcular()
    //    if (unum == "+" || unum == "-" || unum=="*" || unum=="/") {
    //        unum = unum.replace(unum,o);
    //        var res = caja1.substring(0,caja1.length-1);
    //      document.f1.txtcaja1.value = res+unum;
    //   }
    //    if (caja1 == "" && caja2 != ""){
    //        document.f1.txtcaja1.value = caja2 + o;
    //    }
    //    else{
    //        document.f1.txtcaja1.value = caja1 + caja2 + o;
    //    }
    //    borrar = true;
    //}

    //function calcular(){
    //    var caja1 = document.f1.txtcaja1.value;
    //    var caja2 = document.f1.txtcaja2.value;
    //    document.f1.txtcaja2.value = eval(caja1 + caja2);
    //    document.f1.txtcaja1.value = "";
    //    borrar = true;
    //    blocdel = true;
    //}
    //function masmenos(){
    //    var caja2 = document.f1.txtcaja2.value;
    //    if (caja2 > 0){
    //        document.f1.txtcaja2.value = "(-" + caja2 + ")";
    //    }
    //    else{
    //        cajaplus = caja2.replace(/[-|(|)]/g, "");
    //       document.f1.txtcaja2.value = cajaplus;
    //    }
   // }
</script>
<script type="text/javascript">
    
        function modalPago(value){ 

            var totalModal =$("#payablePrice").val(value);
                
        }


        function paymentType(payment)
        {
            var paymentType =1;

            switch (payment){
                  case 1:
                    $('#cash').addClass('active');
                    $('#check').removeClass('active');
                    $('#card').removeClass('active');                   
                    paymentType=1;
                     //console.log(paymentType);
                    break;
                     case 2:
                    $('#check').addClass('active');
                    $('#cash').removeClass('active');
                    $('#card').removeClass('active');
                    // console.log(paymentType);
                    paymentType=2;
                    // console.log(paymentType);
                    break;

                      case 3:
                    $('#card').addClass('active');
                    $('#cash').removeClass('active');
                    $('#check').removeClass('active');
                    // console.log(paymentType);
                    paymentType =3;
                    // console.log(paymentType);
                    break;
            }

            type = $('#typeDocument').val(paymentType);
        }
    
</script>