function empezarFacturaP() {
  // $('#txtBusqueda').css("display", "block");

  // $('#txtBusqueda').prop('readonly', false);

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
    cliente: $("#txtId").val(),
    usuario: $("#idUser").val(),
    fecha: today,
  };

  if ($("#txtId").val() == "" || $("#idUser").val() == "") {
    alert("error al procesar");
  } else {
    $.ajax({
      url: "http://localhost/pollofrito/index.php/Asignacion_controller/insertFactEncabezado",
      data: value,
      type: "POST",
    }).done(function (resp) {
      if (resp != "") {
        let correlativo = eval(resp);
        //$('#NoFac').val(correlativo);
        DetalleProductos(correlativo);
      } else {
        swal({
          title: "Mensaje.!",
          text: "Debes de iniciar sesion.!",
          icon: "success",
          timer: 1500,
          showConfirmButton: false,
        });
      }
    });
  }
}

function armDetail(isCombo, element, quantityAndPrice) {
  let detail = {};
  if (isCombo) {
    let combo = element.find("td").eq(0).html().trim();
    let product = element.find("td").eq(1).html().trim();
    let quantity = element.find("td").eq(2).html().trim();
    let totals = quantityAndPrice.totalQuantity * quantity;
    detail = {
      cantidad: Number(totals),
      Factura_id: Number($("#NoFac").val().trim()),
      Producto_id: Number(product),
      // Precio_pro: Number(quantityAndPrice.productPrice),
      Menu_id: Number(combo),
      CantidadMenu: Number(quantityAndPrice.totalQuantity),
    };
  } else {
    let id = element.find("td").eq(0).html().trim();
    let price = element.find("td").eq(7).html().trim();
    let quantity = element.find("td").eq(5).html().trim();
    let prodPrice = price / quantity;
    detail = {
      cantidad: Number(quantity),
      Factura_id: Number($("#NoFac").val().trim()),
      Producto_id: Number(id),
      Precio_pro: Number(prodPrice),
    };
  }
  return detail;
}

function DetalleProductos(correlativo) {
    let detalle = {
        encabezado: {},
        detalleVenta: [],
    };
    $("#tblDetalleProd tbody tr").each(function () {
        let detalleProducto = {};
        if ($(this).find("td").eq(4).html().toUpperCase() !== "COMBO") {
            detalleProducto = {
                facturaId: Number(correlativo),
                productoMenuId: Number($(this).find("td").eq(1).html()),
                cantidad: Number($(this).find("td").eq(5).html()),
                esCombo: false,
            };
        } else {
            detalleProducto = {
                facturaId: Number(correlativo),
                productoMenuId: Number($(this).find("td").eq(1).html()),
                cantidad: Number($(this).find("td").eq(5).html()),
                esCombo: true,
            };
        }
        detalle.detalleVenta.push(detalleProducto);
    });
    detalle.encabezado = {
        metodoPago: metodoPago(),
        facturaId: Number(correlativo),
    };
    $.post(
        "http://localhost/pollofrito/index.php/Asignacion_controller/procesarVenta", { param: detalle}
    ).done(function(response) {
        limpiarCmpsVtsEnc2();
        LastIdV2();
        imprimirNewFac(Number(correlativo));
    }).fail(function() {
        swal({
            title: "Mensaje.!",
            text: "Hubo un error en el proceso",
            icon: "error",
        });
    }).always(function() {
        enableUserInteraction();
    });
}

function enableUserInteraction() {
    let payButton = $("#FacturaSend");
    payButton.prop("disabled", false);
    $("#loading").hide();
}

function disableUserInteraction() {
    let payButton = $("#FacturaSend");
    payButton.prop("disabled", true);
    $("#loading").show();
}

//Inicia funciones para nueva venta

//funcion nueva de factura final

function FacturaFinalV2() {
  const TotalFac = parseFloat($("#txtTotFinal").text());
    disableUserInteraction();

  if (TotalFac == "") {
    swal(
      { title: "Error", text: "No hay datos para facturar", type: "error" },
      function (isOk) {
        if (isOk) {
            enableUserInteraction();
        }
      }
    );
  } else {
    empezarFacturaP();
  }
}

