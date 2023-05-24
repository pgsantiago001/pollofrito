$(document).ready(function () {
  $(document).on("click", ".btnCombo", function () {
    let datosFila = [];
    let i = 0;
    $(this)
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    let idCombo = datosFila[0];
    let nombC = datosFila[1];
    let DescC = datosFila[2];
    let PrecioCC = datosFila[3];
    let PrecioVC = datosFila[4];
    $("#NombreCombo").val(nombC);
    $("#DescripcionCombo").val(DescC);
    $("#precioCostoCombo").val(PrecioCC);
    $("#precioVentaCombo").val(PrecioVC);
    $("#btnEditCombo").val(idCombo);
    $(this).css("font-weight", "700");
    $(this).css("background-color", "#bce8f1");
    let actualRow = $(this);
    $("#listaCombo")
      .find("tr")
      .each(function () {
        if (actualRow.html() !== $(this).html()) {
          $(this).css("font-weight", "");
          $(this).css("background-color", "#fff");
        }
      });
    getComboDetail(idCombo);
  });

  $(document).on("click", ".btnDellProdPed", function () {
    let idBtn = $(this).attr("value");
    var dataString = "idDetProdP=" + idBtn;
    $.ajax({
      url: "http://localhost/pollofrito/index.php//eliminarDetPedP",
      type: "POST",
      data: dataString,
      success: function (respuesta) {
        if (respuesta != "0") {
          sweetAlert("Eliminado.!");
          $("#row" + idBtn).remove();
          sumaTotalProd();
          $("#formPedidoP")[0].reset();
          $("#nombrePedProd").val("");
          $("#cantPedProd").val("");
          $("#pUnitariorod").val("");
          $("#pSubtotalP").val("");
        } else {
          sweetAlert("No se pudo eliminar");
        }
      },
    });
  });

  $(document).on("click", ".btnDellPedEcn", function () {
    let idBtn = $(this).attr("value");
    var dataString = "idNoPedidoCan=" + idBtn;
    $.ajax({
      url: "http://localhost/pollofrito/index.php//cancelaPedEnc",
      type: "POST",
      data: dataString,
      success: function (respuesta) {
        if (respuesta != "0") {
          sweetAlert("Pedido cancelado.!");
          listaPedidos();
        } else {
          sweetAlert("No se pudo eliminar");
          listaPedidos();
        }
      },
    });
  });

  $(document).on("click", ".btnEditPedEcn", function () {
    $("#tblProductoVent tbody").empty();
    let idBtn = $(this).attr("value");
    var dataString = "idNoPedidoCan=" + idBtn;
    var datosFilaTbDatos = [];
    var j = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFilaTbDatos[j] = $(this).html();
        j++;
      });
    let NoPedido = datosFilaTbDatos[4];
    let FechaPedido = datosFilaTbDatos[5];
    let TotalAnticipo = datosFilaTbDatos[6];
    let TotalDto = datosFilaTbDatos[7];
    let TotalSldo = datosFilaTbDatos[8];
    let NombEncarg = datosFilaTbDatos[12];
    let NombTienda = datosFilaTbDatos[13];
    $("#NoPedidoPEnc").val(NoPedido);
    $("#NoFac").val(NoPedido);
    $("#FechaPedEdtEnc").val(FechaPedido);
    $("#anticipoPTT").val(TotalAnticipo);
    $("#saldoPTT").val(TotalSldo);
    $("#TotalTT").val(TotalDto);
    $("#nombreEnc").val(NombEncarg);
    $("#NombTienda").val(NombTienda);
    $("#tbLstaPedEnc tbody").empty();
    $.ajax({
      url: "http://localhost/pollofrito/index.php//editPedEnc",
      type: "POST",
      data: dataString,
      success: function (respuesta) {
        if (respuesta != "0") {
          var valores = eval(respuesta);
          for (i = 0; i < valores.length; i++) {
            let NoPed = valores[i]["idgs_detalleped"];
            $("#nitCompradorE").val(valores[0]["nit"]);
            $("#nombreCompradorE").val(valores[0]["nombre"]);
            $("#direccionCompradorE").val(valores[0]["direccion_cont"]);
            $("#idCompradorE").val(valores[0]["idgs_cliente"]);
            var fila =
              '<tr id="row' +
              NoPed +
              '"><td style="display: block">' +
              valores[i]["idgs_detalleped"] +
              "</td><td>" +
              valores[i]["nombrePed"] +
              "</td><td>" +
              valores[i]["cantPed"] +
              "</td><td>" +
              valores[i]["precioUnitPed"] +
              '</td><td class="subTotalPed">' +
              valores[i]["subtotalPed"] +
              '</td><td><button type="button" class="btn btn-primary btn-small btnVerDetPedido" value="' +
              NoPed +
              '"> <span class="glyphicon glyphicon-eye-open"></span></button></td></tr>'; //esto seria lo que contendria la fila
            $("#tbLstaPedEnc tbody").append(fila);
            $("#tblProductoVent tbody").append(fila);
          }
        } else {
          sweetAlert("No se pudo eliminar");
        }
      },
    });
    setTimeout("sumaTotalProd()", 1000);
  });

  $(document).on("click", ".btnVerDetPedido", function () {
    let idBtn = $(this).attr("value");
    var dataString = "idNoDetPedidoCan=" + idBtn;

    $.ajax({
      url: "http://localhost/pollofrito/index.php//verDetPedEnc",
      type: "POST",
      data: dataString,
      success: function (respuesta) {
        if (respuesta != "0") {
          var valores = eval(respuesta);
          $("#fechaEntregaP").val(valores[0]["fechaEntregaPed"]);
          $("#dirEntregaP").val(valores[0]["direccionEntregaPed"]);
          let enviFoto = valores[0]["gs_envioFoto_idgs_envioFoto"];
          $("input[name=envioFoto][value='" + enviFoto + "']").prop(
            "checked",
            true
          );
          $("#leyendaFotP").val(valores[0]["leyendaPedFot"]);
          let tipoAdorno = valores[0]["gs_tipoadorno_idgs_tipoadorno"];
          $("input[name=tipoAdornoP][value='" + tipoAdorno + "']").prop(
            "checked",
            true
          );
          $("#tipoBseDesP").val(valores[0]["tipoBasePed"]);
          $("#observacionesP").val(valores[0]["observacionPed"]);
          $("#nombrePedProd").val(valores[0]["nombrePed"]);
          $("#cantPedProdEC").val(valores[0]["cantPed"]);
          $("#pUnitariorodEC").val(valores[0]["precioUnitPed"]);
          $("#pSubtotalPEC").val(valores[0]["subtotalPed"]);
          $("#addBtnPEC").val(valores[0]["idgs_detalleped"]);
          //$('#FechaPedEdt').val(valores[0]['fechaPedido']);
          //$('#NombTienda').val(valores[0]['tinedaNombre']);
          //$('#nombreEnc').val(valores[0]['nombreEncargado']);
        } else {
          sweetAlert("No se cargaron los datos");
        }
      },
    });
  });
  $(document).on("click", ".btnEntregarPed", function () {
    let idBtn = $(this).attr("value");
    var dataString = "idNoDetPedidoCan=" + idBtn;
    var datosFila = [];
    var i = 0;
    $(this)
      .parents("tr")
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    var idVenta = datosFila[4];
    var saldoAnt = datosFila[9];
    /*  var DireT =datosFila[2];
    var TelT =datosFila[3];*/
    $("#totalP").val(saldoAnt);
    $("#idVentaEc").val(idVenta);
    $("#saldoP").val(saldoAnt);
    //$("#btnEditTda").val(idTienda);
  });

  $("#nitCompradorE").keyup(function (e) {
    //Obtenemos el value del input
    $("#nombreCompradorE").val("");
    $("#direccionCompradorE").val("");
    var nitCl = $(this).val();
    var dataString = "buscar=" + nitCl;
    $.ajax({
      url: " http://localhost/pollofrito/index.php/Cliente_controller/consultarClienteNit",
      type: "POST",
      data: dataString,
      success: function (respuesta) {
        if (respuesta != "0") {
          var valores = eval(respuesta);
          $("#idCompradorE").val(valores[0]["idgs_cliente"]);
          $("#nombreCompradorE").val(valores[0]["nombre"]);
          $("#direccionCompradorE").val(valores[0]["direccion_cont"]);
        } else {
          $("#nombreCompradorE").val("----");
          $("#direccionCompradorE").val("----");
        }
      },
    });
  });

  $("#pUnitariorod").keyup(function (e) {
    let CatnP = $("#cantPedProd").val();
    let preUni = $("#pUnitariorod").val();
    let subT = parseFloat(CatnP).toFixed(2) * parseFloat(preUni).toFixed(2);
    if (preUni != "") {
      $("#pSubtotalP").val(parseFloat(subT).toFixed(2));
    } else {
      $("#pSubtotalP").val("0");
    }
  });

  $("#anticipoP").keyup(function (e) {
    /* let totProdP =  $("#totalP").val();
          let anticipoP =  $("#anticipoP").val();
          let SaldP = parseFloat(totProdP).toFixed(2)-parseFloat(anticipoP).toFixed(2);
            if(anticipoP !=''){
                $('#saldoP').val(parseFloat(SaldP).toFixed(2));
            } else {
                $('#saldoP').val('0');
            }*/
    calculaSaldoPrd();
  });
  $("#cantPedProdEC").keyup(function (e) {
    calculaSubTotalEC();
    //calculaSaldoPrd();
  });
  $("#pUnitariorodEC").keyup(function (e) {
    calculaSubTotalEC();
    //calculaSaldoPrd();
  });

  $("#efectivoP").keypress(function (e) {
    let anticipoP = $("#anticipoP").val();
    let efectPago = $("#anticipoP").val();
    let AntPagoP = $("#efectivoP").val();
    if (e.which == 13) {
      if (anticipoP != "") {
        let resAntPago = parseFloat(efectPago) + parseFloat(AntPagoP);
        $("#anticipoP").val(parseFloat(resAntPago).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      } else {
        let antFlag = "0";
        let SaldP =
          parseFloat(AntPagoP).toFixed(2) + parseFloat(antFlag).toFixed(2);
        $("#anticipoP").val(parseFloat(SaldP).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      }
    }
  });

  $("#tarjetaP").keypress(function (e) {
    let anticipoP = $("#anticipoP").val();
    let TarjetaP = $("#tarjetaP").val();
    if (e.which == 13) {
      if (anticipoP != "") {
        let resAntPagoTar = parseFloat(TarjetaP) + parseFloat(anticipoP);
        $("#anticipoP").val(parseFloat(resAntPagoTar).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      } else {
        let antFlag = "0";
        let SaldPTar =
          parseFloat(TarjetaP).toFixed(2) + parseFloat(antFlag).toFixed(2);
        $("#anticipoP").val(parseFloat(SaldPTar).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      }
    }
  });
  $("#chequeP").keypress(function (e) {
    let anticipoP = $("#anticipoP").val();
    let chequeP = $("#chequeP").val();
    if (e.which == 13) {
      if (anticipoP != "") {
        let resAntPagoChq = parseFloat(chequeP) + parseFloat(anticipoP);
        $("#anticipoP").val(parseFloat(resAntPagoChq).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      } else {
        let antFlag = "0";
        let SaldPChq =
          parseFloat(chequeP).toFixed(2) + parseFloat(antFlag).toFixed(2);
        $("#anticipoP").val(parseFloat(SaldPChq).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      }
    }
  });
  $("#cuponP").keypress(function (e) {
    let anticipoP = $("#anticipoP").val();
    let cuponP = $("#cuponP").val();
    if (e.which == 13) {
      if (anticipoP != "") {
        let resAntPagoCupon = parseFloat(cuponP) + parseFloat(anticipoP);
        $("#anticipoP").val(parseFloat(resAntPagoCupon).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      } else {
        let antFlag = "0";
        let SaldPCupon =
          parseFloat(cuponP).toFixed(2) + parseFloat(antFlag).toFixed(2);
        $("#anticipoP").val(parseFloat(SaldPCupon).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      }
    }
  });
  $("#cortesiaP").keypress(function (e) {
    let anticipoP = $("#anticipoP").val();
    let cortesiaP = $("#cortesiaP").val();
    if (e.which == 13) {
      if (anticipoP != "") {
        let resAntPagoCortesia = parseFloat(cortesiaP) + parseFloat(anticipoP);
        $("#anticipoP").val(parseFloat(resAntPagoCortesia).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      } else {
        let antFlag = "0";
        let SaldPCortesia =
          parseFloat(cortesiaP).toFixed(2) + parseFloat(antFlag).toFixed(2);
        $("#anticipoP").val(parseFloat(SaldPCortesia).toFixed(2));
        calculaSaldoPrd();
        sweetAlert("Agregado.!");
      }
    }
  });

  $("#selectMetPago").change(function () {
    var valor = $("select[id=selectMetPago]").val();
    if (valor === "6") {
      $("#tipoPagoPDiv").show();
    } else {
      $("#tipoPagoPDiv").hide();
    }
  });

  $(document).on("click", ".btnProductoPreparado", function () {
    let datosFila = [];
    let i = 0;
    $(this)
      .find("td")
      .each(function () {
        datosFila[i] = $(this).html();
        i++;
      });
    let idProductoPreparado = datosFila[0];
    let nombre = datosFila[1];
    let descripcion = datosFila[2];
    let precioMayoreo = datosFila[3];
    $("#nombreProductoPreparado").val(nombre);
    $("#descripcionProductoPreparado").val(descripcion);
    $("#precioMayoreoProductoPreparado").val(precioMayoreo);
    $("#btnEditProductoPreparado").val(idProductoPreparado);
    $(this).css("font-weight", "700");
    $(this).css("background-color", "#bce8f1");
    let actualRow = $(this);
    $("#listaProductoPreparado")
      .find("tr")
      .each(function () {
        if (actualRow.html() !== $(this).html()) {
          $(this).css("font-weight", "");
          $(this).css("background-color", "#fff");
        }
      });
    getProductoPreparadoDetail(idProductoPreparado);
  });

  leerAllCombo();
  leerTodosProductosPreparados();
  cargarListaProductos();
  cargarListaCombo();
  cargarListaProductoPreparado();
  listaPedidos();
  listaPedidosEntrega();
});
function calculaSaldoPrd() {
  let totProdP = $("#totalP").val();
  let anticipoP = $("#anticipoP").val();
  let SaldP =
    parseFloat(totProdP).toFixed(2) - parseFloat(anticipoP).toFixed(2);
  if (anticipoP != "") {
    $("#saldoP").val(parseFloat(SaldP).toFixed(2));
  } else {
    $("#saldoP").val("0");
  }
}
function calculaSubTotalEC() {
  let cant = $("#cantPedProdEC").val();
  let Punitario = $("#pUnitariorodEC").val();
  let SubtEC = parseFloat(cant).toFixed(2) * parseFloat(Punitario).toFixed(2);
  $("#pSubtotalPEC").val(parseFloat(SubtEC).toFixed(2));
}

function calculaSaldo() {
  let totProdP = $("#totalP").val();
  let anticipoP = $("#anticipoP").val();
  let SaldP =
    parseFloat(totProdP).toFixed(2) - parseFloat(anticipoP).toFixed(2);
  if (anticipoP != "") {
    $("#saldoP").val(parseFloat(SaldP).toFixed(2));
  } else {
    $("#saldoP").val("0");
  }
}
function cargarListaProductos() {
  $.ajax({
    // async:false,
    url: "http://localhost/pollofrito/index.php/Menu_controller/listaProductos",
    type: "POST",
  }).done(function (resp) {
    var valores = eval(resp);
    for (i = 0; i < valores.length; i++) {
      var idProd = valores[i]["idgs_producto"];
      var codigoProd = valores[i]["codigo"];
      var nombreProd = valores[i]["nombre"];
      var descripcionProd = valores[i]["descripcion"];
      $("#selectProd").append(
        '<option value="' +
          idProd +
          '">' +
          codigoProd +
          "--" +
          nombreProd +
          "--" +
          descripcionProd +
          "</option>"
      );
      if (!!!+valores[i]["es_producto_preparado"]) {
        $("#selectProdP").append(
          '<option value="' +
            idProd +
            '">' +
            codigoProd +
            "--" +
            nombreProd +
            "--" +
            descripcionProd +
            "</option>"
        );
      }
    }
  });
}
function cargarListaCombo() {
  $.ajax({
    // async:false,
    url: "http://localhost/pollofrito/index.php/Menu_controller/listaCombos",
    type: "POST",
  }).done(function (resp) {
    var valores = eval(resp);
    for (i = 0; i < valores.length; i++) {
      var idCombo = valores[i]["idgs_menu"];
      var nombreCombo = valores[i]["nombre"];
      var descripcionCombo = valores[i]["descripcion"];
      $("#selectCombo").append(
        '<option value="' +
          idCombo +
          '">' +
          nombreCombo +
          "--" +
          descripcionCombo +
          "</option>"
      );
    }
  });
}

function leerAllCombo() {
  $.get(
    "http://localhost/pollofrito/index.php/Menu_controller/obtenerCombo",
    {},
    function (data, status) {
      var valores = eval(data);
      let html =
        "<table class='table table-hover'> " +
        " <thead> " +
        "   <tr> " +
        "     <th>ID</th> " +
        "     <th>NOMBRE</th> " +
        "     <th>DESCRIPCIÓN</th> " +
        "     <th>PRECIO COSTO</th> " +
        "     <th>PRECIO VENTA</th> " +
        "   </tr> " +
        " </thead> " +
        " <tbody>";
      for (i = 0; i < valores.length; i++) {
        html +=
          "   <tr class='btnCombo'> " +
          "     <td>" +
          valores[i]["idgs_menu"] +
          " </td> " +
          "     <td>" +
          valores[i]["nombre"] +
          " </td> " +
          "     <td>" +
          valores[i]["descripcion"] +
          " </td> " +
          "     <td>" +
          valores[i]["precio_costo"] +
          " </td> " +
          "     <td>" +
          valores[i]["precio_venta"] +
          " </td> " +
          "   </tr>";
      }
      html += "</tbody></table>";
      $("#listaCombo").html(html);
    }
  );
}

function abrirMdl() {
  $("#myModal").modal();
}
function actualizar() {
  location.reload(true);
}
function guardarMenu() {
  var value = {
    nomMenu: $("#nomMenu").val(),
    descripMenu: $("#descripMenu").val(),
    precioCosto: $("#precioCosto").val(),
    precioVenta: $("#precioVenta").val(),
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php/Menu_controller/GuardarMenu",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      swal({
        title: "Bien.!",
        text: "Menu guardado.!",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
      //$("#selectMasa").empty();
      actualizar();
    }
  });
}
function asignarCombos() {
  let value = {
    idProductos: $("#selectProd").val(),
    idCombos: $("#selectCombo").val(),
    Cantidad: $("#txtCantidad").val(),
    precio: $("#txtPrecioProductoMenu").val(),
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php/Menu_controller/asignarCombo",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      swal({
        title: "Bien.!",
        text: "Asignacion correcta.!",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
      //$("#selectMasa").empty();
    }
  });
}

function edtCombo() {
  let value = {
    idCombo: $("#btnEditCombo").val(),
    NombreCombo: $("#NombreCombo").val(),
    DescripcionCombo: $("#DescripcionCombo").val(),
    precioCostoCombo: $("#precioCostoCombo").val(),
    precioVentaCombo: $("#precioVentaCombo").val(),
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php/Menu_controller/EditarCombo",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      swal({
        title: "Bien.!",
        text: "Combo editado.!",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
      leerAllCombo();
      //$("#selectMasa").empty();
    }
  });
  // CM:: update combo detail
  $("#detalleCombo")
    .find("tbody")
    .find("tr")
    .each(function () {
      let cantidad = +$(this).find("td").eq(2).find("input").val();
      let idgs_detallemenu = $(this).find("td").eq(2).find("input").attr("id");
      let precio_producto_menu = +$(this).find("td").eq(4).find("input").val();
      let menuDetail = {
        idgs_detallemenu: idgs_detallemenu,
        quantity: cantidad,
        precioProductoMenu: precio_producto_menu,
      };
      $.post(
        "http://localhost/pollofrito/index.php/Menu_controller/updateComboDetail",
        { menuDetail: menuDetail }
      );
    });
}
function insertEncDetPed() {
  let Correlativo = $("#NoFac").val();
  if (Correlativo != "") {
    sweetAlert("tiene datos guarda solo detalle");
    insertDetPed();
    $("#pSubtotalP").val("");
    $("#pUnitariorod").val("");
    $("#cantPedProd").val("");
    $("#nombrePedProd").val("");
    $("#observacionesP").val("");
    $("#tipoBseDesP").val("");
    $("#leyendaFotP").val("");
  } else {
    var now = new Date();
    var today =
      now.getFullYear() +
      "-" +
      (now.getMonth() + 1) +
      "-" +
      now.getDate() +
      " " +
      now.getHours() +
      ":" +
      now.getMinutes() +
      ":" +
      now.getSeconds();
    var value = {
      IdCliente: $("#idCompradorE").val(),
      idUser: $("#idUser").val(),
      Fecha: today,
    };
    $.ajax({
      url: "http://localhost/pollofrito/index.php//InsertEncPedido",
      data: value,
      type: "POST",
    }).done(function (resp) {
      if (resp != "") {
        let correlativo = eval(resp);
        $("#NoFac").val(correlativo);
        insertDetPed();
        swal({
          title: "Bien.!",
          text: "Venta Iniciada.!",
          icon: "success",
          timer: 1500,
          showConfirmButton: false,
        });
        $("#pSubtotalP").val("");
        $("#pUnitariorod").val("");
        $("#cantPedProd").val("");
        $("#nombrePedProd").val("");
        $("#observacionesP").val("");
        $("#tipoBseDesP").val("");
        $("#leyendaFotP").val("");
        //$("#selectMasa").empty();
      }
    });
  }
}

function insertDetPed() {
  let Correlativo = $("#NoFac").val();
  let fechaEntrP = $("#fechaEntregaP").val();
  let dirEntrP = $("#dirEntregaP").val();
  let idEnvioFotoP = $("input:radio[name=envioFoto]:checked").val();
  let leyendaFotoP = $("#leyendaFotP").val();
  let observaFotP = $("#observaFotP").val();
  let tipoAdornoP = $("input:radio[name=tipoAdornoP]:checked").val();
  let tipoBaseDesignP = $("#tipoBseDesP").val();
  let observacionesP = $("#observacionesP").val();
  let nombreP = $("#nombrePedProd").val();
  let CantPedPr = $("#cantPedProd").val();
  let pUnitarioP = $("#pUnitariorod").val();
  let pSubtotalP = $("#pSubtotalP").val();
  if (Correlativo != "") {
    var value = {
      IdPedido: Correlativo,
      fechaEntrP: fechaEntrP,
      dirEntrP: dirEntrP,
      idEnvioFotoP: idEnvioFotoP,
      leyendaFotoP: leyendaFotoP,
      observaFotP: observaFotP,
      tipoAdornoP: tipoAdornoP,
      tipoBaseDesignP: tipoBaseDesignP,
      observacionesP: observacionesP,
      nombreP: nombreP,
      CantPedPr: CantPedPr,
      pUnitarioP: pUnitarioP,
      pSubtotalP: pSubtotalP,
    };
    $.ajax({
      url: "http://localhost/pollofrito/index.php//InsertDetPedido",
      data: value,
      type: "POST",
    }).done(function (resp) {
      if (resp != "") {
        let idDetallePedP = eval(resp);

        var i = 1;
        var fila =
          '<tr id="row' +
          idDetallePedP +
          '"><td>' +
          idDetallePedP +
          "</td><td>" +
          nombreP +
          "</td><td>" +
          CantPedPr +
          "</td><td>" +
          pUnitarioP +
          '</td><td class="subTotalPed">' +
          pSubtotalP +
          '</td><td><button type="button" class="btn btn-danger btn-small btnDellProdPed" value="' +
          idDetallePedP +
          '"> <span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila
        i++;
        $("#tblProductoVent tbody").append(fila);
        swal({
          title: "Bien.!",
          text: "Agregado.!",
          icon: "success",
          timer: 1500,
          showConfirmButton: false,
        });
        sumaTotalProd();
      }
    });
  } else {
    swal({
      title: "Error.!",
      text: "No se pudo agregar.",
      icon: "warning",
      timer: 1500,
      showConfirmButton: false,
    });
  }
}
function guardarPedido() {
  var valor = $("select[id=selectMetPago]").val();
  if (valor != "6") {
    UpdtEncabezadoPed();
    limpiarCmpsVtsEnc();
    setTimeout("imprimirTickePED()", 1100);
  } else {
    UpdtEncabezadoPed();
    let pgEfect = $("#efectivoP").val();
    let pgTarjetaP = $("#tarjetaP").val();
    let pgChequeP = $("#chequeP").val();
    let pgCuponP = $("#cuponP").val();
    let idPed = $("#NoFac").val();

    if (pgEfect != "") {
      guardaPagos(pgEfect, idPed, "1");
    }
    if (pgTarjetaP != "") {
      guardaPagos(pgTarjetaP, idPed, "2");
    }
    if (pgChequeP != "") {
      guardaPagos(pgChequeP, idPed, "3");
    }
    if (pgCuponP != "") {
      guardaPagos(pgCuponP, idPed, "4");
    }
    limpiarCmpsVtsEnc();
    listaPedidos();
    setTimeout("imprimirTickePED()", 1100);
  }
}
function guardaPagos(montoPago, idPed, idPgo) {
  var value = {
    cantPagada: montoPago,
    gs_pedido_idgs_pedido: idPed,
    gs_tipo_pago_idgs_tipo_pago: idPgo,
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php//InsertPagosDiv",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      limpiarCmpsVtsEnc();
      // swal({title: "Bien.!", text: "Venta Iniciada.!", icon: "success", timer: 1500, showConfirmButton: false});
      //$("#selectMasa").empty();
    } else {
      swal({
        title: "Error.!",
        text: "No se guardaron los pagos.!",
        icon: "warning",
        timer: 1500,
        showConfirmButton: false,
      });
    }
  });
}

