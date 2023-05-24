<?php if (!defined("BASEPATH")) {
  exit("No direct script access allowed");
}

class Asignacion_controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper("form");
    $this->load->model("Asignacion_modelo");
    $this->load->library("session");
    $this->load->helper("url");

    // $this->load->library('form_validation');
  }

  public function Logout()
  {
    $this->load->library("session");
    $this->session->sess_destroy();
    header(
      "Location:" .
        base_url("/pollofrito/index.php/Reportes/educacion_menu_login")
    );
  }

  public function empezarVenta()
  {
    $res = $this->Asignacion_modelo->ListarClientes();

    $data["clientes"] = json_encode($res);
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Asignacion/factura", $data);
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function empezarDetVent()
  {
    $res = $this->Asignacion_modelo->ListarClientes();
    $data["clientes"] = json_encode($res);
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Usuarios/educacion_menu");
    $this->load->view("/Asignacion/VentaDetalle", $data);
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function empezarDetVentTrans()
  {
    $res = $this->Asignacion_modelo->ListarClientes();
    $data["clientes"] = json_encode($res);
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Usuarios/educacion_menu");
    $this->load->view("/Asignacion/VentaDetalleTransaccion", $data);
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function empezarVentaDigitalizador()
  {
    $res = $this->Asignacion_modelo->ListarClientes();
    $data["clientes"] = json_encode($res);
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function ventaDetDig()
  {
    $res = $this->Asignacion_modelo->ListarClientes();
    $data["clientes"] = json_encode($res);
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Asignacion/VentaDetalleDigitalizador", $data);
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function FacturaNV($factura_id)
  {
    // $factura_id = '?value = 123';
    //actualizamos el total

    $total = $this->Asignacion_modelo->sumaDetallesFactura($factura_id);
    $this->load->view("/dependencias");
    $this->load->view("/Asignacion/FacturaVen", false);
    echo "<span id='NoImpFac' style='display: none;'>{$factura_id}</span>";

    //Redirect('http:/pgsantiago/index.php/Asignacion_controller/empezarDetalleDigitalizador/'.$factura_id, false);
  }

  public function vender()
  {
    $fecha = date("Y-m-d H:i:s");

    if (!empty($_POST)) {
      // print_r($_POST['usuario']);

      $params = [
        "fecha" => $fecha,
        "metododepago" => null,
        "total" => null,
        "cliente" => $_POST["cliente"],
        "usuario" => $_POST["usuario"],
        "estado" => 0,
      ];
    } else {
      $params = [
        "fecha" => [0],
        "metododepago" => [0],
        "total" => [0],
        "cliente" => [0],
        "usuario" => [0],
        "estado" => [0],
      ];
    }

    $factura_id = $this->Asignacion_modelo->insertFactura($params);
    $data["factura_id"] = $factura_id;
    // Redirect('http:/pgsantiago/index.php/Asignacion_controller/empezarDetalle/'.$factura_id, false);

    Redirect(
      "https:/pollofrito/index.php/Asignacion_controller/empezarDetalle/" .
        $factura_id,
      false
    );
  }

  public function venderDigitalizador()
  {
    $fecha = date("Y-m-d H:i:s");

    if (!empty($_POST)) {
      // print_r($_POST['usuario']);

      $params = [
        "fecha" => $fecha,
        "metododepago" => null,
        "total" => null,
        "cliente" => $_POST["cliente"],
        "usuario" => $_POST["usuario"],
        "estado" => 0,
      ];
    } else {
      $params = [
        "fecha" => [0],
        "metododepago" => [0],
        "total" => [0],
        "cliente" => [0],
        "usuario" => [0],
        "estado" => [0],
      ];
    }

    $factura_id = $this->Asignacion_modelo->insertFactura($params);

    $data["factura_id"] = $factura_id;

    Redirect(
      "https:/pollofrito/index.php/Asignacion_controller/empezarDetalleDigitalizador/" .
        $factura_id,
      false
    );
  }

  // R de Leon

  public function insertFactEncabezado()
  {
    // $fecha = date('Y-m-d H:i:s');
    $this->session->unset_userdata("saleDetail");
    $res = $this->Asignacion_modelo->insertFactura($_POST);
    echo json_encode($res);
  }

  //R de Leon

  public function insertFactFinal()
  {
      $encabezado = $this->input->post("param")["encabezado"];
    $params = [
      "factura_id" => $encabezado["facturaId"],
      "tipopago" => $encabezado["metodoPago"],
    ];
    $salida = "";
    if (
      $params["factura_id"] == "" ||
      $params["tipopago"] == ""
    ) {
      $salida = "";
    } else {
      $res = $this->Asignacion_modelo->EditarFactura($params);
      $salida = $res;
    }
    //$id = $res;

    //$updateSuma = $this->Asignacion_modelo->sumaDetallesFactura($id);
    echo $salida;
  }

  //R de Leon

    public function procesarVenta() {
        $detalleArray = $this->input->post("param")["detalleVenta"];
        foreach($detalleArray as $detalle) {
            $esCombo = $detalle["esCombo"];
            if (filter_var($esCombo, FILTER_VALIDATE_BOOLEAN)) {
                $this->envDetalleProdMenu($detalle);
            } else {
                $this->envDetalle($detalle);
            }
        }
        echo json_encode($this->insertFactFinal());
    }

  public function envDetalle($detalle)
  {
    $params = [
      "cantidad" => $detalle["cantidad"],
      "Factura_id" => $detalle["facturaId"],
      "Producto_id" => $detalle["productoMenuId"],
      "Precio_pro" => $this->getProductPrice($detalle["productoMenuId"]),
    ];

    $res = $this->Asignacion_modelo->insertDetProd($params);
    echo json_encode($res);
  }

  public function envDetalleProdMenu($detalle)
  {
      $listaProductos = $this->Asignacion_modelo->obtenerListaProductosMenu($detalle["productoMenuId"]);

      foreach($listaProductos as $producto) {
          $params = [
              "cantidad" => $producto->Cantidad,
              "Factura_id" => $detalle["facturaId"],
              "Producto_id" => $producto->producto_id,
              "Precio_pro" => $producto->precio_producto_menu,
              "Menu_id" => $detalle["productoMenuId"],
              "CantidadMenu" => $detalle["cantidad"],
          ];

          $res = $this->Asignacion_modelo->actualizarProd($params);
      }

    echo json_encode($res);
  }

  function getProductPrice($product_id)
  {
    $price = $this->Asignacion_modelo->getProductPrice($product_id)[0]
      ->precio_venta;
    return $price;
  }

  public function envDetalleMenu()
  {
    $res = $this->Asignacion_modelo->consultProdMenu($_GET["combo"]);
    echo json_encode($res);
  }

  public function ActualizarStockProv()
  {
    $params = [
      "cantidad" => $_POST["cantidad"],
      "Producto_id" => $_POST["Producto_id"],
      "PrecioU" => $_POST["PrecioU"],
    ];

    $res = $this->Asignacion_modelo->AgregarStockM($params);
    echo json_encode($res);
  }

  //R de Leon elimina una fila del detalle venta

  public function EliminaDetalle()
  {
    $params = [
      "fac" => $_POST["idFactura"],
      "cod" => $_POST["idProd"],
      "cant" => $_POST["Cantidad"],
      "id" => $_POST["idDetalleVent"],
    ];

    $res = $this->Asignacion_modelo->DelProdDet($params);
    echo json_encode($res);
  }

  //R de Leon elimina evolucion de detalle si esta mal

  public function EliminaDetalleDevP()
  {
    $params = [
      "cod" => $_POST["idProd"],
      "cant" => $_POST["Cantidad"],
    ];
    $res = $this->Asignacion_modelo->DelProdDevol($params);
    echo json_encode($res);
  }

  // R de Leon inserta un nuevo Cliente

  public function insertCl()
  {
    $params = [
      "Nit" => $_POST["nitCl"],
      "Nombre" => $_POST["nombreCl"],
      "Direccion" => $_POST["DireccionCl"],
    ];

    $res = $this->Asignacion_modelo->InsertarClien($params);
    echo json_encode($res);
  }
  public function insertTipoPago()
  {
    $params = [
      "Monto" => $_GET["Monto"],
      "idFactu" => $_GET["idFactura"],
      "idTipoPago" => $_GET["idTPago"],
    ];
    $res = $this->Asignacion_modelo->InsertarTipoPag($params);
    echo json_encode($res);
  }

  public function empezarDetalle($factura_id)
  {
    $factura = $this->Asignacion_modelo->SeleccionarFactura($factura_id);
    $data["factura"] = json_encode($factura);
    $data["factura_id"] = $factura_id;
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Asignacion/detalleventa", $data);
    $this->load->view("/Usuarios/educacion_pie");
  }
  public function empezarDetalleDigitalizador($factura_id)
  {
    $factura = $this->Asignacion_modelo->SeleccionarFactura($factura_id);
    $data["factura"] = json_encode($factura);
    $data["factura_id"] = $factura_id;
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Asignacion/detalleventaDigitalizador", $data);
    $this->load->view("/Usuarios/educacion_pie");
  }
  //Codigo R de Leon para insertar informacion en la tabla devolucion
  public function insertDev()
  {
    $params = [
      "comentario" => $_POST["comentario"],
      "idFactura" => $_POST["idFactura"],
      "MontoDif" => $_POST["MontoDif"],
      "NoFacAnt" => $_POST["NoFacAnt"],
      "MontoActual" => $_POST["MontoActual"],
    ];
    $res = $this->Asignacion_modelo->AgregarBitDev($params);
    echo $res;
  }

  function dtosFactura()
  {
    $factura_id = $_POST["idFactura"];
    $resDetalle = $this->Asignacion_modelo->detalleventa($factura_id);
    echo json_encode($resDetalle);
  }
  function dtosFacturaMenu()
  {
    $factura_id = $_POST["idFactura"];
    $resDetalle = $this->Asignacion_modelo->detalleventaMenu($factura_id);
    echo json_encode($resDetalle);
  }
  function EncabFactura()
  {
    $factura_id = $_POST["idFactura"];
    $resEncabezado = $this->Asignacion_modelo->encabezadofactura($factura_id);
    echo json_encode($resEncabezado);
  }

  public function GenerarVenta()
  {
    if (!empty($_POST)) {
      $total = $_POST["txtcaja"];
      $factura_id = $_POST["factura_id"];
      $descuento = $_POST["descuento"];
      // $cash=$_POST['tipopago'];
      // print_r($_POST['tipopago']);
      $params = [
        "factura_id" => $factura_id,
        "tipopago" => $_POST["tipopago"],
        "total" => $total,
        "estado" => 1,
        "descuento" => $descuento,
      ];
    } else {
      $params = [
        "factura_id" => [0],
        "tipopago" => [0],
        "total" => [0],
        "estado" => [0],
        "descuento" => [0],
      ];
    }
    $this->Asignacion_modelo->EditarFactura($params);
    //$data['factura_id']=$factura_id;
    $this->empezarVenta();
    echo " <script> imprimir($factura_id) </script>";
  }
  public function GenerarVentaDigitalizador()
  {
    if (!empty($_POST)) {
      $total = $_POST["txtcaja"];
      $factura_id = $_POST["factura_id"];
      $descuento = $_POST["descuento"];
      // $cash=$_POST['tipopago'];
      // print_r($_POST['tipopago']);
      $params = [
        "factura_id" => $factura_id,
        "tipopago" => $_POST["tipopago"],
        "total" => $total,
        "estado" => 1,
        "descuento" => $descuento,
      ];
    } else {
      $params = [
        "factura_id" => [0],
        "tipopago" => [0],
        "total" => [0],
        "estado" => [0],
        "descuento" => [0],
      ];
    }
    $this->Asignacion_modelo->EditarFactura($params);
    //$data['factura_id']=$factura_id;
    $this->empezarVentaDigitalizador();
    echo " <script> imprimir($factura_id) </script>";
  }

  public function BorrarProducto()
  {
    if (!empty($_POST)) {
      $this->Asignacion_modelo->EliminarProducto($_POST);
    }
  }

  public function arqueoCaja()
  {
    $this->load->view("/dependencias");

    $this->load->view("/Usuarios/educacion_inicio");

    $this->load->view("/Usuarios/educacion_menu");

    $this->load->view("/Caja/arque_caja");

    $this->load->view("/Usuarios/educacion_pie");
  }

  public function devolucionProd()
  {
    $this->load->view("/dependencias");

    $this->load->view("/Usuarios/educacion_inicio");

    $this->load->view("/Usuarios/educacion_menu");

    $this->load->view("/Devoluciones/Dev_Prod");

    $this->load->view("/Usuarios/educacion_pie");
  }

  public function ListarDevolucion()
  {
    $this->load->view("/dependencias");

    $this->load->view("/Usuarios/educacion_inicio");

    $this->load->view("/Usuarios/educacion_menu");

    $this->load->view("/Devoluciones/Lista_Devolucion");

    $this->load->view("/Usuarios/educacion_pie");
  }

  public function listVentasDiar()
  {
    $FechaUno = $_POST["fechaU"];

    $FechaDos = $_POST["fechaD"];

    $res = $this->Asignacion_modelo->SelecVentD($FechaUno, $FechaDos);

    echo json_encode($res);

    //echo $data;
  }

  public function listDevol()
  {
    $FechaUno = $_POST["fechaU"];

    $FechaDos = $_POST["fechaD"];

    $res = $this->Asignacion_modelo->SelecDevTot($FechaUno, $FechaDos);

    echo json_encode($res);

    //echo $data;
  }

  public function listVentasDiv()
  {
    $FechaUno = $_POST["fechaU"];

    $FechaDos = $_POST["fechaD"];

    $res = $this->Asignacion_modelo->SelecVentDiv($FechaUno, $FechaDos);

    echo json_encode($res);

    //echo $data;
  }

  public function saveSaleDetail()
  {
    $this->session->set_userdata("saleDetail", $_POST["param"]);
  }

  public function getSaleDetail()
  {
    echo $this->session->saleDetail;
  }

  public function removeHeader()
  {
    $factura_id = $_POST["factura_id"];
    $res = $this->Asignacion_modelo->removeInvoice($factura_id);
    echo json_encode($res);
  }
}

?>