function actualizarencabezado() {
  var tipoPago = metodoPago();
  var Desc = $("#txtDescPor").text();
  var TotalFac = $("#txtTotFinal").text();
  var $factura_id = $("#NoFac").val();
  var value = {
    factura_id: $("#NoFac").val(),
    tipopago: tipoPago,
    total: $("#txtTotFinal").text(),
    descuento: $("#txtDescPor").text(),
  };
  if (
    metodoPago() == "" ||
    $("#txtTotFinal").text() == "" ||
    $("#txtDescPor").text() == ""
  ) {
    alert("error al procesar");
  } else {
    $.ajax({
      type: "POST",
      url: "http://localhost/pollofrito/index.php/Asignacion_controller/insertFactFinal",
      data: value,
      success: function (respuesta) {
        if (respuesta !== 0) {
          swal({
            title: "Correcto..!",
            text: "listo..!",
            type: "success",
            timer: 6000,
          });
            enableUserInteraction();
          limpiarCmpsVtsEnc2();
          LastIdV2();
        }
      },
      error: function (_xhr) {
        // if error occured
        swal({
          title: "Mensaje.!",
          text: "Hubo un error en el proceso",
          icon: "error",
        });
      },
      complete: function () {
          enableUserInteraction();
      },
    });
  }

  $("#PagEfect").attr("disabled", false);
  $("#PagTar").attr("disabled", false);
  $("#PagCheq").attr("disabled", false);
  $("#PagEfect").hide();
  $("#PagTar").hide();
  $("#PagCheq").hide();
  $("#txTotPendDiv").hide();
  $("#TotPagDiv").hide();
  $("select[id=metPago]").val("1");
  $("#PagEfect").val("");
  $("#PagTar").val("");
  $("#PagCheq").val("");
}

function addDetallePV2() {
  $("#listas")
    .find("tr")
    .each(function () {
      $(this).removeAttr("style");
    });
  $("#lista")
    .find("tr")
    .each(function () {
      $(this).removeAttr("style");
    });

  var codProd = document.getElementById("txtCodP").value.trim();
  var BarrasProd = document.getElementById("txtBarras").value;
  var NomProd = document.getElementById("txtNomP").value;
  var DescProd = document.getElementById("txtDescP").value;
  var CantProd = document.getElementById("txtCantP").value;
  var PreUProd = document.getElementById("txtPrecU").value;
  var TotalProd = document.getElementById("txtPrecioT").value;

  //validar cantidad mayor a 0
  var cantidadProducto = parseInt(CantProd);
  if (cantidadProducto > 0 && TotalProd > 0) {
    let details = {
      codProd,
      BarrasProd,
      NomProd,
      DescProd,
      CantProd,
      PreUProd,
      TotalProd,
    };
    // CM:: check if table already contains product if true increase counter
    //      else add registry
    let saleDetail = $("#tblDetalleProd tbody");
    if (saleDetail.html() === "") {
      addRegistry(saleDetail, details);
    } else {
      let registryExist = false;
      let row;
      saleDetail.find("tr").each(function () {
        let barras = $(this).find("td").eq(2).html();
        if (BarrasProd === barras) {
          row = $(this);
          registryExist = true;
        }
      });
      // CM:: add quantity if registry already exists
      // else add new registry
      if (registryExist) {
        row
          .find("td")
          .eq(5)
          .html(
            parseInt(row.find("td").eq(5).html()) + parseInt(details.CantProd)
          );
        row
          .find("td")
          .eq(7)
          .html(
            parseInt(row.find("td").eq(5).html()) *
              parseInt(row.find("td").eq(6).html())
          );
        cleanInputs();
        saveSaleDetail(saleDetail);
      } else {
        addRegistry(saleDetail, details);
      }
    }
  } else {
    swal({
      title: "Debe ingresar la cantidad y producto",
      text: "Cantidad y producto",
      type: "info",
    });
  }
}

//Fin funciones para nueva venta

//FacturaFinalDev