function UpdtEncabezadoPed() {
  let idPedido = $("#NoFac").val();
  let anticipoPed = $("#anticipoP").val();
  let Saldo = $("#saldoP").val();
  let TotalPed = $("#totalP").val();
  let estado = "0";
  let idTipoPago = $("select[id=selectMetPago]").val();
  let idCliente = $("#idCompradorE").val();
  let idEncargado = $("#idUser").val();
  let idTienda = $("#idTineda").val();
  if (Saldo > 0) {
    estado = "0";
  } else {
    estado = "1";
  }
  var value = {
    idPedido: idPedido,
    anticipoPed: anticipoPed,
    Saldo: Saldo,
    TotalPed: TotalPed,
    estado: estado,
    idTipoPago: idTipoPago,
    idCliente: idCliente,
    idEncargado: idEncargado,
    idTienda: idTienda,
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php//UpdtEncPedido",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      swal({
        title: "Bien.!",
        text: "Pedido Guardado.!",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
      $("#formPedidoP")[0].reset();
      $("#tbodyTblPedido").empty();
    }
  });
}
function limpiarCmpsVtsEnc() {
  //   $('#NoFac').val('');
  $("#efectivoP").val("");
  $("#tarjetaP").val("");
  $("#chequeP").val("");
  $("#cuponP").val("");
  $("#totalP").val("");
  $("#anticipoP").val("");
  $("#saldoP").val("");
  $("#idCompradorE").val("");
  $("#nitCompradorE").val("");
  $("#nombreCompradorE").val("");
  $("#direccionCompradorE").val("");
  $("#nombrePedProd").val("");
  $("#cantPedProd").val("");
  $("#pUnitariorod").val("");
  $("#pSubtotalP").val("");
}

