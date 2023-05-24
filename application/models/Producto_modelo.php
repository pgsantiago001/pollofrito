<?php if (!defined("BASEPATH")) {
  exit("No direct script access allowed");
}

date_default_timezone_set("America/Guatemala");
class Producto_modelo extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function ListaProducto()
  {
    $sql = "SELECT pro.idgs_producto as idgs_producto, pro.nombre as nombre, pro.codigo as codigo, pro.descripcion as descripcion,
            pro.costo as costo, pro.utilidad as utilidad, pro.precio_venta as precio_venta, pro.preciomayoreo as preciomayoreo, pro.preciofrecuente as preciofrecuente,
            pro.precionormal as precionormal, pro.stock as stock,
            pro.estado as estado, pro.imagen as imagen, pro.es_producto_preparado as esproductopreparado, cat.nombre AS NombreCat, cat.idgs_categoria AS idcat
            FROM gs_producto AS pro INNER JOIN gs_categoria as cat
            ON cat.idgs_categoria=pro.Categoria_id";
    $res = $this->db->query($sql);
    return $res->result();
  }
  function ListaProductoArr()
  {
    $sql = "SELECT pro.idgs_producto as idgs_producto, pro.nombre as nombre, pro.codigo as codigo, pro.descripcion as descripcion,
            pro.costo as costo, pro.utilidad as utilidad, pro.precio_venta as precio_venta, pro.stock as stock,
            pro.estado as estado, pro.imagen as imagen, cat.nombre AS NombreCat, cat.idgs_categoria AS idcat
            FROM gs_producto AS pro INNER JOIN gs_categoria as cat
            ON cat.idgs_categoria=pro.Categoria_id";
    $res = $this->db->query($sql);
    return $res->result_array();
  }

  function ListarPersonal()
  {
    $sql = "SELECT * FROM personal";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function SeleccionarProducto($id)
  {
    $sql =
      "SELECT pro.idgs_producto as idgs_producto, pro.nombre as nombre, pro.codigo as codigo, pro.descripcion as descripcion,
            pro.costo as costo, pro.utilidad as utilidad, pro.precio_venta as precio_venta, pro.preciomayoreo as preciomayoreo, pro.preciofrecuente as preciofrecuente,
            pro.precionormal as precionormal, pro.stock as stock,
            pro.estado as estado, pro.imagen as imagen, pro.es_producto_preparado as esproductopreparado, cat.nombre AS NombreCat, cat.idgs_categoria AS idcat
            FROM gs_producto AS pro INNER JOIN gs_categoria as cat
            ON cat.idgs_categoria=pro.Categoria_id 
            WHERE pro.idgs_producto = " . $id;
    $res = $this->db->query($sql);
    return $res->result_array();
  }
  function SeleccionarProductoNombre($nomb)
  {
    $sql =
      "SELECT pro.nombre as nombre, pro.idgs_producto as idgs_producto, pro.codigo as codigo, pro.descripcion as descripcion,
            pro.costo as costo, pro.utilidad as utilidad, pro.precio_venta as precio_venta, pro.stock as stock,
            pro.estado as estado, pro.imagen as imagen, cat.nombre AS NombreCat, cat.idgs_categoria AS idcat
            FROM gs_producto AS pro INNER JOIN gs_categoria as cat
            ON cat.idgs_categoria=pro.Categoria_id
            WHERE pro.nombre LIKE '%" .
      $nomb .
      "%'";
    $res = $this->db->query($sql);
    return $res->result_array();
  }
  function SelecProdBarras($CodB)
  {
    $sql =
      "SELECT pro.idgs_producto as idgs_producto, pro.nombre as nombre, pro.codigo as codigo, pro.descripcion as descripcion,
            pro.precio_venta as precio_venta,  pro.preciomayoreo as preciomayoreo,  pro.preciofrecuente as preciofrecuente,  pro.precionormal as precionormal, pro.stock as stock,
            pro.estado as estado, cat.nombre AS NombreCat, cat.idgs_categoria AS idcat
            FROM gs_producto AS pro INNER JOIN gs_categoria as cat
            ON cat.idgs_categoria=pro.Categoria_id 
            WHERE pro.codigo LIKE '%" .
      $CodB .
      "%' OR pro.nombre LIKE '%" .
      $CodB .
      "%' OR pro.descripcion LIKE '%" .
      $CodB .
      "%'";
    $res = $this->db->query($sql);
    return $res->result_array();
  }

  function EliminarProducto($params)
  {
    $this->db->where("idgs_producto", $params["id"]);
    return $this->db->delete("gs_producto");

    return $params["id"];
  }

  function InsertarProducto($params)
  {
    // CM:: if $params["esproductopreparado"] insert detalle_producto_preparado
    $data = [
      "codigo" => $params["codigo"],
      "nombre" => $params["nombre"],
      "descripcion" => $params["descripcion"],
      "costo" => $params["costo"],
      "utilidad" => $params["utilidad"],
      "precio_venta" => $params["precio_venta"],
      "preciomayoreo" => $params["preciomayoreo"],
      "preciofrecuente" => $params["preciofrecuente"],
      "precionormal" => $params["precionormal"],
      "stock" => $params["stock"],
      "estado" => $params["estado"],
      "imagen" => $params["imagen"],
      "Categoria_id" => $params["Categoria_id"],
      "es_producto_preparado" => $params["esproductopreparado"],
    ];

    $this->db->insert("gs_producto", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  function EditarProducto($params)
  {
    $data = [
      "codigo" => $params["codigo"],
      "nombre" => $params["nombre"],
      "descripcion" => $params["descripcion"],
      "es_producto_preparado" => $params["esproductopreparado"],
      "costo" => $params["costo"],
      "utilidad" => $params["utilidad"],
      "precio_venta" => $params["precio_venta"],
      "preciomayoreo" => $params["preciomayoreo"],
      "preciofrecuente" => $params["preciofrecuente"],
      "precionormal" => $params["precionormal"],
      "stock" => $params["stock"],
      "estado" => $params["estado"],
      "imagen" => $params["imagen"],
      "Categoria_id" => $params["Categoria_id"],
    ];

    $this->db->where("idgs_producto", $params["idproducto"]);
    return $this->db->update("gs_producto", $data);

    return $params["idproducto"];
  }

  public function ListarProducto()
  {
    $sql = "SELECT idgs_producto,nombre,codigo FROM gs_producto";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function ListarCategoria()
  {
    $sql = "SELECT idgs_categoria,nombre,estado FROM gs_categoria";
    $res = $this->db->query($sql);
    return $res->result();
  }
}