function BtnPagarDev() {
  var coment = $("#commentDev").val();
  var NoFactAnt = $("#NoFactAnt").val();
  if (coment == "" || NoFactAnt == "") {
    swal({
      title: "Verifique",
      text: "No. factura anterior o Comentario",
      type: "warning",
      timer: 1000,
    });
  } else {
    InsertBitDev();
    FacturaFinalDev();
  }
}
function FacturaFinalDev() {
  var tipoPago = metodoPago();
  var bandera = "*";
  var Desc = $("#txtDescPor").text();
  var TotalFac = parseFloat($("#txtTotFinal").text());
  var $factura_id = $("#NoFac").val();
  var dif = parseFloat($("#DifDev").text());
  if (dif < "0") {
    TotalFac = "0";
  } else {
    TotalFac = dif;
  }
  var value = {
    factura_id: $("#NoFac").val(),
    tipopago: tipoPago + bandera,
    total: TotalFac,
    descuento: Desc,
  };
  if (TotalFac == "0.00") {
    swal({ title: "Error", text: "No hay datos a facturar", type: "error" });
  } else {
    $.ajax({
      type: "POST",
      url: "http://localhost/pollofrito/index.php/Asignacion_controller/insertFactFinal",
      data: value,
      beforeSend: function () {
        // setting a timeout
        $("#FacturaSend").attr("disabled", true);
      },
      success: function (respuesta) {
        if (respuesta !== 0) {
          swal({ title: "Correcto..!", text: "listo..!", type: "success" });
          limpiarCampos();
          imprimirNewFac($factura_id);
          $("#FacturaSend").attr("disabled", true);
        }
      },
      error: function (xhr) {
        // if error occured
        swal({
          title: "Mensaje.!",
          text: "Hubo un error en el proceso",
          icon: "error",
        });
      },
      complete: function () {
        $("#FacturaSend").attr("disabled", false);
      },
    });

    $("#PagEfect").attr("disabled", false);

    $("#PagTar").attr("disabled", false);

    $("#PagCheq").attr("disabled", false);

    $("#PagEfect").hide();

    $("#PagTar").hide();

    $("#PagCheq").hide();

    $("#txTotPendDiv").hide();

    $("#TotPagDiv").hide();

    $("select[id=metPago]").val("1");

    $("#PagEfect").val("");

    $("#PagTar").val("");

    $("#PagCheq").val("");
  }
}

function DetalleP() {
  var nofac = $("#NoFac").val();

  if (nofac != 0) {
    var stock = parseInt($("#txtStock").val());

    var Cant = parseInt($("#txtCantP").val());

    if (stock < Cant) {
      swal({
        title: "No cuenta con stock suficiente..!",
        text: "ingrese otra cantidad..!",
        type: "error",
        timer: 800,
      });

      setTimeout('$("#txtCantP").focus()', 900);
    } else {
      $Preciopro = $("#txtPrecioT").val();

      $Cant = $("#txtCantP").val();

      $Precio_pro = $Preciopro / $Cant;

      var value = {
        cantidad: $("#txtCantP").val(),

        Factura_id: $("#NoFac").val(),

        Producto_id: $("#txtCodP").val(),

        Precio_pro: $Precio_pro,
      };

      $.ajax({
        type: "GET",

        url: "http://localhost/pollofrito/index.php/Asignacion_controller/envDetalle",

        data: value,

        success: function (resp) {
          addProdTable(resp);
        },
      });
    }
  } else {
    alert("Debe de empezar detalle");
  }
}

function AgregarStockProv() {
  var Cant = parseInt($("#txtCantP").val());

  var value = {
    cantidad: $("#txtCantP").val(),

    Producto_id: $("#txtCodP").val(),

    PrecioU: $("#txtPrecU").val(),
  };

  $.ajax({
    type: "POST",

    url: "http://localhost/pollofrito/index.php/Asignacion_controller/ActualizarStockProv",

    data: value,

    success: function (resp) {
      swal({
        title: "Stock agregado..!",
        text: "correctamente..!",
        type: "success",
        timer: 800,
      });

      $("#txtBusqueda").val("");

      $("#txtCodP").val("");

      $("#txtNomP").val("");

      $("#txtBarras").val("");

      $("#txtStock").val("");

      $("#txtDescP").val("");

      $("#txtCantP").val("");

      $("#txtPrecU").val("");

      $("#txtPrecioT").val("");

      setTimeout('$("#txtBusqueda").focus()', 900);
    },
  });
}

function AgregarDev() {
  var idPr = $("txtCodP").val();

  var value = {
    cantidad: $("#txtCantP").val(),

    Producto_id: $("#txtCodP").val(),

    PrecioU: $("#txtPrecU").val(),
  };

  $.ajax({
    type: "POST",

    url: "http://localhost/pollofrito/index.php/Asignacion_controller/ActualizarStockProv",

    data: value,

    success: function (resp) {
      if (resp != 0) {
        addProdTableDev();
      }

      $("#txtBusqueda").val("");

      $("#txtCodP").val("");

      $("#txtNomP").val("");

      $("#txtBarras").val("");

      $("#txtStock").val("");

      $("#txtDescP").val("");

      $("#txtCantP").val("");

      $("#txtPrecU").val("");

      $("#txtPrecioT").val("");

      setTimeout('$("#txtBusqueda").focus()', 100);
    },
  });
}