function sumaTotalProd() {
  let totalProdP = 0;
  $(".subTotalPed").each(function () {
    totalProdP += parseFloat($(this).html()) || "0";
  });
  $("#totalP").val(parseFloat(totalProdP).toFixed(2));
}
function sumaTotalProdEDITADO() {
  let totalProdP = 0;
  $(".subTotalPed").each(function () {
    totalProdP += parseFloat($(this).html()) || "0";
  });
  $("#TotalTT").val(parseFloat(totalProdP).toFixed(2));

  let totProdPEdit = $("#TotalTT").val();
  let anticipoPEdit = $("#anticipoPTT").val();
  let SaldPEdit =
    parseFloat(totProdPEdit).toFixed(2) - parseFloat(anticipoPEdit).toFixed(2);
  $("#saldoPTT").val(parseFloat(SaldPEdit).toFixed(2));
  setTimeout("updtEncabedadoEditEC()", 600);
  setTimeout("listaPedidos()", 800);
  setTimeout("clearImptsEdt()", 900);
}
function clearImptsEdt() {
  $("#anticipoPTT").val("");
  $("#saldoPTT").val("");
  $("#TotalTT").val("");
  $("#nombreEnc").val("");
  $("#NombTienda").val("");
  $("#FechaPedEdtEnc").val("");
  $("#NoPedidoPEnc").val("");
}
function updtEncabedadoEditEC() {
  let idPedido = $("#NoPedidoPEnc").val();
  let anticipoPed = $("#anticipoPTT").val();
  let Saldo = $("#saldoPTT").val();
  let TotalPed = $("#TotalTT").val();
  let estado = "0";
  if (Saldo > 0) {
    estado = "0";
  } else {
    estado = "1";
  }
  var value = {
    idPedido: idPedido,
    anticipoPed: anticipoPed,
    Saldo: Saldo,
    TotalPed: TotalPed,
    estado: estado,
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php//UpdtEncPedidoBefEditar",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      //swal({title: "Bien.!", text: "Pedido Guardado.!", icon: "success", timer: 1500, showConfirmButton: false});
      $("#frmEditProdENC")[0].reset();
      $("#tbodytbLstaPedEnc").empty();
    }
  });
}
function listaPedidos() {
  $("#tblEditCancelPed tbody").empty();
  $.get(
    "http://localhost/pollofrito/index.php//obtenerLstaPedidos",
    {},
    function (respuesta, status) {
      var valores = eval(respuesta);
      for (i = 0; i < valores.length; i++) {
        let NoPed = valores[i]["idgs_pedido"];
        var fila =
          '<tr id="row' +
          NoPed +
          '"><td style="display: none">' +
          valores[i]["idgs_cliente"] +
          "</td><td>" +
          valores[i]["nit"] +
          "</td><td>" +
          valores[i]["nombre"] +
          "</td><td>" +
          valores[i]["Direccion_cont"] +
          "</td><td>" +
          NoPed +
          "</td><td>" +
          valores[i]["fechaPedido"] +
          "</td><td>" +
          valores[i]["anticipoPed"] +
          "</td><td>" +
          valores[i]["totalPed"] +
          "</td><td>" +
          valores[i]["saldoPed"] +
          "</td><td>" +
          valores[i]["estado"] +
          '</td><td><button type="button" class="btn btn-warning btn-small btnEditPedEcn" value="' +
          NoPed +
          '"> <span class="glyphicon glyphicon-edit"></span></button></td><td><button type="button" class="btn btn-danger btn-small btnDellPedEcn" value="' +
          NoPed +
          '"> <span class="glyphicon glyphicon-trash"></span></button></td><td style="display: none">' +
          valores[i]["nombreEncargado"] +
          '</td><td style="display: none">' +
          valores[i]["tinedaNombre"] +
          "</td></tr>"; //esto seria lo que contendria la fila
        $("#tblEditCancelPed tbody").append(fila);
      }
    }
  );
}

