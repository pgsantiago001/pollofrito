<?php if (!defined("BASEPATH")) {
  exit("No direct script access allowed");
}
date_default_timezone_set("America/Guatemala");
class Reportes_modelo extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function ListarPersonal()
  {
    $sql = "SELECT * FROM personal";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function ListaVentaReporte($fecha1, $fecha2)
  {
    $sql =
      "SELECT f.idgs_factura AS NoFactura, c.nombre AS Cliente, f.metododepago AS Pago, f.fecha AS fecha, 
            p.nombre AS Empleado, f.total AS Total, f.descuento AS descuento, IF(f.estado='1','Pagado','Cancelado') AS Estado 
            FROM gs_factura AS f INNER JOIN gs_cliente AS c
            ON c.idgs_cliente=f.Cliente_id LEFT JOIN usuario AS u
            ON u.idusuario=f.Usuario_id LEFT JOIN personal AS p
            ON p.idpersonal=u.id_personal
        WHERE  (fecha between '" .
      $fecha1 .
      " 00:00:00' and '" .
      $fecha2 .
      " 23:59:59')";

    $res = $this->db->query($sql);
    return $res->result();
  }
  function ListaVentaReporteProductos($fecha1, $fecha2)
  {
    $sql =
      "SELECT f.idgs_factura AS ID, menu.nombre as COMBO,
              CASE WHEN dv.idgs_dpp > 0
                THEN (SELECT p.nombre FROM gs_producto p
                         JOIN gs_detalle_producto_preparado detalle_pp ON detalle_pp.id_producto_preparado = p.idgs_producto
                         WHERE dv.idgs_dpp = detalle_pp.idgs_dpp
                        )
                ELSE null
              END as PREPARADO,
              f.fecha AS Fecha, p.idgs_producto as IDProducto, p.codigo as Codigo, p.nombre as Nombre, p.descripcion as Descripcion,
              dv.cantidad AS Cantidad, dv.Precio_pro AS Precio, (p.costo *  dv.cantidad) as Costo, ((dv.cantidad * dv.Precio_pro) - (p.costo *  dv.cantidad)) as Ganancia,  dv.cantidad * dv.Precio_pro  AS Total
              FROM gs_detalleventa dv 
              INNER JOIN gs_factura f ON f.idgs_factura=dv.Factura_id
              INNER JOIN gs_producto p ON dv.Producto_id=p.idgs_producto
              LEFT JOIN gs_menu menu ON dv.Menu_id = menu.idgs_menu
              WHERE  (fecha between '" .
      $fecha1 .
      " 00:00:00' and '" .
      $fecha2 .
      " 23:59:59')";

    $res = $this->db->query($sql);
    return $res->result();
  }

  function ListaVentaReporteEmpleado($fecha1, $fecha2, $parametros)
  {
    $empleado = $this->ConvertirTexto($parametros["empleado"]);
    $sql =
      "SELECT p.nombre AS Empleado, COUNT(f.idgs_factura) AS Cantidad, 
                  sum(f.total) AS Total, IF(f.estado='1','Pagado','Cancelado') AS Estado 
                  FROM gs_factura AS f INNER JOIN gs_cliente AS c
                  ON c.idgs_cliente=f.Cliente_id INNER JOIN usuario AS u
                  ON u.idusuario=f.Usuario_id INNER JOIN personal AS p
                  ON p.idpersonal=u.id_personal
                  WHERE f.estado=1 AND u.idusuario IN " .
      $empleado .
      " AND (fecha BETWEEN '" .
      $fecha1 .
      " 00:00:00' and '" .
      $fecha2 .
      " 23:59:59')
                  GROUP by  p.nombre";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function ListaCompraReporte($fecha1, $fecha2)
  {
    $sql =
      "SELECT com.idgs_compra AS IDCompra, com.numerocompra AS NoCompra,  
              pro.nombre AS Proveedor, com.fecha AS fecha, 
              p.nombre AS Empleado, com.total AS Total, IF(com.estado='1','Pagado','Cancelado') AS Estado 
            FROM gs_compra AS com INNER JOIN gs_proveedor AS pro
            ON pro.idgs_proveedor=com.Proveedor_id INNER JOIN usuario AS u
            ON u.idusuario=com.Usuario_id INNER JOIN personal AS p
            ON p.idpersonal=u.id_personal
        WHERE  (fecha between '" .
      $fecha1 .
      " 00:00:00' and '" .
      $fecha2 .
      " 23:59:59')";

    $res = $this->db->query($sql);
    return $res->result();
  }

  function SeleccionarCompra($id)
  {
    $sql =
      "SELECT * FROM gs_compra AS c INNER JOIN usuario AS u
                ON  u.idusuario=c.Usuario_id INNER JOIN personal AS p
                ON p.idpersonal=u.id_personal
                WHERE idgs_compra = " . $id;

    $res = $this->db->query($sql);
    return $res->result();
  }

  function AsignarProductoCompra($params)
  {
    $data = [
      "Compra_id" => $params["compra_id"],
      "Producto_id" => $params["producto_id"],
      "cantidad" => $params["cant"],
    ];

    $id = $_POST["producto_id"];
    $cant = $_POST["cant"];

    $res = $this->CantidadDelProdcutoCompra($id);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["stock"] + $cant;
    $actualizar = $this->ActualizarProductoCompra($id, $total);

    $this->db->insert("gs_detallecompra", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  public function CantidadDelProdcutoCompra($id)
  {
    $sql = "SELECT stock FROM gs_producto WHERE idgs_producto=" . $id . " ";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function ActualizarProductoCompra($id, $total)
  {
    $sql =
      "UPDATE gs_producto SET stock =" .
      $total .
      " WHERE idgs_producto=" .
      $id .
      "";
    print_r($sql);
    $res = $this->db->query($sql);
    //return $res->result();
  }

  function ListarProductosAsignadosCompra($id)
  {
    $sql =
      "SELECT 
                    dc.idgs_detallecompra as id,
                    dc.Producto_id as CODIGO, 
                    p.nombre as Nombre,
                    dc.cantidad as Cant,
                    p.precio_venta as PrecioV,
                    p.costo AS PrecioC
                FROM
                    gs_detallecompra AS dc INNER JOIN gs_producto AS p
                    ON p.idgs_producto=dc.Producto_id
                WHERE
                    dc.Compra_id = " . $id;

    $res = $this->db->query($sql);
    return $res->result();
  }

  function EliminarProductoCompra($params)
  {
    $data = [
      "Compra_id" => $params["compra"],
      "Producto_id" => $params["cod"],
      "cantidad" => $params["cant"],
      "idgs_detallecompra" => $params["id"],
    ];

    $id = $params["id"];
    $cod = $params["cod"];
    $cant = $params["cant"];

    $res = $this->CantidadDelProdcuto($cod);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["stock"] - $cant;

    $actualizar = $this->ActualizarProductoSuma($cod, $total);

    $this->db->where("idgs_detallecompra", $params["id"]);
    $this->db->delete("gs_detallecompra");

    return $params["id"];
  }

  public function ActualizarProductoSuma($id, $total)
  {
    $sql =
      "UPDATE gs_producto SET stock =" .
      $total .
      " WHERE idgs_producto=" .
      $id .
      "";
    print_r($sql);
    $res = $this->db->query($sql);
    //return $res->result();
  }

  function ListarProductos()
  {
    $sql = "SELECT p.idgs_producto AS ID, p.nombre AS Nombre, c.nombre AS Categoria, p.stock AS cant
                    FROM gs_producto AS p INNER JOIN gs_categoria AS c
                    ON c.idgs_categoria=p.Categoria_id";

    $res = $this->db->query($sql);
    return $res->result();
  }

  function ultimacompra()
  {
    $sql =
      "SELECT idgs_compra FROM gs_compra ORDER BY idgs_compra DESC LIMIT 1;";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function insertCompra($params)
  {
    // $fecha=date('Y-m-d H:i:s');

    $data = [
      "fecha" => $params["fecha"],
      "numerocompra" => $params["numerocompra"],
      "total" => null,
      "Proveedor_id" => $params["proveedor"],
      "Usuario_id" => $params["usuario"],
      "estado" => 0,
    ];
    $this->db->insert("gs_compra", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  public function EditarCompra($params)
  {
    $data = [
      "idgs_compra" => $params["compra_id"],
      "total" => $params["total"],
      "estado" => 1,
    ];

    $this->db->where("idgs_compra", $params["compra_id"]);
    return $this->db->update("gs_compra", $data);

    return $params["compra_id"];
  }

  public function ListarProveedor()
  {
    $sql = "SELECT idgs_proveedor, nombre, nit FROM gs_proveedor";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function ListarProductosReportesParametro($categoria)
  {
    $sql =
      "SELECT pro.idgs_producto AS ID, pro.codigo AS Codigo, pro.nombre AS Nombre,
                pro.descripcion AS Descripcion, cat.nombre AS Categoria, pro.stock AS Exsitencia,
                pro.costo AS Costo, (pro.stock * pro.costo) AS Total
                FROM gs_producto AS pro INNER JOIN gs_categoria AS cat
                ON cat.idgs_categoria=pro.Categoria_id
                WHERE cat.idgs_categoria=" . $categoria;
    $res = $this->db->query($sql);
    return $res->result();
  }

  function ListarProductosReportes()
  {
    $sql = "SELECT pro.idgs_producto AS ID, pro.codigo AS Codigo, pro.nombre AS Nombre,
                pro.descripcion AS Descripcion, cat.nombre AS Categoria, pro.stock AS Exsitencia,
                pro.costo AS Costo, ROUND ((pro.stock * pro.costo),2) AS Total
                FROM gs_producto AS pro INNER JOIN gs_categoria AS cat
                ON cat.idgs_categoria=pro.Categoria_id";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function ListarCategoria()
  {
    $sql = "SELECT idgs_categoria,nombre,estado FROM gs_categoria";
    $res = $this->db->query($sql);
    return $res->result();
  }
  public function ListarEmpleados()
  {
    $sql = "SELECT u.idusuario ID, p.nombre as Nombre FROM usuario u INNER JOIN personal p
                ON p.idpersonal=u.id_personal";
    $res = $this->db->query($sql);
    return $res->result();
  }
  function ConvertirTexto($datos = null)
  {
    $texto = "(";
    $cont = 0;
    foreach ($datos as $key => $dato) {
      if ($cont == 0) {
        $texto .= $dato;
      } else {
        $texto .= "," . $dato;
      }
      $cont++;
    }
    $texto .= ")";
    return $texto;
  }

  function InsertarGrafico($datos = null, $valor = null, $tipo = 0)
  {
    /*0=enter, 1=string*/

    if (strlen($datos) == 0) {
      $datos = "[";
    }
    $datos = str_replace("]", "", $datos);
    if ($tipo == 1) {
      $t = '"';
    } else {
      $t = "";
    }
    if ($datos == "[") {
      $datos .= $t . $valor . $t;
    } else {
      $datos .= "," . $t . $valor . $t;
    }
    $datos .= "]";
    return $datos;
  }
}