function InsertBitDev() {
  var value = {
    comentario: $("#commentDev").val(),

    idFactura: $("#NoFac").val(),

    MontoDif: $("#DifDev").text(),

    NoFacAnt: $("#NoFactAnt").val(),

    MontoActual: $("#txtTotDev").text(),
  };

  $.ajax({
    type: "POST",

    url: "http://localhost/pollofrito/index.php/Asignacion_controller/insertDev",

    data: value,

    success: function (resp) {
      if (resp != 0) {
      }
    },
  });
}

function addProdTableDev() {
  var codProd = document.getElementById("txtCodP").value;

  var BarrasProd = document.getElementById("txtBarras").value;

  var NomProd = document.getElementById("txtNomP").value;

  var DescProd = document.getElementById("txtDescP").value;

  var CantProd = document.getElementById("txtCantP").value;

  var PreUProd = document.getElementById("txtPrecU").value;

  var TotalProd = document.getElementById("txtPrecioT").value;

  //contador para asignar id al boton que borrara la fila

  var i = 1;

  var fila =
    '<tr id="row' +
    codProd +
    '"><td style="display: none">' +
    codProd +
    '</td><td style="display: none">' +
    codProd +
    "</td><td>" +
    BarrasProd +
    "</td><td>" +
    NomProd +
    "</td><td>" +
    DescProd +
    "</td><td>" +
    CantProd +
    "</td><td>" +
    PreUProd +
    '</td><td class="subtotalDev">' +
    TotalProd +
    '</td><td><button type="button" name="remove" id="' +
    i +
    '" class="btn btn-danger btn_removeDev "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila

  //var fila = '<tr id="row' + i + '"><td>' + codProd + '</td><td>' + BarrasProd + '</td><td>' + NomProd + '</td><td>' + DescProd + '</td><td>' + CantProd + '</td><td>' + PreUProd + '</td><td class="subtotal">' + TotalProd + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila

  i++;

  $("#tblProductoDev tbody").append(fila);

  var codProd = (document.getElementById("txtBusqueda").value = "");

  var codProd = (document.getElementById("txtCodP").value = "");

  var BarrasProd = (document.getElementById("txtBarras").value = "");

  var NomProd = (document.getElementById("txtNomP").value = "");

  var DescProd = (document.getElementById("txtDescP").value = "");

  var StockProd = (document.getElementById("txtStock").value = "");

  var CantProd = (document.getElementById("txtCantP").value = "0");

  var PreUProd = (document.getElementById("txtPrecU").value = "0");

  var TotalProd = (document.getElementById("txtPrecioT").value = "0");

  var CodProdFoc = document.getElementById("txtBusqueda").focus();

  calcularNetoDev();
}

function ElimninaDetalleP(idProd, Cant, IdDetVent) {
  var value = {
    idFactura: $("#NoFac").val(),

    idProd: idProd,

    Cantidad: Cant,

    idDetalleVent: IdDetVent,
  };

  $.ajax({
    type: "POST",

    url: "http://localhost/pollofrito/index.php/Asignacion_controller/EliminaDetalle",

    data: value,

    success: function (resp) {
      if (resp != 0) {
        $("#row" + IdDetVent).remove();
      }
    },
  });
}

function ElimninaDetalleDev(idProd, Cant) {
  var value = {
    idProd: idProd,

    Cantidad: Cant,
  };

  $.ajax({
    type: "POST",

    url: "http://localhost/pollofrito/index.php/Asignacion_controller/EliminaDetalleDevP",

    data: value,

    success: function (resp) {
      if (resp != 0) {
        $("#row" + idProd).remove();
      }
    },
  });
}

function addProdTable(idDetVent) {
  var NoFact = parseInt($("#NoFac").text());

  var codProd = document.getElementById("txtCodP").value;

  var BarrasProd = document.getElementById("txtBarras").value;

  var NomProd = document.getElementById("txtNomP").value;

  var DescProd = document.getElementById("txtDescP").value;

  var CantProd = document.getElementById("txtCantP").value;

  var PreUProd = document.getElementById("txtPrecU").value;

  var TotalProd = document.getElementById("txtPrecioT").value;

  //contador para asignar id al boton que borrara la fila

  var i = 1;

  var fila =
    '<tr id="row' +
    idDetVent +
    '"><td style="display: none">' +
    idDetVent +
    '</td><td style="display: none">' +
    codProd +
    "</td><td>" +
    BarrasProd +
    "</td><td>" +
    NomProd +
    "</td><td>" +
    DescProd +
    "</td><td>" +
    CantProd +
    "</td><td>" +
    PreUProd +
    '</td><td class="subtotal">' +
    TotalProd +
    '</td><td><button type="button" name="remove" id="' +
    i +
    '" class="btn btn-danger btn_remove "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila

  //var fila = '<tr id="row' + i + '"><td>' + codProd + '</td><td>' + BarrasProd + '</td><td>' + NomProd + '</td><td>' + DescProd + '</td><td>' + CantProd + '</td><td>' + PreUProd + '</td><td class="subtotal">' + TotalProd + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila

  i++;

  $("#tblProducto tbody").append(fila);

  var codProd = (document.getElementById("txtBusqueda").value = "");

  var codProd = (document.getElementById("txtCodP").value = "");

  var BarrasProd = (document.getElementById("txtBarras").value = "");

  var NomProd = (document.getElementById("txtNomP").value = "");

  var DescProd = (document.getElementById("txtDescP").value = "");

  var StockProd = (document.getElementById("txtStock").value = "");

  var CantProd = (document.getElementById("txtCantP").value = "0");

  var PreUProd = (document.getElementById("txtPrecU").value = "0");

  var TotalProd = (document.getElementById("txtPrecioT").value = "0");

  var CodProdFoc = document.getElementById("txtBusqueda").focus();

  calcularNeto();

  totalTotProd();

  DifDevolucion();
}