function listaPedidosEntrega() {
  $("#tblEditCancelPed tbody").empty();
  $.get(
    "http://localhost/pollofrito/index.php//obtenerLstaPedidos",
    {},
    function (respuesta, status) {
      var valores = eval(respuesta);
      for (i = 0; i < valores.length; i++) {
        let NoPed = valores[i]["idgs_pedido"];
        var fila =
          '<tr id="row' +
          NoPed +
          '"><td style="display: none">' +
          valores[i]["idgs_cliente"] +
          "</td><td>" +
          valores[i]["nit"] +
          "</td><td>" +
          valores[i]["nombre"] +
          "</td><td>" +
          valores[i]["Direccion_cont"] +
          "</td><td>" +
          NoPed +
          "</td><td>" +
          valores[i]["fechaPedido"] +
          "</td><td>" +
          valores[i]["fechaEntregaPed"] +
          "</td><td>" +
          valores[i]["anticipoPed"] +
          "</td><td>" +
          valores[i]["totalPed"] +
          "</td><td>" +
          valores[i]["saldoPed"] +
          "</td><td>" +
          valores[i]["estado"] +
          '</td><td><button type="button" class="btn btn-primary btn-small btnEntregarPed" value="' +
          NoPed +
          '"> <span class="glyphicon glyphicon-shopping-cart"></span></button></td><td style="display: none">' +
          valores[i]["nombreEncargado"] +
          '</td><td style="display: none">' +
          valores[i]["tinedaNombre"] +
          "</td></tr>"; //esto seria lo que contendria la fila
        $("#tblEditCancelPedENC tbody").append(fila);
      }
    }
  );
}

