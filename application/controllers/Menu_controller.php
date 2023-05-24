<?php if (!defined("BASEPATH")) {
  exit("No direct script access allowed");
}

class Menu_controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper("form");
    $this->load->model("Menu_modelo");
    $this->load->library("session");
    $this->load->helper("url");
    // $this->load->library('form_validation');
  }

  public function empezarMenu()
  {
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Usuarios/educacion_menu");
    $this->load->view("/Menus/Menu_vista");
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function editaCancelaEncargo()
  {
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Usuarios/educacion_menu");
    $this->load->view("/Encargos/Encargo_Vista-EditCancel");
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function entregarPedidos()
  {
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Usuarios/educacion_menu");
    $this->load->view("/Encargos/Entrega_vista");
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function tiendas()
  {
    $this->load->view("/dependencias");
    $this->load->view("/Usuarios/educacion_inicio");
    $this->load->view("/Usuarios/educacion_menu");
    $this->load->view("/Menus/Menu_vista");
    $this->load->view("/Usuarios/educacion_pie");
  }

  public function GuardarMenu()
  {
    $res = $this->Menu_modelo->SvMenu($_POST);
    echo json_encode($res);
  }

  public function InsertEncPedido()
  {
    $res = $this->Encargo_modelo->InsEncPed($_POST);
    echo json_encode($res);
  }

  public function InsertDetPedido()
  {
    $res = $this->Encargo_modelo->InsDetPed($_POST);
    echo json_encode($res);
  }

  public function EditarCombo()
  {
    $res = $this->Menu_modelo->EditCombo($_POST);
    echo json_encode($res);
  }

  public function cancelaPedEnc()
  {
    $res = $this->Encargo_modelo->CancelarPedEn($_POST);
    echo json_encode($res);
  }

  public function obtenerCombo()
  {
    $res = $this->Menu_modelo->obtenerAllCombo();
    echo json_encode($res);
  }

  public function obtenerLstaPedidos()
  {
    $res = $this->Encargo_modelo->obtenerListaPeds();
    echo json_encode($res);
  }

  public function listaProductos()
  {
    $res = $this->Menu_modelo->ListarProducto();
    echo json_encode($res);
  }

  public function listaCombos()
  {
    $res = $this->Menu_modelo->ListarCombos();
    echo json_encode($res);
  }

  public function listaCombosVent()
  {
    $res = $this->Menu_modelo->ListarCombosVent();
    echo json_encode($res);
  }

  public function editPedEnc()
  {
    $res = $this->Encargo_modelo->editPedEncargo($_POST);
    echo json_encode($res);
  }

  public function asignarCombo()
  {
    $res = $this->Menu_modelo->AsignarCombo($_POST);
    echo json_encode($res);
  }

  public function eliminarDetPedP()
  {
    if (!empty($_POST)) {
      $this->Encargo_modelo->delDetProdP($_POST);
    }
    $this->load->view("/Productos/product_tabla");
  }

  public function UpdtEncPedido()
  {
    $res = $this->Encargo_modelo->upEncabezdoPedP($_POST);
    echo json_encode($res);
  }

  public function UpdtEncPedidoBefEditar()
  {
    $res = $this->Encargo_modelo->upEncabezdoPedPBefEdit($_POST);
    echo json_encode($res);
  }

  public function verDetPedEnc()
  {
    $res = $this->Encargo_modelo->verDtPedEnca($_POST);
    echo json_encode($res);
  }

  public function InsertPagosDiv()
  {
    $res = $this->Encargo_modelo->InsPgDivs($_POST);
    echo json_encode($res);
  }

  public function ActualizaDetPedido()
  {
    $res = $this->Encargo_modelo->UpdateDetPed($_POST);
    echo json_encode($res);
  }

  public function actualizaFinEncaPed()
  {
    $res = $this->Encargo_modelo->UpFinalEnc($_POST);
    echo json_encode($res);
  }

  public function TicketPedido($factura_id)
  {
    $this->load->view("/dependencias");
    $this->load->view("/Encargos/TicketPedEncargo_vista", false);
    echo "<span id='NoImpTicket' style='display: none;'> {$factura_id}</span>";
  }

  public function TicketEnctrega($factura_id)
  {
    $this->load->view("/dependencias");
    $this->load->view("/Encargos/TicketPedEntrega_vista", false);
    echo "<span id='NoImpTicket' style='display: none;'> {$factura_id}</span>";
  }

  public function EncabTicket()
  {
    $res = $this->Encargo_modelo->EncabezadoTicket($_POST);
    echo json_encode($res);
  }

  public function DetTicket()
  {
    $res = $this->Encargo_modelo->DetalleTicket($_POST);
    echo json_encode($res);
  }

  public function TotalPagoHoy()
  {
    $res = $this->Encargo_modelo->PagosHoy($_POST);
    echo json_encode($res);
  }

  public function getComboDetail()
  {
    $res = $this->Menu_modelo->getComboProductDetail($_GET);
    echo json_encode($res);
  }

  public function updateComboDetail()
  {
    $res = $this->Menu_modelo->updateComboDetail($_POST["menuDetail"]);
    echo json_encode($res);
  }
  public function deleteComboDetail()
  {
    $res = $this->Menu_modelo->deleteComboDetail($_POST["menuDetail"]);
    echo json_encode($res);
  }

  public function asignarProductoPreparado()
  {
    $res = $this->Menu_modelo->AsignarProductoPreparado($_POST);
    echo json_encode($res);
  }

  public function listaProductoPreparado()
  {
    $res = $this->Menu_modelo->ListarProductoPreparado();
    echo json_encode($res);
  }

  public function getProductoPreparadoDetail()
  {
    $res = $this->Menu_modelo->getProductoPreparadoDetail($_GET);
    echo json_encode($res);
  }

  public function deleteProductoPreparadoDetail()
  {
    $res = $this->Menu_modelo->deleteProductoPreparadoDetail(
      $_POST["productoPreparadoDetail"]
    );
    echo json_encode($res);
  }

  public function EditarProductoPreparado()
  {
    $res = $this->Menu_modelo->EditProductoPreparado($_POST);
    echo json_encode($res);
  }

  public function updateProductoPreparadoDetail()
  {
    $res = $this->Menu_modelo->updateProductoPreparadoDetail(
      $_POST["productoDetail"]
    );
    echo json_encode($res);
  }
}