function leerDatspspr() {
  $.get(
    "http://localhost/pollofrito/index.php/Producto_controller/tablaProductoVent",
    {},

    function (data, status) {
      //$("#tabla").html(data);

      //  alert(data);

      var valores = eval(data);

      html =
        "<table class='table table-hover'><thead><tr><th>ID</th><th>BARRAS</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CATEGORIA</th><th>STOCK</th><th>SELECCIONAR</th></tr></thead><tbody>";

      for (i = 0; i < valores.length; i++) {
        datos =
          valores[i]["idgs_producto"] +
          "*" +
          valores[i]["codigo"] +
          "*" +
          valores[i]["nombre"] +
          "*" +
          valores[i]["descripcion"] +
          "*" +
          valores[i]["NombreCat"] +
          "*" +
          valores[i]["stock"];

        html +=
          "<tr><td>" +
          valores[i]["idgs_producto"] +
          "</td><td>" +
          valores[i]["codigo"] +
          "</td><td>" +
          valores[i]["nombre"] +
          "</td><td>" +
          valores[i]["descripcion"] +
          "</td><td>" +
          valores[i]["NombreCat"] +
          "</td><td>" +
          valores[i]["stock"] +
          "</td><td><button type='button' class='btn btn-primary btn-sm' name='agregar' id='" +
          i +
          "'><span class='glyphicon glyphicon-ok btn_add'></span></button></td></tr>";
      }

      html += "</tbody></table>";

      $("#lista").html(html);
    }
  );
}

function cacularP() {
  var Cant = $("#txtCantP").val();

  var preU = $("#txtPrecU").val();

  var resultado = parseFloat(Cant) * parseFloat(preU);

  $("#txtPrecioT").val(resultado);
}

function calcularNeto() {
  var total = 0;

  $(".subtotal").each(function () {
    total += parseFloat($(this).html()) || 0;
  });

  document.getElementById("txtTotNeto").innerHTML = total.toFixed(2);
}

function calcularNetoDev() {
  var total = 0;

  $(".subtotalDev").each(function () {
    total += parseFloat($(this).html()) || 0;
  });

  document.getElementById("txtTotDev").innerHTML = total.toFixed(2);
}

function calcularDescuento() {
  var DescProd = $("#txtDescuen").val();

  var NetoPro = $("#txtTotNeto").text();

  var Porcentaje = parseFloat(DescProd) * parseFloat(NetoPro);

  var Desc = parseFloat(Porcentaje / 100);

  document.getElementById("txtDescPor").innerHTML = Desc.toFixed(2);
}

function totalTotProd() {
  var NetoPr = $("#txtTotNeto").text();

  var DescPor = $("#txtDescPor").text();

  var TotalFin = parseFloat(NetoPr) - parseFloat(DescPor);

  document.getElementById("txtTotFinal").innerHTML = TotalFin.toFixed(2);

  document.getElementById("TotPagDiv").innerHTML = TotalFin.toFixed(2);
}

function calculaCambio() {
  var Efectivo = $("#txtEfectivo").val();

  var TotFinProd = $("#txtTotFinal").text();

  var Cambio = parseFloat(Efectivo) - parseFloat(TotFinProd);

  $("#txtCambio").val(Cambio.toFixed(2));
}

function calculaCambioDev() {
  var Efectivo = $("#txtEfectivo").val();

  var TotFinProd = $("#DifDev").text();

  var Cambio = parseFloat(Efectivo) - parseFloat(TotFinProd);

  $("#txtCambio").val(Cambio.toFixed(2));
}