function editaDetPedidoEnc() {
  let idDetalleEnc = $("#addBtnPEC").attr("value");
  let Correlativo = $("#NoPedidoPEnc").val();
  let fechaEntrP = $("#fechaEntregaP").val();
  let dirEntrP = $("#dirEntregaP").val();
  let idEnvioFotoP = $("input:radio[name=envioFoto]:checked").val();
  let leyendaFotoP = $("#leyendaFotP").val();
  let tipoAdornoP = $("input:radio[name=tipoAdornoP]:checked").val();
  let tipoBaseDesignP = $("#tipoBseDesP").val();
  let observacionesP = $("#observacionesP").val();
  let nombreP = $("#nombrePedProd").val();
  let CantPedPr = $("#cantPedProdEC").val();
  let pUnitarioP = $("#pUnitariorodEC").val();
  let pSubtotalP = $("#pSubtotalPEC").val();
  if (Correlativo != "") {
    var value = {
      IdPedido: Correlativo,
      fechaEntrP: fechaEntrP,
      dirEntrP: dirEntrP,
      idEnvioFotoP: idEnvioFotoP,
      leyendaFotoP: leyendaFotoP,
      tipoAdornoP: tipoAdornoP,
      tipoBaseDesignP: tipoBaseDesignP,
      observacionesP: observacionesP,
      nombreP: nombreP,
      CantPedPr: CantPedPr,
      pUnitarioP: pUnitarioP,
      pSubtotalP: pSubtotalP,
      idDetalleEncargo: idDetalleEnc,
    };
    $.ajax({
      url: "http://localhost/pollofrito/index.php//ActualizaDetPedido",
      data: value,
      type: "POST",
    }).done(function (resp) {
      if (resp != "") {
        swal({
          title: "Bien.!",
          text: "Se edito correctamente.",
          icon: "success",
          timer: 300,
          showConfirmButton: false,
        });
        /* let idDetallePedP = eval(resp);

                    var i = 1;
                    var fila = '<tr id="row' + idDetallePedP + '"><td>' + idDetallePedP + '</td><td>' + nombreP + '</td><td>' + CantPedPr + '</td><td>' + pUnitarioP + '</td><td class="subTotalPed">' + pSubtotalP + '</td><td><button type="button" class="btn btn-danger btn-small btnDellProdPed" value="'+idDetallePedP+'"> <span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila
                    i++;
                    $('#tblProductoVent tbody').append(fila);
                    swal({title: "Bien.!", text: "Agregado.!", icon: "success", timer: 1500, showConfirmButton: false});*/
        cargaTblDetPedEditado(Correlativo);
        setTimeout("sumaTotalProdEDITADO()", 500);
      }
    });
  } else {
    swal({
      title: "Error.!",
      text: "Elija un detalle a editar.",
      icon: "warning",
      timer: 1500,
      showConfirmButton: false,
    });
  }
}
function cargaTblDetPedEditado(idGsPediod) {
  var dataString = "idNoPedidoCan=" + idGsPediod;
  $("#tbLstaPedEnc tbody").empty();
  $.ajax({
    url: "http://localhost/pollofrito/index.php//editPedEnc",
    type: "POST",
    data: dataString,
    success: function (respuesta) {
      if (respuesta != "0") {
        var valores = eval(respuesta);
        for (i = 0; i < valores.length; i++) {
          let NoPed = valores[i]["idgs_detalleped"];
          var fila =
            '<tr id="row' +
            NoPed +
            '"><td style="display: block">' +
            valores[i]["idgs_detalleped"] +
            "</td><td>" +
            valores[i]["nombrePed"] +
            "</td><td>" +
            valores[i]["cantPed"] +
            "</td><td>" +
            valores[i]["precioUnitPed"] +
            '</td><td class="subTotalPed">' +
            valores[i]["subtotalPed"] +
            '</td><td><button type="button" class="btn btn-primary btn-small btnVerDetPedido" value="' +
            NoPed +
            '"> <span class="glyphicon glyphicon-eye-open"></span></button></td></tr>'; //esto seria lo que contendria la fila
          $("#tbLstaPedEnc tbody").append(fila);
          $("#tblProductoVent tbody").append(fila);
        }
      } else {
        sweetAlert("No se pudo eliminar");
      }
    },
  });
}
function entregarCobrar() {
  let saldoActualEntrega = $("#saldoP").val();
  if (saldoActualEntrega > "0.00") {
    swal({
      title: "No se puede entregar.",
      text: "ver saldo actual.",
      icon: "warning",
      timer: 900,
      showConfirmButton: false,
    });
  } else {
    EntregaPedidoEncFn();
  }
}
function EntregaPedidoEncFn() {
  let idPedido = $("#idVentaEc").val();
  let Saldo = $("#saldoP").val();
  let estado = "1";
  let entregado = "1";

  value = {
    idPedido: idPedido,
    Saldo: Saldo,
    estado: estado,
    entregado: entregado,
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php//actualizaFinEncaPed",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      swal({
        title: "Bien.!",
        text: "Pedido Guardado.!",
        icon: "success",
        timer: 300,
        showConfirmButton: false,
      });
      //limpiarCmpsVtsEnc();
      let pgEfect = $("#efectivoP").val();
      let pgTarjetaP = $("#tarjetaP").val();
      let pgChequeP = $("#chequeP").val();
      let pgCuponP = $("#cuponP").val();
      let pgCortesiaP = $("#cortesiaP").val();

      let idPed = $("#idVentaEc").val();

      if (pgEfect != "") {
        guardaPagos(pgEfect, idPed, "1");
      }
      if (pgTarjetaP != "") {
        guardaPagos(pgTarjetaP, idPed, "2");
      }
      if (pgChequeP != "") {
        guardaPagos(pgChequeP, idPed, "3");
      }
      if (pgCuponP != "") {
        guardaPagos(pgCuponP, idPed, "4");
      }
      if (pgCortesiaP != "") {
        guardaPagos(pgCuponP, idPed, "5");
      }
      limpiarCmpsVtsEnc();
      setTimeout("listaPedidosEntrega()", 800);
      setTimeout("imprimirTicketEncPed()", 850);
      setTimeout("", 1000);
    }
  });
}
function imprimirTickePED() {
  let idPedEncargo = $("#NoFac").val();
  window.open(
    "http://localhost/pollofrito/index.php//TicketPedido/" + idPedEncargo
  );
  $("#NoFac").val("");
}
function imprimirTicketEncPed() {
  let idPed = $("#idVentaEc").val();
  window.open(
    "http://localhost/pollofrito/index.php//TicketEnctrega/" + idPed
  );
  $("#idVentaEc").val("");
}

