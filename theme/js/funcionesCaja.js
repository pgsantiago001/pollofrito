function datosArqueoCaja () {
    var value = {
        'fechaU':  $("#fechaUno").val(),
        'fechaD':  $("#fechaDos").val()
    };
    $.ajax({
        url:"http://localhost/pollofrito/index.php/Asignacion_controller/listVentasDiar",
        type:'POST',
        data:value,
    }).done(function(resp){
        if (resp != "0")
        {
            var valores = eval(resp);
            html="<table class='table table-hover' id='TablaPagos'><thead><tr><th>No. Comprobante</th><th>Fecha</th><th>Metodo pago</th><th>Total</th><th>Descuento</th><th>Imprimir</th></tr></thead><tbody>";
            for(i=0;i<valores.length;i++){
                var idImp = valores[i]['NoFactura'];
                html+="<tr><td>"+valores[i]['NoFactura']+"</td><td>"+valores[i]['Fecha']+"</td><td>"+valores[i]['metododepago']+"</td><td>"+valores[i]['total']+"</td><td>"+valores[i]['descuento']+"</td><td ><a class='nav-link opc_reimprimir' id='" + i + "'> imprimir</a></td></tr>";
            }
            html+="</tbody></table>"
            $("#listaVentUno").html(html);
        }
        else {
            swal({ title: "No se encontraron ", text: "datos..!", type: "warning", timer: 900 });
        }
    });
}
function datosListaDev () {
    var value = {
        'fechaU':  $("#fechaUno").val(),
        'fechaD':  $("#fechaDos").val()
    };
    $.ajax({
        url:"http://localhost/pollofrito/index.php/Asignacion_controller/listDevol",
        type:'POST',
        data:value,
    }).done(function(resp){
        if (resp != "0")
        {
            var valores = eval(resp);
            html="<table class='table table-hover' id='TablaPagos'><thead><tr><th>No. Comprobante</th><th>Fecha</th><th>Comentario</th><th>Monto Dif.</th><th>Comprobante Ant</th><th>Ver Comprobantes</th></tr></thead><tbody>";
            for(i=0;i<valores.length;i++){
                html+="<tr><td>"+valores[i]['NoFactura']+"</td><td>"+valores[i]['FechaHora']+"</td><td>"+valores[i]['ComentarioDev']+"</td><td>"+valores[i]['MontoDiferencia']+"</td><td>"+valores[i]['FactAnt']+"</td><td ><a class='nav-link ImpCompDev' id='" + i + "'> ver</a></td></tr>";
            }
            html+="</tbody></table>"
            $("#listaVentUno").html(html);
        }
        else {
            swal({ title: "No se encontraron ", text: "datos..!", type: "warning", timer: 900 });
        }
    });
}
function datosArqueoCajaDiv() {
    var value = {
        'fechaU':  $("#fechaUno").val(),
        'fechaD':  $("#fechaDos").val()
    };
    $.ajax({
        url:"http://localhost/pollofrito/index.php/Asignacion_controller/listVentasDiv",
        type:'POST',
        data:value,
    }).done(function(resp){
        if (resp != "0")
        {
            var valores = eval(resp);
            html="<table class='table table-hover' id='TablaPagosDivi'><thead><tr><th>No. Comprobante</th><th>Fecha</th><th>Metodo pago</th><th>Monto</th></tr></thead><tbody>";
            for(i=0;i<valores.length;i++){
                html+="<tr><td>"+valores[i]['NoFactura']+"</td><td>"+valores[i]['fecha']+"</td><td>"+valores[i]['DescPago']+"</td><td>"+valores[i]['monto']+"</td></tr>";
            }
            html+="</tbody></table>"
            $("#listaVentDos").html(html);
            calcularTiposPago();
            calcularTiposPagoDiv();
            calcularTotales();
            setTimeout(SumTotalesTot(),600);
            setTimeout(SumTotalesSD(),600);
            $("#CentCinco").focus();
        }
        else {
            swal({ title: "No se encontraron ", text: "datos..!", type: "warning", timer: 900 });
        }
    });
}
function calcularTiposPago(){
    var filas=document.querySelectorAll("#TablaPagos tbody tr");
    var SumEfectivo=0;
    var SumTarjeta=0;
    var SumCheque=0;
    var SumDescuentos = 0;
    filas.forEach(function(e){
        var columnas=e.querySelectorAll("td");
        var TipoPago = columnas[2].textContent;
        var TotEfec = parseFloat(columnas[3].textContent);
        var TotDesc = columnas[4].textContent;
        if(TipoPago == "Efectivo" || TipoPago == "Efectivo*"){
            SumEfectivo+=TotEfec;
        }
        else if (TipoPago == "Tarjeta" || TipoPago == "Tarjeta*"){
            SumTarjeta+=TotEfec;
        }
        else if (TipoPago == "Cheque" || TipoPago == "Cheque*"){
            SumCheque+=TotEfec;
        }
        if (TotDesc == 'null') {

            SumDescuentos+=0;
        }
        else if(TotDesc != 'null') {
            SumDescuentos+=parseFloat(TotDesc);
        }
    });
    $("#TotEfect").html(SumEfectivo.toFixed(2));
    $("#TotTarj").html(SumTarjeta.toFixed(2));
    $("#TotCheque").html(SumCheque.toFixed(2));
    $("#TotDesc").html(SumDescuentos.toFixed(2));
}
//codigo funcional para arqueo denominaciones
function calcularDenom(){
    var filas=document.querySelectorAll("#tblDenom tbody tr");
    var SumDen=0;
    filas.forEach(function(e){
        var columnas=e.querySelectorAll("td");
        var MontD = parseFloat(columnas[1].textContent);
        SumDen+=MontD;
    });
    $("#arqDen").html(SumDen.toFixed(2));
}
function calcularTiposPagoDiv(){
    var filas=document.querySelectorAll("#TablaPagosDivi tbody tr");
    var SumEfectivo=0;
    var SumTarjeta=0;
    var SumCheque=0;
    filas.forEach(function(e){
        var columnas=e.querySelectorAll("td");
        var TipoPago = columnas[2].textContent;
        var TotEfec = parseFloat(columnas[3].textContent);
        if(TipoPago == "Efectivo"){
            SumEfectivo+=TotEfec;
        }
        else if (TipoPago == "Tarjeta"){
            SumTarjeta+=TotEfec;
        }
        else if (TipoPago == "Cheque"){
            SumCheque+=TotEfec;
        }
    });
    $("#TotEfectDiv").html(SumEfectivo.toFixed(2));
    $("#TotTarjDiv").html(SumTarjeta.toFixed(2));
    $("#TotChequeDiv").html(SumCheque.toFixed(2));
}
function calcularTotales(){
    var Efectivo = $("#TotEfect").text();
    var EfectivoDiv = $("#TotEfectDiv").text();
    var TotEfec = parseFloat(Efectivo) + parseFloat(EfectivoDiv);
    var Tarje = $("#TotTarj").text();
    var TarjeDiv = $("#TotTarjDiv").text();
    var TotTarje = parseFloat(Tarje) + parseFloat(TarjeDiv);
    var Cheque = $("#TotCheque").text();
    var ChequeDiv = $("#TotChequeDiv").text();
    var TotCheque = parseFloat(Cheque) + parseFloat(ChequeDiv);
    $("#TotEfectDivT").html(TotEfec);
    $("#TotTarjDivT").html(TotTarje);
    $("#TotChequeDivT").html(TotCheque);
}
function SumTotalesTot() {
    var TotCD = parseFloat($("#TotEfectDivT").text())+parseFloat($("#TotTarjDivT").text())+parseFloat($("#TotChequeDivT").text())+parseFloat($("#TotDesc").text());
    $("#TotCD").html(TotCD.toFixed(2));
}
function SumTotalesSD() {
    var TotSD = parseFloat($("#TotEfectDivT").text())+parseFloat($("#TotTarjDivT").text())+parseFloat($("#TotChequeDivT").text());
    $("#TotSD").html(TotSD.toFixed(2));
}
function TotalGastos() {
    var filas=document.querySelectorAll("#tblGsto tbody tr");
    var SumGasto=0;
    filas.forEach(function(e){
        var columnas=e.querySelectorAll("td");
        var MontG = parseFloat(columnas[1].textContent);
        SumGasto+=MontG;
    });
    $("#TotGsto").html(SumGasto.toFixed(2));
}
function TotLiquido() {
    var TotLiq = parseFloat($("#VtaEfectivo").text())-parseFloat($("#TotGsto").text());
    $("#TotLiq").html(TotLiq.toFixed(2));
}
function ArquePdfPrint() {
    var pdf = new jsPDF('p', 'pt', 'legal');

    var content = document.getElementById('commentCorCaja');
    source = $('#imprimir')[0];

    specialElementHandlers = {
        '#bypassme': function(element, renderer) {
            return true
        }
    };
    margins = {
        top: 0,
        bottom: 10,
        left: 40,
        width: 500
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.setFontSize(5);
    pdf.fromHTML(
        source,// HTML string or DOM elem ref.
        //pdf.text(20, 20, dto.value),

        margins.left, // x coord
        margins.top, {// y coord
            'width': margins.width, // max width of content on PDF
            'elementHandlers': specialElementHandlers
        },

        function(dispose) {
            // dispose: object with X, Y of the last line add to the PDF
            //          this allow the insertion of new lines after html

            pdf.text(40, 20, content.value);
            pdf.save('dataurlnewwindow');
        }
        , margins);
}
function addArqueoCent() {
    var Den = $('#selectDenom').val();
    var MontoDen = $('#montoDen').val();
    $('#btnTotGast').focus();
    var i = 1;
    var fila = '<tr id="row' + Den + '"><td >' + Den + '</td><td>' + MontoDen + '</td></tr>'; //esto seria lo que contendria la fila
    //var fila = '<tr id="row' + i + '"><td>' + codProd + '</td><td>' + BarrasProd + '</td><td>' + NomProd + '</td><td>' + DescProd + '</td><td>' + CantProd + '</td><td>' + PreUProd + '</td><td class="subtotal">' + TotalProd + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila
    i++;
    $('#tblDenom tbody').append(fila);
    $('#montoDen').val('');
    $('#selectDenom').focus();
}
function addEfectCaja() {
    var MontoEfectiv = $('#montoDen').val();
    document.getElementById('VtaEfectivo').innerHTML = MontoEfectiv;
}
function addGastoMont() {
    var DscGasto = $('#DescGasto').val();
    var MontoGsto = $('#montoGasto').val();
    $('#btnAdGsto').focus();
    var i = 1;
    var fila = '<tr id="row' + DscGasto + '"><td >' + DscGasto + '</td><td>' + MontoGsto + '</td></tr>'; //esto seria lo que contendria la fila
    //var fila = '<tr id="row' + i + '"><td>' + codProd + '</td><td>' + BarrasProd + '</td><td>' + NomProd + '</td><td>' + DescProd + '</td><td>' + CantProd + '</td><td>' + PreUProd + '</td><td class="subtotal">' + TotalProd + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila
    i++;
    $('#tblGsto tbody').append(fila);
    $('#DescGasto').val('');
    $('#montoGasto').val('');
    $('#DescGasto').focus();
}
/*
function addEfectivo() {
    var MontoEfec = $('#montoEfectivo').val();
   // $('#btnAdEfectivo').focus();
    var i = 1;
    var fila = '<tr id="row' + MontoEfec + '"><td>' + MontoEfec + '</td></tr>'; //esto seria lo que contendria la fila
    //var fila = '<tr id="row' + i + '"><td>' + codProd + '</td><td>' + BarrasProd + '</td><td>' + NomProd + '</td><td>' + DescProd + '</td><td>' + CantProd + '</td><td>' + PreUProd + '</td><td class="subtotal">' + TotalProd + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila
    i++;
    $('#tblEfectivo tbody').append(fila);
    $('#montoEfectivo').val('');
    $('#montoEfectivo').focus();
}*/
function DifDevolucion() {
    var MontDev = $("#txtTotDev").text();
    var MontActual = $("#txtTotFinal").text();
    var Total = parseFloat(MontActual) - parseFloat(MontDev);
    $("#DifDev").html(Total.toFixed(2));
}


//funciones para los comandos Roberto de Leon --fin
//en esta carpeta se agrego la libreria mousetrap.min.js