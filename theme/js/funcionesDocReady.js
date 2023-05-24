//funciones para los comandos Roberto de Leon --inicio
$(document).ready(function () {
  // verificar();

  $("#txtNit").focus();
  $("#txtId").val("1");
  $("#txtNit").val("C/F");
  $("#txtNombreCl").val("C/F");
  $("#txtDirec").val("Ciudad");
  $("#txtNit").keypress(function (e) {
    if (e.which == 13) {
      //document.getElementById("btnEmpD").focus();
      $("#btnEmpD").focus();
    }
  });
  $("#txtDirec").keypress(function (e) {
    if (e.which == 13) {
      $("#BtnNuevoCL").focus();
    }
  });

  $("#txtBusqueda").keypress(function (e) {
    if (e.which == 13) {
      $("#txtCantP").focus();
    }
  });

  $("#txtBusqueda").on("keyup", function (evt) {
    if (evt.keyCode == 27) {
      $("#txtDescuen").focus();
    }
  });
  $("#txtCantP").keypress(function (e) {
    if (e.which == 13) {
      document.getElementById("btnAgrProd").focus();
      $("#btnAgrProd").focus();
    }
  });
  $("#txtDescuen").keypress(function (e) {
    if (e.which == 13) {
      $("#txtEfectivo").focus();
    }
  });
  $("#txtEfectivo").keypress(function (e) {
    if (e.which == 13) {
      $("#FacturaSend").focus();
    }
  });

  $("#TotAl").keypress(function (e) {
    if (e.which == 13) {
      $("#TotTrans").focus();
    }
  });
  $("#TotTrans").keypress(function (e) {
    if (e.which == 13) {
      $("#TotOtPagos").focus();
    }
  });
  $("#TotOtPagos").keypress(function (e) {
    if (e.which == 13) {
      $("#btnArqDen").focus();
    }
  });
  $("#flgUno").text(function () {
    if ($("#flgUno").text() == "1") {
      $("#AccesoUno").css("display", "block");
    } else {
      $("#AccesoUno").css("display", "none");
    }
  });
  $("#flgDos").text(function () {
    if ($("#flgDos").text() == "1") {
      $("#AccesoDos").css("display", "block");
    } else {
      $("#AccesoDos").css("display", "none");
    }
  });
  $("#flgTres").text(function () {
    if ($("#flgTres").text() == "1") {
      $("#AccesoTres").css("display", "block");
    } else {
      $("#AccesoTres").css("display", "none");
    }
  });
  $("#flgCuatro").text(function () {
    if ($("#flgCuatro").text() == "1") {
      $("#AccesoCuatro").css("display", "block");
    } else {
      $("#AccesoCuatro").css("display", "none");
    }
  });
  $("#flgCinco").text(function () {
    if ($("#flgCinco").text() == "1") {
      $("#AccesoCinco").css("display", "block");
    } else {
      $("#AccesoCinco").css("display", "none");
    }
  });
  $("#flgSeis").text(function () {
    if ($("#flgSeis").text() == "1") {
      $("#AccesoSeis").css("display", "block");
    } else {
      $("#AccesoSeis").css("display", "none");
    }
  });
  $("#flgSiete").text(function () {
    if ($("#flgSiete").text() == "1") {
      $("#AccesoSiete").css("display", "block");
    } else {
      $("#AccesoSiete").css("display", "none");
    }
  });
  $("#flgOcho").text(function () {
    if ($("#flgOcho").text() == "1") {
      $("#AccesoOcho").css("display", "block");
    } else {
      $("#AccesoOcho").css("display", "none");
    }
  });
  $("#flgNueve").text(function () {
    if ($("#flgNueve").text() == "1") {
      $("#AccesoNueve").css("display", "block");
    } else {
      $("#AccesoNueve").css("display", "none");
    }
  });
  $("#flgDiez").text(function () {
    if ($("#flgDiez").text() == "1") {
      $("#AccesoDiez").css("display", "block");
    } else {
      $("#AccesoDiez").css("display", "none");
    }
  });
  $("#RepVen").text(function () {
    if ($("#RepVen").text() == "1") {
      $("#AcSiRpU").css("display", "block");
    } else {
      $("#AcSiRpU").css("display", "none");
    }
  });
  $("#RepVenE").text(function () {
    if ($("#RepVenE").text() == "1") {
      $("#AcSiRpUE").css("display", "block");
    } else {
      $("#AcSiRpUE").css("display", "none");
    }
  });
  $("#RepCom").text(function () {
    if ($("#RepCom").text() == "1") {
      $("#AcSiRpD").css("display", "block");
    } else {
      $("#AcSiRpD").css("display", "none");
    }
  });
  $("#RepInv").text(function () {
    if ($("#RepInv").text() == "1") {
      $("#AcSiRpT").css("display", "block");
    } else {
      $("#AcSiRpT").css("display", "none");
    }
  });
  $("#chAcUno").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcUno", "1");
    } else {
      ActualizarAcLog("AcUno", "0");
    }
  });
  $("#chAcDos").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcDos", "1");
    } else {
      ActualizarAcLog("AcDos", "0");
    }
  });
  $("#chAcTres").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcTres", "1");
    } else {
      ActualizarAcLog("AcTres", "0");
    }
  });
  $("#chAcCuatro").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcCuatro", "1");
    } else {
      ActualizarAcLog("AcCuatro", "0");
    }
  });
  $("#chAcCinco").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcCinco", "1");
    } else {
      ActualizarAcLog("AcCinco", "0");
    }
  });
  $("#chAcSeis").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcSeis", "1");
    } else {
      ActualizarAcLog("AcSeis", "0");
    }
  });
  $("#chAcSiete").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcSiete", "1");
    } else {
      ActualizarAcLog("AcSiete", "0");
    }
  });
  $("#chAcRepVen").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("RepVen", "1");
    } else {
      ActualizarAcLog("RepVen", "0");
    }
  });
  $("#chAcRepVenE").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("RepVenE", "1");
    } else {
      ActualizarAcLog("RepVenE", "0");
    }
  });
  $("#chAcRepCom").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("RepCom", "1");
    } else {
      ActualizarAcLog("RepCom", "0");
    }
  });
  $("#chAcRepInv").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("RepInv", "1");
    } else {
      ActualizarAcLog("RepInv", "0");
    }
  });
  $("#chAcOcho").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcOcho", "1");
    } else {
      ActualizarAcLog("AcOcho", "0");
    }
  });
  $("#chAcNueve").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcNueve", "1");
    } else {
      ActualizarAcLog("AcNueve", "0");
    }
  });
  $("#chAcDiez").click(function () {
    if ($(this).is(":checked")) {
      ActualizarAcLog("AcDiez", "1");
    } else {
      ActualizarAcLog("AcDiez", "0");
    }
  });
  $("#metPago").change(function () {
    var valor = $("select[id=metPago]").val();
    if (valor === "4") {
      $("#PagEfect").show();
      $("#PagTar").show();
      $("#PagCheq").show();
      $("#txTotPendDiv").show();
      $("#TotPagDiv").show();
      $("#PagEfect").focus();
    }
  });
  $("#PagEfect").on("keyup", function (evt) {
    if (evt.keyCode == 13) {
      EnviaPagDiv("1", $(this).val());
      $("#PagTar").focus();
      $("#PagEfect").attr("disabled", true);
      var MontoEfect = $("#PagEfect").val();
      var PendEfecTotal = $("#TotPagDiv").text();
      var PendEfecTotal = parseFloat(PendEfecTotal) - parseFloat(MontoEfect);
      document.getElementById("TotPagDiv").innerHTML = PendEfecTotal.toFixed(2);
    }
  });
  $("#PagTar").on("keyup", function (evt) {
    if (evt.keyCode == 13) {
      EnviaPagDiv("2", $(this).val());
      $("#PagCheq").focus();
      $("#PagTar").attr("disabled", true);
      var MontoEfect = $("#PagTar").val();
      var PendEfecTotal = $("#TotPagDiv").text();
      var PendEfecTotal = parseFloat(PendEfecTotal) - parseFloat(MontoEfect);
      document.getElementById("TotPagDiv").innerHTML = PendEfecTotal.toFixed(2);
    }
    if (evt.keyCode == 27) {
      $("#FacturaSend").focus();
    }
  });
  $("#PagCheq").on("keyup", function (evt) {
    if (evt.keyCode == 13) {
      EnviaPagDiv("3", $(this).val());
      $("#FacturaSend").focus();
      $("#PagCheq").attr("disabled", true);
      var MontoEfect = $("#PagCheq").val();
      var PendEfecTotal = $("#TotPagDiv").text();
      var PendEfecTotal = parseFloat(PendEfecTotal) - parseFloat(MontoEfect);
      document.getElementById("TotPagDiv").innerHTML = PendEfecTotal.toFixed(2);
    }
    if (evt.keyCode == 27) {
      $("#FacturaSend").focus();
    }
  });
  $("#montoDen").keypress(function (e) {
    if (e.which == 13) {
      $("#btnAdArq").focus();
    }
  });
  var now = new Date();
  var today =
    now.getDate() +
    "/" +
    (now.getMonth() + 1) +
    "/" +
    now.getFullYear() +
    " " +
    now.getHours() +
    ":" +
    now.getMinutes() +
    ":" +
    now.getSeconds();
  $("#FechDetVenta").val(today);
  $("#txtNit").keyup(function () {
    //Obtenemos el value del input
    $("#txtNombreCl").val("");
    $("#txtDirec").val("");
    var nitCl = $(this).val();
    var dataString = "buscar=" + nitCl;
    $.ajax({
      url: "http://localhost/pollofrito/index.php/Cliente_controller/consultarClienteNit",
      type: "POST",
      data: dataString,
      success: function (respuesta) {
        if (respuesta != "0") {
          var valores = eval(respuesta);
          $("#txtId").val(valores[0]["idgs_cliente"]);
          $("#txtNombreCl").val(valores[0]["nombre"]);
          $("#txtDirec").val(valores[0]["direccion_cont"]);
        } else {
          $("#txtNombreCl").val("----");
          $("#txtDirec").val("----");
        }
      },
    });
  });
  $(document).on("click", ".btn_remove", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var IdDetVent = datosFila[0];
    var idProd = datosFila[1];
    var Cant = datosFila[5];
    ElimninaDetalleP(idProd, Cant, IdDetVent);
    $("#row" + datosFila[0]).remove();
    calcularNeto();
    totalTotProd();
  });
  $(document).on("click", ".btn_removeDev", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var idProd = datosFila[1];
    var Cant = datosFila[5];
    ElimninaDetalleDev(idProd, Cant);
    $("#row" + datosFila[0]).remove();
    calcularNetoDev();
  });
  $(document).on("click", ".btn_removeDetalle", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var idProd = datosFila[1];
    var Cant = datosFila[5];
    /*ElimninaDetalleDev(idProd, Cant);*/
    $("#row" + datosFila[0].trim()).remove();
    /*calcularNetoDev();*/
    calcularNeto();
    totalTotProd();
    let saleDetail = $("#tblDetalleProd tbody");
    $.post(
      "http://localhost/pollofrito/index.php/Asignacion_controller/saveSaleDetail",
      { param: saleDetail.html() }
    );
  });
  //////funcion imprimir de nuevo el ticket
  $(document).on("click", ".opc_reimprimir", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var IdDetVent = datosFila[0];
    imprimirNewFac(IdDetVent);
  });
  $(document).on("click", ".opc_ingresarsistema", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var IdDetVent = datosFila[0];
    AcceSistema(IdDetVent);
  });

  $(document).on("click", ".ImpCompDev", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var IdDetVent = datosFila[0];
    var IdDetVentAnt = datosFila[4];
    imprimirNewFac(IdDetVent);
    setTimeout(imprimirNewFac(IdDetVentAnt), 600);
  });
  $(document).on("click", ".loadAccesos", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var IdUsr = datosFila[0];
    AccesoUsersLg(IdUsr);
  });

  $(document).on("click", ".add_menu", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });

    let nombre = datosFila[1];
    let descripcion = datosFila[2];
    $(this).css("font-weight", "700");
    $(this).css("background-color", "#bce8f1");
    $(this).find("td.btn_add").css("font-weight", "");
    $(this).find("td.btn_add").css("background-color", "#fff");
    let actualRow = $(this);
    $("#lista")
      .find("tr")
      .each(function () {
        if (actualRow.html() !== $(this).html()) {
          $(this).css("font-weight", "");
          $(this).css("background-color", "#fff");
        }
      });
    $("#txtNomP").val(nombre + " / " + descripcion);
    $("#txtStock").val(datosFila[5]);
    $("#txtPrecU").val(datosFila[6]);
    $("#txtPrecMayoreo").val(datosFila[8]);
    $("#txtCantP").val(0);
    $("#txtPrecioT").val(0);
    $("#txtCantP").focus();
  });

  $(document).on("click", ".btn_add", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });

    let nombre = datosFila[2];
    let descripcion = datosFila[3];
    $(this).css("font-weight", "700");
    $(this).css("background-color", "#bce8f1");
    $(this).find("td.btn_add").css("font-weight", "");
    $(this).find("td.btn_add").css("background-color", "#fff");
    let actualRow = $(this);
    $("#lista")
      .find("tr")
      .each(function () {
        if (actualRow.html() !== $(this).html()) {
          $(this).css("font-weight", "");
          $(this).css("background-color", "#fff");
        }
      });
    $("#listas")
      .find("td")
      .each(function () {
        $(this).css("font-weight", "");
        $(this).css("background-color", "#fff");
      });
    $("#txtNomP").val(nombre + " / " + descripcion);
    $("#txtDescP").val(descripcion);
    $("#txtBarras").val(datosFila[1]);
    $("#txtCodP").val(datosFila[0]);
    $("#txtStock").val(datosFila[5]);
    $("#txtPrecU").val(datosFila[6]);
    $("#txtPrecNormal").val(datosFila[7]);
    $("#txtPrecFrecuente").val(datosFila[8]);
    $("#txtPrecMayoreo").val(datosFila[9]);
    $("#txtBusqueda").val(datosFila[1]);
    $("#txtCantP").val(0);
    $("#txtPrecioT").val(0);
    $("#txtCantP").focus();
  });

  $(document).on("click", ".btn_addMenu", function () {
    var datosFila = [];
    var i = 0;
    $(this)
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });

    let nombre = $(this).find("span#nombre").html();
    let descripcion = $(this).find("span#descripcion").html();
    let codigo = $(this).find("span#codigo").html();
    let precio = $(this).find("span#precio").html();
    let id = $(this).find("span#idgs").html();

    $(this).css("font-weight", "700");
    $(this).css("background-color", "#bce8f1");
    let actualCell = $(this);
    $("#listas")
      .find("td")
      .each(function () {
        if (actualCell.html() !== $(this).html()) {
          $(this).css("font-weight", "");
          $(this).css("background-color", "#fff");
        }
      });
    $("#lista")
      .find("tr")
      .each(function () {
        $(this).css("font-weight", "");
        $(this).css("background-color", "#fff");
      });
    $("#txtNomP").val(nombre + " / " + descripcion);
    $("#txtBarras").val(codigo);
    $("#txtCodP").val(codigo);
    $("#txtPrecU").val(precio);
    $("#txtDescP").val("COMBO");
    $("#txtCantP").val(0);
    $("#txtPrecNormal").val(0);
    $("#txtPrecFrecuente").val(0);
    $("#txtPrecMayoreo").val(0);
    $("#txtPrecioT").val(0);
    $("#txtCantP").focus();
    setTimeout("cacularP()", 400);
    getMenuDetail(id);
    //$("#txtBusqueda").focus();
  });

  function getMenuDetail(comboValue) {
    let value = {
      combo: comboValue,
    };
    $.ajax({
      type: "GET",
      url: "http://localhost/pollofrito/index.php/Asignacion_controller/envDetalleMenu",
      data: value,
      success: function (resp) {
        let valores = eval(resp);
        let html =
          "<table class='table table-hover'><thead><tr><th>Combo</th><th>Producto</th><th>Cantidad</th></tr></thead><tbody>";
        for (const element of valores) {
          html +=
            "<tr><td>" +
            element["Combo_id"] +
            "</td><td>" +
            element["Producto_id"] +
            "</td><td>" +
            element["Cantidad"] +
            "</td></tr>";
        }
        html += "</tbody></table>";
        $("#listasProMenu").html(html);
      },
    });
  }
  //fin document Ready---
});