function EncaTicketEnc(idFact) {
  var value = {
    idPedEnc: idFact,
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php//EncabTicket",
    type: "POST",
    data: value,
  }).done(function (resp) {
    let valores = eval(resp);
    document.getElementById("usrVent").innerHTML =
      valores[0]["nombreEncargado"];
    document.getElementById("FechapED").innerHTML = valores[0]["fechaPedido"];
    document.getElementById("FechaEnt").innerHTML =
      valores[0]["fechaEntregaPed"];
    document.getElementById("Nombre").innerHTML = valores[0]["nombre"];
    document.getElementById("Direccion").innerHTML =
      valores[0]["Direccion_cont"];
    document.getElementById("Nit").innerHTML = valores[0]["nit"];
    document.getElementById("NoCompra").innerHTML = valores[0]["idgs_pedido"];
    document.getElementById("NomTienda").innerHTML = valores[0]["tinedaNombre"];
    document.getElementById("Total").innerHTML = valores[0]["totalPed"];
    document.getElementById("Anticipo").innerHTML = valores[0]["anticipoPed"];
    document.getElementById("Saldo").innerHTML = valores[0]["saldoPed"];
  });
}

function DetalleTicketEnc(idFact) {
  var value = {
    idPedEnc: idFact,
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php//DetTicket",
    type: "POST",
    data: value,
  }).done(function (resp) {
    if (resp != "0") {
      var valores = eval(resp);
      html =
        "<thead><tr><th class='cantidad'>CANT</th><th class='producto'>PRODUCTO</th><th class='precio'>P/U</th><th class='precio'>P/S.T.</th></tr></thead><tbody>";
      for (i = 0; i < valores.length; i++) {
        html +=
          "<tr style='font-size: 5px'><td class='cantidad'>" +
          valores[i]["cantPed"] +
          "</td><td class='producto'>" +
          valores[i]["nombrePed"] +
          "</td><td>" +
          valores[i]["precioUnitPed"] +
          "</td><td>" +
          valores[i]["subtotalPed"] +
          "</td></tr>";
      }
      html += "</tbody></table>";
      $("#lista").html(html);
    } else {
      swal({
        title: "No se encontraron ",
        text: "datos..!",
        type: "warning",
        timer: 900,
      });
    }
  });
}
function pagoFinalEncPed(idFact) {
  var value = {
    idPedEnc: idFact,
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php//TotalPagoHoy",
    type: "POST",
    data: value,
  }).done(function (resp) {
    let valores = eval(resp);
    document.getElementById("PagoActual").innerHTML = valores[0]["TOTAL"];
  });
}