function nuevoCl() {
  var nitNuevo = $("#txtNit").val();

  var nombreNuevo = $("#txtNombreCl").val();

  var direccionNuevo = $("#txtDirec").val();

  var completar = "";

  if (nitNuevo == "") {
    completar = completar + " Nit ";
  }

  if (nombreNuevo == "") {
    completar = completar + "Nombre ";
  }

  if (direccionNuevo == "") {
    completar = completar + "Direccion";
  }

  if (nitNuevo == "" || nombreNuevo == "" || direccionNuevo == "") {
    swal({
      title: "Complete los datos del cliente",
      text: "Faltan los datos " + completar,
      type: "error",
    });
  } else {
    var value = {
      nitCl: $("#txtNit").val(),

      nombreCl: $("#txtNombreCl").val(),

      DireccionCl: $("#txtDirec").val(),
    };

    $.ajax({
      type: "POST",

      url: "http://localhost/pollofrito/index.php/Asignacion_controller/insertCl",

      data: value,

      success: function (resp) {
        if (resp != 0) {
          $("#txtId").val(resp);

          $("#btnEmpD").focus();

          swal({
            title: "Cliente Guardado Correctamente..!",
            text: "listo..!",
            type: "success",
            timer: 800,
          });
        }
      },
    });
  }
}

function EnviaPagDiv(idTiPag, Monto) {
  var value = {
    Monto: Monto,

    idFactura: $("#NoFac").val(),

    idTPago: idTiPag,
  };

  $.ajax({
    type: "GET",

    url: "http://localhost/pollofrito/index.php/Asignacion_controller/insertTipoPago",

    data: value,

    success: function (resp) {
      if (resp != 0) {
        swal({
          title: "Pago efectivo..!",
          text: "Registrado..!",
          type: "success",
          timer: 900,
        });
      }
    },
  });
}

function LastId() {
  $.get(
    "http://localhost/pollofrito/index.php/Facturacion_controller/ultimoIdFac",
    {},

    function (data, status) {
      var valores = eval(data);

      var numFact = parseInt(valores[0]["idgs_factura"]);

      $("#NoFac").val(numFact);

      //  document.getElementById('NoFac').innerHTML = numFact;

      // alert(numFact);
    }
  );
}

function LastIdV2() {
  $.get(
    "http://localhost/pollofrito/index.php/Facturacion_controller/ultimoIdFac",
    {},

    function (data, status) {
      var valores = eval(data);

      var numFact = parseInt(valores[0]["idgs_factura"]);

      $("#NoFac").val(numFact + 1);
    }
  );
}

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

function loadSaleDetail() {
  let url = window.location.href;
  let lastMethod = url.substring(url.lastIndexOf("/") + 1, url.length);
  if (lastMethod.toLowerCase() !== "empezarmenu") {
    $.get(
      "http://localhost/pollofrito/index.php/Asignacion_controller/getSaleDetail",
      function (saleDetail) {
        $("#tblDetalleProd tbody").html(saleDetail);
        $("#tblDetalleProd tbody tr").each(function () {
          var desc = $(this).find("td").eq(4).html();
          if (desc.toUpperCase() === "COMBO") {
            getMenuDetail($(this).find("td").eq(2).html());
          }
        });
        calcularNeto();
        totalTotProd();
      }
    );
  }
}

$(document).ready(function () {
  $("#loading").hide();
  LastIdV2();
  loadSaleDetail();
});

function metodoPago() {
  var MetPago = document.getElementById("metPago").value;

  var TipoPago = "";

  if (MetPago === "1") {
    TipoPago = "Efectivo";

    return TipoPago;
  } else if (MetPago === "2") {
    TipoPago = "Tarjeta";

    return TipoPago;
  } else if (MetPago === "3") {
    TipoPago = "Cheque";

    return TipoPago;
  } else if (MetPago === "4") {
    TipoPago = "Dividido";

    return TipoPago;
  }
}

function limpiarCampos() {
  $("#txtId").val("1");

  $("#txtNit").val("C/F");

  $("#txtNombreCl").val("C/F");

  $("#txtDirec").val("Ciudad");

  setTimeout($("#NoFac").val(""), 1200);

  $("#contTbl").empty();

  $("#contTblDev").empty();

  $("#txtDescuen").val("");

  $("#txtEfectivo").val("");

  $("#txtCambio").val("");

  $("#txtPrecioT").val("");

  $("#txtPrecNormal").val("");

  $("#txtPrecFrecuente").val("");

  $("#txtPrecMayoreo").val("");

  $("#commentDev").val("");

  $("#NoFactAnt").val("");

  document.getElementById("txtTotNeto").innerHTML = "0.00";

  document.getElementById("txtDescPor").innerHTML = "0";

  document.getElementById("txtTotFinal").innerHTML = "0.00";

  //document.getElementById('txtTotDev').innerHTML = '0';

  //document.getElementById('DifDev').innerHTML = '0';

  $("#btnEmpD").attr("disabled", true);

  setTimeout("InciarFocus()", 1500);
}

