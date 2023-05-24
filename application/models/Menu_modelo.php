<?php if (!defined("BASEPATH")) {
  exit("No direct script access allowed");
}

date_default_timezone_set("America/Guatemala");

class Menu_modelo extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function SvMenu($params)
  {
    $data = [
      "nombre" => $params["nomMenu"],
      "descripcion" => $params["descripMenu"],
      "precio_costo" => $params["precioCosto"],
      "precio_venta" => $params["precioVenta"],
      "image_src" => null,
    ];
    $this->db->insert("gs_menu", $data);
    return $this->db->insert_id();
  }

  function InsPgDivs($params)
  {
    $data = [
      "cantPagada" => $params["cantPagada"],
      "gs_pedido_idgs_pedido" => $params["gs_pedido_idgs_pedido"],
      "gs_tipo_pago_idgs_tipo_pago" => $params["gs_tipo_pago_idgs_tipo_pago"],
    ];
    $this->db->insert("pagos_pedidos", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  function EditCombo($params)
  {
    $data = [
      "nombre" => $params["NombreCombo"],
      "descripcion" => $params["DescripcionCombo"],
      "precio_costo" => $params["precioCostoCombo"],
      "precio_venta" => $params["precioVentaCombo"],
    ];
    $this->db->where("idgs_menu", $params["idCombo"]);
    return $this->db->update("gs_menu", $data);
    return $params["idCombo"];
  }

  function CancelarPedEn($params)
  {
    $data = [
      "entregadoPed" => "1",
    ];
    $this->db->where("idgs_pedido", $params["idNoPedidoCan"]);
    return $this->db->update("gs_pedido", $data);
  }

  function obtenerAllCombo()
  {
    $sql = "SELECT * FROM gs_menu";
    $res = $this->db->query($sql);
    return $res->result_array();
  }

  function ListarProducto()
  {
    $sql = "SELECT * FROM gs_producto";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function ListarCombos()
  {
    $sql = "SELECT * FROM gs_menu";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function ListarCombosVent()
  {
    $sql = "SELECT idgs_menu as idgs_producto,
                nombre as nombre,
                idgs_menu as codigo,
                descripcion as descripcion,
                precio_venta as precio_venta,
                image_src as img_src,
                0 as preciomayoreo,
                0 as preciofrecuente,
                0 as precionormal,
                0 as stock,
                'Activo' as estado,
                'Combo' as NombreCat,
                0 as idcat
              FROM gs_menu";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function AsignarCombo($params)
  {
    $data = [
      "Producto_id" => $params["idProductos"],
      "Menu_id" => $params["idCombos"],
      "Cantidad" => $params["Cantidad"],
      "precio_producto_menu" => $params["precio"],
    ];

    //$this->db->where('idusuario', $params['idUsr']);
    $this->db->insert("gs_detallemenu", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  function getComboProductDetail($params)
  {
    $sql =
      "SELECT
              producto.idgs_producto,
              producto.nombre,
              producto.descripcion,
              detalle_menu.Cantidad,
              detalle_menu.idgs_detallemenu,
              producto.precio_venta,
              producto.es_producto_preparado,
              CASE 
                WHEN producto.es_producto_preparado = 1 THEN producto.preciomayoreo
                WHEN producto.es_producto_preparado = 0 THEN detalle_menu.precio_producto_menu
              END precio_producto,
              producto.stock
            FROM
              gs_producto producto
              JOIN gs_detallemenu detalle_menu ON producto.idgs_producto = detalle_menu.Producto_id
              JOIN gs_menu menu ON detalle_menu.Menu_id = menu.idgs_menu
            WHERE
              detalle_menu.Menu_id = " .
      intval($params["comboId"]) .
      ";";

    $res = $this->db->query($sql);
    return $res->result();
  }

  function updateComboDetail($params)
  {
    $data = [
      "Cantidad" => $params["quantity"],
      "precio_producto_menu" => $params["precioProductoMenu"],
    ];
    $this->db->where("idgs_detallemenu", $params["idgs_detallemenu"]);
    return $this->db->update("gs_detallemenu", $data);
  }

  function deleteComboDetail($params)
  {
    $this->db->where("idgs_detallemenu", $params["idgs_detallemenu"]);
    return $this->db->delete("gs_detallemenu");
  }

  function AsignarProductoPreparado($params)
  {
    $data = [
      "idgs_producto" => $params["idProducto"],
      "id_producto_preparado" => $params["idProductoPreparado"],
      "unidades_producto_preparado" => $params["cantidad"],
      "precio_preparado" => $params["precio"],
    ];

    $this->db->insert("gs_detalle_producto_preparado", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  function ListarProductoPreparado()
  {
    $sql = "SELECT * FROM gs_producto WHERE es_producto_preparado = 1";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function getProductoPreparadoDetail($params)
  {
    $sql =
      "SELECT
              producto.idgs_producto,
              producto.nombre,
              producto.descripcion,
              detalle_menu.unidades_producto_preparado,
              detalle_menu.precio_preparado,
              producto.stock,
              detalle_menu.idgs_dpp
            FROM
              gs_producto producto
              JOIN gs_detalle_producto_preparado detalle_menu ON producto.idgs_producto = detalle_menu.idgs_producto
            WHERE
              detalle_menu.id_producto_preparado = " .
      intval($params["productoPreparadoId"]) .
      ";";

    $res = $this->db->query($sql);
    return $res->result();
  }

  function deleteProductoPreparadoDetail($params)
  {
    $this->db->where("idgs_producto", $params["idgs_producto"]);
    $this->db->where("id_producto_preparado", $params["id_producto_preparado"]);
    return $this->db->delete("gs_detalle_producto_preparado");
  }

  function EditProductoPreparado($params)
  {
    $data = [
      "nombre" => $params["nombreProductoPreparado"],
      "descripcion" => $params["descripcionProductoPreparado"],
      "preciomayoreo" => $params["precioMayoreoProductoPreparado"],
    ];
    $this->db->where("idgs_producto", $params["idProductoPreparado"]);
    return $this->db->update("gs_producto", $data);
  }

  function updateProductoPreparadoDetail($params)
  {
    $data = [
      "unidades_producto_preparado" => $params["quantity"],
      "precio_preparado" => $params["precioPreparado"],
    ];
    $this->db->where("idgs_producto", $params["idgs_producto"]);
    $this->db->where("id_producto_preparado", $params["id_producto_preparado"]);
    return $this->db->update("gs_detalle_producto_preparado", $data);
  }
}