function lista_Prod(valor) {
  $("#txtCodP").val("");
  $("#txtBarras").val("");
  $("#txtDescP").val("");
  $("#txtNomP").val("");
  $("#txtStock").val("");
  $("#txtCantP").val("");
  $("#txtPrecU").val("");
  $("#txtPrecioT").val("");
  if (valor == "") {
    $("#txtBusqueda").focus();
  } else {
    document.getElementById("lista").style.display = "block";
    var dataString = "buscar=" + valor;
    $.ajax({
      url: "http://localhost/pollofrito/index.php/Producto_controller/listProdVenta",
      type: "GET",
      crossDomain: true,
      cache: false,
      data: dataString,
      dataType: "json",
    })
      .done(function (resp) {
        if (resp != "") {
          var valores = {};

          valores = eval(resp);
          if (valores.length > 0) {
            $("#txtCodP").val(valores[0]["idgs_producto"]);
            $("#txtBarras").val(valores[0]["codigo"]);
            $("#txtNomP").val(
              valores[0]["nombre"] + " / " + valores[0]["descripcion"]
            );
            $("#txtDescP").val(valores[0]["descripcion"]);
            $("#txtStock").val(valores[0]["stock"]);
            $("#txtCantP").val("1");
            $("#txtPrecU").val(valores[0]["precio_venta"]);
            $("#txtPrecMayoreo").val(valores[0]["preciomayoreo"]);
            $("#txtPrecFrecuente").val(valores[0]["preciofrecuente"]);
            $("#txtPrecNormal").val(valores[0]["precionormal"]);
            html =
              "<table class='table table-hover'> " +
              " <thead> " +
              "   <tr> " +
              "     <th>ID</th> " +
              "     <th>BARRAS</th> " +
              "     <th>NOMBRE</th> " +
              "     <th>DESCRIPCION</th> " +
              "     <th>CATEGORIA</th> " +
              "     <th>STOCK</th> " +
              "     <th style='display:none'>Precio venta</th> " +
              "     <th style='display:none'>Precio normal</th> " +
              "     <th style='display:none'>Precio combo</th> " +
              "   </tr> " +
              " </thead> " +
              " <tbody>";
            for (i = 0; i < valores.length; i++) {
              html +=
                " <tr class='add_menu'> " +
                "   <td> " +
                valores[i]["idgs_producto"] +
                "   </td> " +
                "   <td> " +
                valores[i]["codigo"] +
                "   </td> " +
                "   <td> " +
                valores[i]["nombre"] +
                "   </td> " +
                "   <td> " +
                valores[i]["descripcion"] +
                "   </td> " +
                "   <td> " +
                valores[i]["NombreCat"] +
                "   </td> " +
                "   <td> " +
                valores[i]["stock"] +
                "   </td> " +
                "   <td style='display:none'> " +
                valores[i]["precio_venta"] +
                "   </td> " +
                "   <td style='display:none'> " +
                valores[i]["precionormal"] +
                "   </td> " +
                "   <td style='display:none'> " +
                valores[i]["preciomayoreo"] +
                "   </td> " +
                " </tr>";
            }

            html += "</tbody></table>";
            $("#lista").html(html);
          }
        } else {
          $("#txtCodP").val("---");
          $("#txtDescP").val("---");
          $("#txtNomP").val("---");
          $("#txtStock").val("---");
          $("#txtCantP").val("---");
          $("#txtPrecU").val("---");
          $("#txtPrecioT").val("---");
        }
      })
      .fail(function (errorData) {
        alert(errorData);
      });
  }
}

function getComboDetail(comboId) {
  $.get(
    "http://localhost/pollofrito/index.php/Menu_controller/getComboDetail",
    { comboId: comboId }
  ).done(function (response) {
    if (response != "") {
      let values = {};

      let html =
        "<table class='table table-hover'> " +
        " <thead> " +
        "   <tr> " +
        "     <th>NOMBRE</th> " +
        "     <th>DESCRIPCION</th> " +
        "     <th>CANTIDAD</th> " +
        "     <th>PRECIO VENTA</th> " +
        "     <th>PRECIO COMBO</th> " +
        "     <th>STOCK</th> " +
        "     <th>ELIMINAR</th> " +
        "   </tr> " +
        " </thead> " +
        " <tbody>";
      values = eval(response);
      if (values.length > 0) {
        values.forEach((element) => {
          html +=
            " <tr > " +
            "   <td> " +
            element["nombre"] +
            "   </td> " +
            "   <td> " +
            element["descripcion"] +
            "   </td> " +
            "   <td> " +
            "   <input type='text' class='form-control' id='" +
            element["idgs_detallemenu"] +
            "' name='txtCantP " +
            "     ' value=' " +
            element["Cantidad"] +
            "   '></input> " +
            "   </td> " +
            "   <td> " +
            element["precio_venta"] +
            "   </td> " +
            "   <td> " +
            "   <input type='text' class='form-control' id='" +
            element["idgs_detallemenu"] +
            "' name='txtPrecCombo " +
            "     ' value=' " +
            element["precio_producto"] +
            "   '" +
            (!!+element["es_producto_preparado"] ? "disabled" : "") +
            "   '></input> " +
            "   </td> " +
            "   <td> " +
            element["stock"] +
            "   </td> " +
            "   <td> " +
            "     <button type='button' " +
            "       class='btn btn-danger delete-combo-detail' " +
            "       id='" +
            element["idgs_detallemenu"] +
            "' >" +
            "         <span class='glyphicon glyphicon-remove'></span> " +
            "     </button> " +
            "   </td> " +
            " </tr>";
        });
      } else {
        html +=
          " <tr>" +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          " </tr>";
      }
      html += "</tbody></table>";
      $("#detalleCombo").html(html);
    }
  });
}

$(document).on("click", ".delete-combo-detail", function () {
  let idgs_detallemenu = $(this).attr("id");
  // CM:: remove element from the DOM
  $(this).parent().parent().remove();

  // CM:: remove registry from DB
  deleteComboDetail(idgs_detallemenu);
});

function deleteComboDetail(idgs_detallemenu) {
  // CM:: delete single combo detail

  let menuDetail = {
    idgs_detallemenu: idgs_detallemenu,
  };
  $.post(
    "http://localhost/pollofrito/index.php/Menu_controller/deleteComboDetail",
    { menuDetail: menuDetail }
  ).done(function () {
    $(this).parent().find("tr");
  });
}

$(document).on("change", "#esproductopreparado", function () {
  if (this.checked) {
    $("#esproductopreparado").prop("checked", true);
    $("#costo").prop("disabled", true);
    $("#utilidad").prop("disabled", true);
    $("#precio_venta").prop("disabled", true);
    $("#precio_venta").prop("disabled", true);
    $("#preciofrecuente").prop("disabled", true);
    $("#precionormal").prop("disabled", true);
    $("#stock").prop("disabled", true);
    $("#costo").val(0);
    $("#utilidad").val(0);
    $("#precio_venta").val(0);
    $("#precio_venta").val(0);
    $("#preciofrecuente").val(0);
    $("#precionormal").val(0);
    $("#stock").val(0);
  } else {
    $("#esproductopreparado").prop("checked", false);
    $("#costo").prop("disabled", false);
    $("#utilidad").prop("disabled", false);
    $("#precio_venta").prop("disabled", false);
    $("#precio_venta").prop("disabled", false);
    $("#preciofrecuente").prop("disabled", false);
    $("#precionormal").prop("disabled", false);
    $("#stock").prop("disabled", false);
  }
});