function InciarFocus() {
  $("#txtNit").focus();
}

function imprimir($factura_id) {
  window.open(
    "http://localhost/pollofrito/index.php/Asignacion_controller/tiket/" +
      $factura_id
  );
}

function imprimirNewFac($factura_id) {
  $("#txtBusqueda").prop("readonly", false);

  window.open(
    "http://localhost/pollofrito/index.php/Asignacion_controller/FacturaNV/" +
      $factura_id
  );
}

function AcceSistema($factura_id) {
  if ($factura_id == 1) {
    location.replace(
      "http://localhost/pollofrito/index.php/archivo/index2/"
    );
  }

  if ($factura_id == 2) {
    location.replace(
      "http://localhost/pollofrito2/index.php/archivo/index/"
    );
  }
}

function DetalleFact(idFact) {
  var value = {
    idFactura: idFact,
  };

  //ajax para datos del producto factura

  $.ajax({
    url: "http://localhost/pollofrito/index.php/Asignacion_controller/dtosFactura",

    type: "POST",

    data: value,
  }).done(function (resp) {
    if (resp != "0") {
      var valores = eval(resp);

      html =
        "<thead><tr><th class='cantidad'>CANT</th><th class='producto'>PRODUCTO</th><th class='precio'>TOTAL. Q.</th></tr></thead><tbody>";

      for (i = 0; i < valores.length; i++) {
        // var idImp = valores[i]['NoFactura'];

        html +=
          "<tr><td class='cantidad'>" +
          valores[i]["cantidad"] +
          "</td><td class='producto'>" +
          valores[i]["descripcion"] +
          "</td><td  class='precio'>" +
          parseFloat(valores[i]["precio"]) +
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

  //datos para combo de factura

  $.ajax({
    url: "http://localhost/pollofrito/index.php/Asignacion_controller/dtosFacturaMenu",

    type: "POST",

    data: value,
  }).done(function (resp) {
    console.log(resp);

    if (resp != "0") {
      var valores = eval(resp);

      html =
        "<thead><tr><th class='cantidad'>CANT</th><th class='producto'>COMBO</th><th class='precio'>TOTAL. Q.</th></tr></thead><tbody>";

      for (i = 0; i < valores.length; i++) {
        // var idImp = valores[i]['NoFactura'];

        html +=
          "<tr><td class='cantidad'>" +
          valores[i]["cantidad"] +
          "</td><td class='producto'>" +
          valores[i]["descripcion"] +
          "</td><td  class='precio'>" +
          parseFloat(valores[i]["precio"]) *
            parseFloat(valores[i]["cantidad"]) +
          "</td></tr>";
      }

      html += "</tbody></table>";

      $("#listaDetalleMenu").html(html);
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

function EncabezadoFact(idFact) {
  var value = {
    idFactura: idFact,
  };

  $.ajax({
    url: "http://localhost/pollofrito/index.php/Asignacion_controller/EncabFactura",

    type: "POST",

    data: value,
  }).done(function (resp) {
    var valores = eval(resp);

    var currentdate = new Date();

    var datetime =
      currentdate.getDate() +
      "/" +
      (currentdate.getMonth() + 1) +
      "/" +
      currentdate.getFullYear() +
      " - " +
      currentdate.getHours() +
      ":" +
      currentdate.getMinutes() +
      ":" +
      currentdate.getSeconds();

    document.getElementById("Fecha").innerHTML = datetime;

    document.getElementById("NoCompra").innerHTML = valores[0]["factura"];

    document.getElementById("Nombre").innerHTML = valores[0]["cliente"];

    document.getElementById("Nit").innerHTML = valores[0]["nitcliente"];

    document.getElementById("Direccion").innerHTML =
      valores[0]["direccion_cont"];

    document.getElementById("subTotal").innerHTML =
      parseFloat(valores[0]["descuento"]) + parseFloat(valores[0]["total"]);

    document.getElementById("Descuento").innerHTML = valores[0]["descuento"];

    document.getElementById("Total").innerHTML = valores[0]["total"];

    document.getElementById("Fecha").innerHTML = valores[0]["fecha"];
  });
}

function calcularDescNormal() {
  //alert('Hola mundo');

  var CantiP = $("#txtCantP").val();

  var PrecioNormal = $("#txtPrecNormal").val();

  var resultado = parseFloat(CantiP) * parseFloat(PrecioNormal);

  $("#txtPrecioT").val(resultado);
}

function calcularDescFrecuente() {
  //alert('Hola mundo');

  var CantiP = $("#txtCantP").val();

  var PrecioNormal = $("#txtPrecFrecuente").val();

  var resultado = parseFloat(CantiP) * parseFloat(PrecioNormal);

  $("#txtPrecioT").val(resultado);
}

function calcularDescMayoreo() {
  //alert('Hola mundo');

  var CantiP = $("#txtCantP").val();

  var PrecioNormal = $("#txtPrecMayoreo").val();

  var resultado = parseFloat(CantiP) * parseFloat(PrecioNormal);

  $("#txtPrecioT").val(resultado);
}

function calcularDescVenta() {
  //alert('Hola mundo');

  var CantiP = $("#txtCantP").val();

  var PrecioNormal = $("#txtPrecU").val();

  var resultado = parseFloat(CantiP) * parseFloat(PrecioNormal);

  $("#txtPrecioT").val(resultado);
}

function limpiarCmpsVtsEnc2() {
  //   $('#NoFac').val('');

  $("#lista").empty("");

  $("#txtNomP").val("");

  $("#txtStock").val("");

  $("#txtCantP").val("");

  $("#txtPrecU").val("");

  $("#txtPrecNormal").val("");

  $("#txtPrecFrecuente").val("");

  $("#txtPrecMayoreo").val("");

  $("#txtPrecioT").val("");

  $("#contTbl").empty("");

  //$('#txtTotNeto').val('0.00');

  //$('#txtTotFinal').val('0.00');

  document.getElementById("txtTotFinal").innerHTML = "0.00";

  document.getElementById("txtTotNeto").innerHTML = "0.00";
}

function addRegistry(saleDetail, details) {
  //contador para asignar id al boton que borrara la fila
  var i = 1;
  var fila =
    '<tr id="row' +
    details.codProd +
    '"><td style="display: none">' +
    details.codProd +
    '</td><td style="display: none">' +
    details.codProd +
    "</td><td>" +
    details.BarrasProd +
    "</td><td>" +
    details.NomProd +
    "</td><td>" +
    details.DescProd +
    "</td><td>" +
    details.CantProd +
    "</td><td>" +
    details.PreUProd +
    '</td><td class="subtotal">' +
    details.TotalProd +
    '</td><td><button type="button"  name="remove" id="' +
    i +
    '" class="btn btn-danger btn_removeDetalle "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila
  //var fila = '<tr id="row' + i + '"><td>' + codProd + '</td><td>' + BarrasProd + '</td><td>' + NomProd + '</td><td>' + DescProd + '</td><td>' + CantProd + '</td><td>' + PreUProd + '</td><td class="subtotal">' + TotalProd + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove "><span class="glyphicon glyphicon-trash"></span></button></td></tr>'; //esto seria lo que contendria la fila
  i++;
  saleDetail.append(fila);
  cleanInputs();
  saveSaleDetail(saleDetail);
}

function cleanInputs() {
  document.getElementById("txtBusqueda").value = "";
  document.getElementById("txtCodP").value = "";
  document.getElementById("txtBarras").value = "";
  document.getElementById("txtNomP").value = "";
  document.getElementById("txtDescP").value = "";
  document.getElementById("txtStock").value = "";
  document.getElementById("txtCantP").value = "0";
  document.getElementById("txtPrecU").value = "0";
  document.getElementById("txtPrecNormal").value = "0";
  document.getElementById("txtPrecMayoreo").value = "0";
  document.getElementById("txtPrecioT").value = "0";
  document.getElementById("txtBusqueda").focus();
}

function saveSaleDetail(saleDetail) {
  calcularNeto();
  totalTotProd();
  $.post(
    "http://localhost/pollofrito/index.php/Asignacion_controller/saveSaleDetail",
    { param: saleDetail.html() }
  );
}

function removeHeader(factura_id) {
  $.ajax({
    url: "http://localhost/pollofrito/index.php/Asignacion_controller/removeHeader",
    data: { factura_id: factura_id },
    type: "POST",
  }).done(function (_resp) {
    swal({
      title: "Error",
      text: "Se encontró un error al procesar la venta, favor intentar nuevamente",
      type: "error",
    });
  });
}
