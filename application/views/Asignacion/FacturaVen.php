<style type="text/css">
    td,
    th,
    tr,
    table {
        border-bottom: 1px solid black;
        border-bottom-style: dashed;
        border-collapse: collapse;
        font-size: 7px;
    }

    td.producto,
    th.producto {
        text-align: center;
        width: 2.5cm;
        max-width: 2.5cm;
    }

    td.cantidad,
    th.cantidad {
        width: 0.75cm;
        max-width: 0.75cm;
        word-break: break-all;
    }

    td.precio,
    th.precio {
        width: 1cm;
        max-width: 1cm;
        word-break: break-all;
        text-align: right;
    }

    .titulo {
        text-align: center;
        align-content: center;
        font-size: 14px;
        font-weight: bold;
    }
.centrado {
        text-align: center;
        align-content: center;
        font-size: 10px;
    }
	
.final {
        text-align: center;
        align-content: center;
        font-size: 8px;
		white-space: nowrap
    }
	

    .ticket {
        width: 4.5cm;
        max-width: 4.5cm;
    }
    .total {
        width: 4.5cm;
        max-width: 4.5cm;
        text-align: right;
        border-top-style: none;
        border-top: 0px solid black;
        font-size: 10px;
    }
.encabezado {
        width: 4.5cm;
        max-width: 4.5cm;
        text-align: left;
        font-size: 9px;
    }

</style>

<script>

    var idImp = $("#NoImpFac").text();
    setTimeout(window.onload=DetalleFact(idImp),800);
    setTimeout(window.onload=EncabezadoFact(idImp),800);

</script>
<div class="ticket">
    <p class="titulo" style="f">POR SU POLLO</p><br><br>
    <p class="centrado"> 21 Avenida 1-66 Zona 3, QUETZALTENANGO </p><br><br>

    <div class="encabezado">
                 <span>FECHA: </span> <span id="Fecha"></span><br>
                 <span>BOLETA COMPRA </span> <span id="NoCompra"></span><br>
                 <span>NOMBRE: </span> <span id="Nombre"></span ><br>
                 <span>NIT. </span> <span id="Nit"></span><br>
                 <span>DIRECCION. </span> <span id="Direccion"></span><br><br>
    </div>
    <table>
    <div id="lista">
     </div><br>
     <div id="listaDetalleMenu">
     </div><br>
     <div class="total">
                 <span>SUBTOTAL Q. </span> <span id="subTotal"></span><br>
                 <span>DESCUENTO Q. </span> <span id="Descuento"></span><br>
                 <span>TOTAL Q. </span> <span id="Total"></span><br>
     </div>
    <p class="centrado">¡GRACIAS POR TU COMPRA</p>
	<span class="final">El mejor sabor.! </span>
     <!--<span class="final">y tecnología.!</span>-->
</div>