function asignarProductoPreparado() {
  let value = {
    idProducto: $("#selectProdP").val(),
    idProductoPreparado: $("#selectProductoPreparado").val(),
    cantidad: $("#txtCantidadProductoPreparado").val(),
    precio: $("#txtPrecioProductoPreparado").val(),
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php/Menu_controller/asignarProductoPreparado",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      swal({
        title: "Bien.!",
        text: "Asignacion correcta.!",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
    }
  });
}

function cargarListaProductoPreparado() {
  $.ajax({
    url: "http://localhost/pollofrito/index.php/Menu_controller/listaProductoPreparado",
    type: "POST",
  }).done(function (resp) {
    let valores = eval(resp);
    for (i = 0; i < valores.length; i++) {
      let idProductoPreparado = valores[i]["idgs_producto"];
      let codigoProductoPreparado = valores[i]["codigo"];
      let nombreProductoPreparado = valores[i]["nombre"];
      let descripcionProductoPreparado = valores[i]["descripcion"];
      $("#selectProductoPreparado").append(
        '<option value="' +
          idProductoPreparado +
          '">' +
          codigoProductoPreparado +
          "--" +
          nombreProductoPreparado +
          "--" +
          descripcionProductoPreparado +
          "</option>"
      );
    }
  });
}

function leerTodosProductosPreparados() {
  $.get(
    "http://localhost/pollofrito/index.php/Menu_controller/listaProductoPreparado",
    {},
    function (data, _status) {
      let valores = eval(data);
      let html =
        "<table class='table table-hover'> " +
        " <thead> " +
        "   <tr> " +
        "     <th>ID</th> " +
        "     <th>NOMBRE</th> " +
        "     <th>DESCRIPCIÓN</th> " +
        "     <th>PRECIO MAYOREO</th> " +
        "   </tr> " +
        " </thead> " +
        " <tbody>";
      for (i = 0; i < valores.length; i++) {
        html +=
          "   <tr class='btnProductoPreparado'> " +
          "     <td>" +
          valores[i]["idgs_producto"] +
          " </td> " +
          "     <td>" +
          valores[i]["nombre"] +
          " </td> " +
          "     <td>" +
          valores[i]["descripcion"] +
          " </td> " +
          "     <td>" +
          valores[i]["preciomayoreo"] +
          " </td> " +
          "   </tr>";
      }
      html += "</tbody></table>";
      $("#listaProductoPreparado").html(html);
    }
  );
}

function getProductoPreparadoDetail(productoPreparadoId) {
  $.get(
    "http://localhost/pollofrito/index.php/Menu_controller/getProductoPreparadoDetail",
    { productoPreparadoId: productoPreparadoId }
  ).done(function (response) {
    if (response != "") {
      let values = {};

      let html =
        "<table class='table table-hover'> " +
        " <thead> " +
        "   <tr> " +
        "     <th>NOMBRE</th> " +
        "     <th>DESCRIPCION</th> " +
        "     <th>CANTIDAD</th> " +
        "     <th>PRECIO PREPARADO</th> " +
        "     <th>STOCK</th> " +
        "     <th>ELIMINAR</th> " +
        "   </tr> " +
        " </thead> " +
        " <tbody>";
      values = eval(response);
      if (values.length > 0) {
        values.forEach((element) => {
          html +=
            " <tr > " +
            "   <td> " +
            element["nombre"] +
            "   </td> " +
            "   <td> " +
            element["descripcion"] +
            "   </td> " +
            "   <td> " +
            "   <input type='text' class='form-control' id='" +
            element["idgs_producto"] +
            "' name='txtCantP " +
            "     ' value=' " +
            element["unidades_producto_preparado"] +
            "   '></input> " +
            "   </td> " +
            "   <td> " +
            "   <input type='text' class='form-control' id='" +
            element["idgs_dpp"] +
            "' name='txtPrecPrep " +
            "     ' value=' " +
            element["precio_preparado"] +
            "   '></input> " +
            "   </td> " +
            "   <td> " +
            element["stock"] +
            "   </td> " +
            "   <td> " +
            "     <button type='button' " +
            "       class='btn btn-danger delete-producto-preparado-detail' " +
            "       producto-preparado-id='" +
            productoPreparadoId +
            "       ' id='" +
            element["idgs_producto"] +
            "' >" +
            "         <span class='glyphicon glyphicon-remove'></span> " +
            "     </button> " +
            "   </td> " +
            " </tr>";
        });
      } else {
        html +=
          " <tr>" +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          "   <td> --- </td> " +
          " </tr>";
      }
      html += "</tbody></table>";
      $("#detalleProductoPreparado").html(html);
    }
  });
}

$(document).on("click", ".delete-producto-preparado-detail", function () {
  let idgs_producto = +$(this).attr("id");
  let id_producto_preparado = +$(this).attr("producto-preparado-id").trim();
  // CM:: remove element from the DOM
  $(this).parent().parent().remove();

  // CM:: remove registry from DB
  deleteProductoPreparadoDetail(idgs_producto, id_producto_preparado);
});

function deleteProductoPreparadoDetail(idgs_producto, id_producto_preparado) {
  // CM:: delete single producto preparado detail

  let productoPreparadoDetail = {
    idgs_producto: idgs_producto,
    id_producto_preparado: id_producto_preparado,
  };
  $.post(
    "http://localhost/pollofrito/index.php/Menu_controller/deleteProductoPreparadoDetail",
    { productoPreparadoDetail: productoPreparadoDetail }
  ).done(function () {
    $(this).parent().find("tr");
  });
}

function edtProductoPreparado() {
  let idProductoPreparado = $("#btnEditProductoPreparado").val();
  let value = {
    idProductoPreparado: idProductoPreparado,
    nombreProductoPreparado: $("#nombreProductoPreparado").val(),
    descripcionProductoPreparado: $("#descripcionProductoPreparado").val(),
    precioMayoreoProductoPreparado: $("#precioMayoreoProductoPreparado").val(),
  };
  $.ajax({
    url: "http://localhost/pollofrito/index.php/Menu_controller/EditarProductoPreparado",
    data: value,
    type: "POST",
  }).done(function (resp) {
    if (resp != "") {
      swal({
        title: "Bien.!",
        text: "Producto editado.!",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
      leerTodosProductosPreparados();
    }
  });
  $("#detalleProductoPreparado")
    .find("tbody")
    .find("tr")
    .each(function () {
      let cantidad = $(this).find("td").eq(2).find("input").val();
      let idgs_producto = $(this).find("td").eq(2).find("input").attr("id");
      let precio_preparado = $(this).find("td").eq(3).find("input").val();
      let productoDetail = {
        id_producto_preparado: idProductoPreparado,
        idgs_producto: idgs_producto,
        quantity: cantidad,
        precioPreparado: precio_preparado,
      };
      $.post(
        "http://localhost/pollofrito/index.php/Menu_controller/updateProductoPreparadoDetail",
        { productoDetail: productoDetail }
      );
    });
}
