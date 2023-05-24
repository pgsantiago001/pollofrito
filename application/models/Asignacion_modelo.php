<?php if (!defined("BASEPATH")) {
  exit("No direct script access allowed");
}

//date_default_timezone_set("America/Guatemala");

class Asignacion_modelo extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function SeleccionarFactura($id)
  {
    $sql =
      "SELECT * FROM gs_factura AS f INNER JOIN usuario AS u
                ON  u.idusuario=f.Usuario_id INNER JOIN personal AS p
                ON p.idpersonal=u.id_personal
                WHERE idgs_factura = " . $id;
    $res = $this->db->query($sql);
    return $res->result();
  }

  function AsignarProducto($params)
  {
    $data = [
      "Factura_id" => $params["factura_id"],
      "Producto_id" => $params["producto_id"],
      "cantidad" => $params["cant"],
    ];
    $id = $_POST["producto_id"];
    $cant = $_POST["cant"];
    $res = $this->CantidadDelProdcuto($id);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["stock"] - $cant;
    $actualizar = $this->ActualizarProducto($id, $total);
    $this->db->insert("gs_detalleventa", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  function AgregarBitDev($params)
  {
    $fecha = date("Y-m-d H:i:s");
    $data = [
      "ComentarioDev" => $params["comentario"],
      "gs_factura_idgs_factura" => $params["idFactura"],
      "FechaHora" => $fecha,
      "MontoDiferencia" => $params["MontoDif"],
      "NoComprobanteAnt" => $params["NoFacAnt"],
    ];
    $total = $_POST["MontoActual"];
    $id = $_POST["NoFacAnt"];
    $res = $this->MontoFacturaDevolocion($id);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["total"] - $total;
    //$this->ActualizarMontoFacDevolucion($id, $total);
    $this->db->insert("gs_devolucion", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  function AgregarStockM($params)
  {
    $data = [
      "Producto_id" => $params["Producto_id"],
      "cantidad" => $params["cantidad"],
    ];

    $id = $_POST["Producto_id"];
    $cant = $_POST["cantidad"];
    $PreU = $_POST["PrecioU"];

    $res = $this->CantidadDelProdcuto($id);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["stock"] + $cant;
    $sql =
      "UPDATE gs_producto SET stock =" .
      $total .
      ", precio_venta =" .
      $PreU .
      " WHERE idgs_producto=" .
      $id .
      "";
    $res = $this->db->query($sql);
    return $total;
  }

  //funcion para consultar el precio de un producto
  public function consultarPrecioProducto($id)
  {
    $sql = "SELECT * FROM gs_producto WHERE idgs_producto=" . $id . " ";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function CantidadDelProdcuto($id)
  {
    $sql = "SELECT stock FROM gs_producto WHERE idgs_producto=" . $id . " ";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function CantidadDelProdcutoMenu($id)
  {
    $sql =
      "SELECT dm.Menu_id AS Combo_id, dm.Producto_id AS Producto_id, dm.Cantidad AS Cantidad 
               FROM gs_menu m INNER JOIN gs_detallemenu dm
                ON m.idgs_menu=dm.Menu_id WHERE dm.Menu_id=" .
      $id .
      " ";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function ActualizarProducto($id, $total)
  {
    $sql =
      "UPDATE gs_producto SET stock =" .
      $total .
      " WHERE idgs_producto=" .
      $id .
      "";
    // print_r($sql);
    $res = $this->db->query($sql);
    //return $res->result();
  }
  public function ActualizarMontoFacDevolucion($id, $total)
  {
    $sql =
      "UPDATE gs_factura SET total =" .
      $total .
      " WHERE idgs_factura=" .
      $id .
      "";
    // print_r($sql);
    $res = $this->db->query($sql);
    //return $res->result();
  }

  public function MontoFacturaDevolocion($id)
  {
    $sql = "SELECT total FROM gs_factura WHERE idgs_factura=" . $id . " ";
    $res = $this->db->query($sql);
    return $res->result();
  }
  function ListarProductosAsignados($id)
  {
    $sql =
      "SELECT 
                   dv.idgs_detalleventa as id,
                    dv.Producto_id as CODIGO, 
                    p.codigo AS Barras,
                    p.nombre as Nombre,
                    p.descripcion as Descripcion,
                    dv.cantidad as Cant,
                    p.precio_venta as PrecioV
                FROM
                    gs_detalleventa AS dv INNER JOIN gs_producto AS p
                    ON p.idgs_producto=dv.Producto_id
                WHERE
                    dv.Factura_id = " . $id;

    $res = $this->db->query($sql);
    return $res->result();
  }

  function EliminarProducto($params)
  {
    $data = [
      "Factura_id" => $params["fact"],
      "Producto_id" => $params["cod"],
      "cantidad" => $params["cant"],
      "idgs_detalleventa" => $params["id"],
    ];

    $id = $params["id"];
    $cod = $params["cod"];
    $cant = $params["cant"];

    $res = $this->CantidadDelProdcuto($cod);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["stock"] + $cant;

    $actualizar = $this->ActualizarProductoSuma($cod, $total);
    $this->db->where("idgs_detalleventa", $params["id"]);
    $this->db->delete("gs_detalleventa");
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
    $sql = "SELECT p.idgs_producto AS ID, p.codigo AS Barras, p.nombre AS Nombre, p.descripcion AS Descripcion, c.nombre AS Categoria, p.stock AS cant
                    FROM gs_producto AS p INNER JOIN gs_categoria AS c
                    ON c.idgs_categoria=p.Categoria_id";

    $res = $this->db->query($sql);
    return $res->result();
  }

  function ultimaventa()
  {
    $sql =
      "SELECT idgs_factura FROM gs_factura ORDER BY idgs_factura DESC LIMIT 1;";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function insertFactura($params)
  {
    $id = "";
    // $fecha=date('Y-m-d H:i:s');
    $data = [
      "fecha" => $params["fecha"],
      //'metododepago'      => null,
      //'total'             => null,
      "Cliente_id" => $params["cliente"],
      "Usuario_id" => $params["usuario"],
      "estado" => 0,
    ];
    if (
      $params["fecha"] == "" ||
      $params["cliente"] == "" ||
      $params["usuario"] == ""
    ) {
      $id = "";
    } else {
      $this->db->insert("gs_factura", $data);
      $id = $this->db->insert_id();
    }
    return $id;
  }
  public function insertFacturaNewMet($params)
  {
    $id = "";
    $fecha = date("Y-m-d H:i:s");
    $data = [
      "fecha" => $fecha,
      "metododepago" => $params["metododepago"],
      "total" => $params["total"],
      "Cliente_id" => $params["cliente"],
      "Usuario_id" => $params["usuario"],
      "estado" => 1,
    ];
    if (
      $params["metododepago"] == "" ||
      $params["total"] == "" ||
      $params["cliente"] == "" ||
      $params["usuario"] == ""
    ) {
      $id = "";
    } else {
      $this->db->insert("gs_factura", $data);
      $id = $this->db->insert_id();
    }

    return $id;
  }

  public function insertDetProd($params)
  {
    $precio = $params["Precio_pro"];
    $cantidad = $params["cantidad"];
    $precioreal = $precio * $cantidad;
    $data = [
      "cantidad" => $params["cantidad"],
      "Factura_id" => $params["Factura_id"],
      "Producto_id" => $params["Producto_id"],
      "Precio_pro" => $precioreal,
      //'Precio_pro'    => $params['Precio_pro']
    ];
    //datos del producto
    $id = $data["Producto_id"];
    $cant = $data["cantidad"];

    //condicion para determinar si es valida
    if ($id != "") {
      $res = $this->CantidadDelProdcuto($id);
      $res = json_encode($res);
      $res = json_decode($res, true);

      $total = $res[0]["stock"] - $cant;
      $actualizar = $this->ActualizarProducto($id, $total);

      $this->db->insert("gs_detalleventa", $data);
      $id = $this->db->insert_id();
    } else {
      $id = "";
    }
    return $id;
  }

  public function actualizarProd($params)
  {
    $id = $params["Producto_id"];
    $cant = $params["cantidad"];
    $cantidad_menu = $params["CantidadMenu"];
    //consulta precio de producto menu
    $resprecio = $this->consultarPrecioProducto($id);
    $resprecio = json_encode($resprecio);
    $resprecio = json_decode($resprecio, true);
    $precioreal = $resprecio[0]["preciomayoreo"] * $cant;
    if (array_key_exists("Menu_id", $params)) {
      $precioreal = $params["Precio_pro"] * $cant * $cantidad_menu;
    }

    $data = [
      "cantidad" => $params["cantidad"],
      "Factura_id" => $params["Factura_id"],
      "Producto_id" => $params["Producto_id"],
      "Precio_pro" => $precioreal,
      "Menu_id" => $params["Menu_id"],
      "CantidadMenu" => $params["CantidadMenu"],
    ];

    //funcion para actualizar producto con condicion

    if ($id != "") {
      $esProductoPreparado = $this->esProductoPreparado($id)[0]
        ->es_producto_preparado;

      if ($esProductoPreparado) {
        $id_producto_preparado = $id;
        // CM:: obtener detalle PP
        $detalleProductoPreparado = $this->obtenerDetalleProductoPreparado(
          $id_producto_preparado
        );
        // CM:: por cada producto del pp actualizar productos
        //      stock, ActualizarProducto
        foreach ($detalleProductoPreparado as $detalle) {
          $cantidadProducto = $this->CantidadDelProdcuto(
            $detalle->idgs_producto
          )[0];
          $this->ActualizarProducto(
            $detalle->idgs_producto,
            $cantidadProducto->stock - $detalle->unidades_producto_preparado
          );
          $dataProductoIndividual = [
            "cantidad" => $detalle->unidades_producto_preparado,
            "Factura_id" => $params["Factura_id"],
            "Producto_id" => $detalle->idgs_producto,
            "Precio_pro" =>
              $detalle->precio_preparado *
              $detalle->unidades_producto_preparado *
              $params["CantidadMenu"],
            "Menu_id" => $params["Menu_id"],
            "CantidadMenu" => $params["CantidadMenu"],
            "idgs_dpp" => $detalle->idgs_dpp,
          ];
          // CM:: insert gs_detalleventa de producto individual con su valor
          $this->db->insert("gs_detalleventa", $dataProductoIndividual);
          $this->db->insert_id();
        }
      } else {
        $res = $this->CantidadDelProdcuto($id);
        $res = json_encode($res);
        $res = json_decode($res, true);

        $total = $res[0]["stock"] - $cant;
        $actualizar = $this->ActualizarProducto($id, $total);
        $this->db->insert("gs_detalleventa", $data);
        $id = $this->db->insert_id();
      }
    } else {
      $id = "";
    }
    return $id;
  }
  function consultProdMenu($id)
  {
    $sql =
      "SELECT dm.Menu_id as Combo_id, dm.Producto_id as Producto_id, dm.Cantidad as Cantidad from    gs_menu m inner join gs_detallemenu dm
              on m.idgs_menu=dm.Menu_id
              where Menu_id=" .
      $id .
      " ";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function insertDetProdMenu($params)
  {
    $data = [
      "cantidad" => $params["cantidad"],
      "Factura_id" => $params["Factura_id"],
      "Menu_id" => $params["Menu_id"],
      "Precio_pro" => $params["Precio_pro"],
    ];
    $id = $data["Menu_id"];
    $cant = $data["cantidad"];
    if ($id != "") {
      $ress = $this->CantidadDelProdcutoMenu($id);
      $ress = json_encode($ress);
      $ress = json_decode($ress, true);

      $prod = $ress[0]["Producto_id"];

      $res = $this->CantidadDelProdcuto($prod);
      $res = json_encode($res);
      $res = json_decode($res, true);

      $Canti = $res[0]["stock"] - $ress[0]["Cantidad"];
      $actualizar = $this->ActualizarProducto($prod, $Canti);
    }
  }

  //inicio actualiza el total el descuento  y estado de factura R De Leon

  public function EditarFactura($params)
  {
    $data = [
      "idgs_factura" => $params["factura_id"],
      "metododepago" => $params["tipopago"],
      "total" => $this->totalVenta($params["factura_id"])[0]->total_venta,
      "estado" => 1,
      "descuento" => 0,
    ];
    $id = $params["factura_id"];
    if ($id != "") {
      $this->db->where("idgs_factura", $params["factura_id"]);
      return $this->db->update("gs_factura", $data);
      $this->sumaDetallesFactura($id);
    }
    return $id;
  }

  //inicio elimina un producto del detalle R De Leon

  function DelProdDet($params)
  {
    $data = [
      "Factura_id" => $params["fac"],
      "Producto_id" => $params["cod"],
      "cantidad" => $params["cant"],
      "idgs_detalleventa" => $params["id"],
    ];

    //$id = $params['id'];
    $idDetvent = $data["idgs_detalleventa"];
    //$cod = $params['cod'];
    $cod = $data["Producto_id"];
    //$cant = $params['cant'];
    $cant = $data["cantidad"];
    $id = $data["Producto_id"];

    $res = $this->CantidadDelProdcuto($cod);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["stock"] + $cant;
    $actualizar = $this->ActualizarProductoSuma($cod, $total);
    $this->db->where("idgs_detalleventa", $idDetvent);
    $this->db->delete("gs_detalleventa");
    return $params["id"];
  } //fin elimina un producto del detalle
  //funcion para actualizar el stock eliminar devolucion

  function DelProdDevol($params)
  {
    $data = [
      "Producto_id" => $params["cod"],
      "cantidad" => $params["cant"],
    ];
    $cod = $data["Producto_id"];
    $cant = $data["cantidad"];
    $res = $this->CantidadDelProdcuto($cod);
    $res = json_encode($res);
    $res = json_decode($res, true);
    $total = $res[0]["stock"] - $cant;
    $actualizar = $this->ActualizarProductoSuma($cod, $total);
    return $cod;
  }

  //Fin funcion eliminar devolucion
  public function ListarClientes()
  {
    $sql = "SELECT idgs_cliente,nombre,nit FROM gs_cliente";
    $res = $this->db->query($sql);
    return $res->result();
  }

  // Codigo R de Leon insertar cliente
  function InsertarClien($params)
  {
    $data = [
      "nit" => $params["Nit"],
      "nombre" => $params["Nombre"],
      "direccion_cont" => $params["Direccion"],
    ];

    $this->db->insert("gs_cliente", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  // Codigo R de Leon inserta Pago dividido

  function InsertarTipoPag($params)
  {
    $fecha = date("Y-m-d H:i:s");
    $data = [
      "monto" => $params["Monto"],
      "fecha_pgDividido" => $fecha,
      "gs_factura_idgs_factura" => $params["idFactu"],
      "gs_tipo_pago_idgs_tipo_pago" => $params["idTipoPago"],
    ];

    $this->db->insert("gs_pg_dividido", $data);
    $id = $this->db->insert_id();
    return $id;
  }

  public function UltimoId()
  {
    $this->db->select_max("idgs_factura");
    $result = $this->db->get("{table}")->row_array();
    echo $result["{primary key}"];
  }

  public function detalleventa($id)
  {
    $sql =
      "SELECT @i := @i + 1 AS contador, dv.cantidad as cantidad, p.nombre as nombre,concat(p.nombre,' / ',p.descripcion) as descripcion, dv.Precio_pro   as precio  
                    from gs_factura as f inner join gs_detalleventa as dv
                    on f.idgs_factura=dv.Factura_id inner join gs_producto as p
                    on p.idgs_producto=dv.Producto_id
                    cross join (select @i := 0) r
              where  dv.Menu_id is null and dv.Factura_id=" . $id;
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function detalleventaMenu($id)
  {
    $sql =
      "SELECT @i := @i + 1 AS contador, dv.CantidadMenu as cantidad, m.nombre as nombre, concat(m.nombre,' / ',m.descripcion) as descripcion, m.precio_venta as precio
                from gs_detalleventa dv INNER JOIN gs_menu m 
                on dv.Menu_id=m.idgs_menu
                cross join (select @i := 0) r
                WHERE dv.Factura_id = " .
      $id .
      " group by dv.Menu_id";
    $res = $this->db->query($sql);
    return $res->result();
  }

  public function encabezadofactura($id)
  {
    $sql =
      "SELECT f.idgs_factura as factura, f.fecha as fecha, f.total as total, f.descuento as descuento, c.nombre as cliente,
            c.nit as nitcliente, c.direccion_cont
            from gs_factura as f inner join gs_cliente as c
            on c.idgs_cliente=f.Cliente_id
            where f.idgs_factura=" . $id;
    $res = $this->db->query($sql);
    return $res->result();
  }
  function SelecVentD($FechaUno, $FechaDos)
  {
    $sql =
      "SELECT idgs_factura as NoFactura, fecha as Fecha, metododepago, descuento, total
            FROM gs_factura
            WHERE  (fecha between '" .
      $FechaUno .
      " 00:00:00' and '" .
      $FechaDos .
      " 23:59:59')";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function SelecDevTot($FechaUno, $FechaDos)
  {
    $sql =
      "SELECT gs_factura_idgs_factura as NoFactura, FechaHora, ComentarioDev, MontoDiferencia, NoComprobanteAnt as FactAnt
            FROM gs_devolucion
            WHERE  (FechaHora between '" .
      $FechaUno .
      " 00:00:00' and '" .
      $FechaDos .
      " 23:59:59')";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function SelecVentDiv($FechaUno, $FechaDos)
  {
    $sql =
      "SELECT monto, fecha_pgDividido as fecha, gs_factura_idgs_factura as NoFactura, gs_tipo_pago_idgs_tipo_pago, DescripcionTiPago AS DescPago
         FROM gs_pg_dividido 
         INNER JOIN gs_tipo_pago ON gs_pg_dividido.gs_tipo_pago_idgs_tipo_pago = gs_tipo_pago.idgs_tipo_pago
         WHERE  (fecha_pgDividido between '" .
      $FechaUno .
      " 00:00:00' and '" .
      $FechaDos .
      " 23:59:59') ORDER BY gs_factura_idgs_factura ASC";
    $res = $this->db->query($sql);
    return $res->result();
  }

  function sumaDetallesFactura($id)
  {
    //consultamos los detalles de la factura
    $sql =
      "SELECT SUM(Precio_pro) as total FROM gs_detalleventa as det WHERE det.Factura_id =" .
      $id;
    $res = $this->db->query($sql);
    $res = $res->result();
    $res = json_encode($res);
    $res = json_decode($res, true);

    //obtenemos el total de la suma de los detalles

    $total = $res[0]["total"];

    //actualizamos el total de la factura
    $sqlUpdate =
      "UPDATE gs_factura SET total=" .
      "'" .
      $total .
      "'" .
      " WHERE idgs_factura = " .
      $id;
    $res2 = $this->db->query($sqlUpdate);
    return $total;
  }

  function removeInvoice($factura_id)
  {
    $this->db->where("idgs_factura", $factura_id);
    $this->db->delete("gs_factura");
    return $factura_id;
  }

  function getProductPrice($product_id)
  {
    $this->db->select("precio_venta");
    $this->db->where("idgs_producto", $product_id);
    $query = $this->db->get("gs_producto");
    return $query->result();
  }

  function totalVenta($factura_id)
  {
    $this->db->select_sum("Precio_pro", "total_venta");
    $this->db->where("Factura_id", $factura_id);
    $query = $this->db->get("gs_detalleventa");
    return $query->result();
  }

  public function esProductoPreparado($product_id)
  {
    $this->db->select("es_producto_preparado");
    $this->db->where("idgs_producto", $product_id);
    $query = $this->db->get("gs_producto");
    return $query->result();
  }

  public function obtenerDetalleProductoPreparado($product_id)
  {
    $this->db->select(
      "idgs_producto, unidades_producto_preparado, idgs_dpp, precio_preparado"
    );
    $this->db->where("id_producto_preparado", $product_id);
    $query = $this->db->get("gs_detalle_producto_preparado");
    return $query->result();
  }
  function getProductMenuPrice($product_id, $menu_id)
  {
    $this->db->select("precio_producto_menu");
    $this->db->where("Producto_id", $product_id);
    $this->db->where("Menu_id", $menu_id);
    $query = $this->db->get("gs_detallemenu");
    return $query->result();
  }

    function obtenerListaProductosMenu($menu_id) {
        $this->db->select("producto_id, precio_producto_menu, Cantidad");
        $this->db->where("Menu_id", $menu_id);
        $query = $this->db->get("gs_detallemenu");
        return $query->result();
    }
}
