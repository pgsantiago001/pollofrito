<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("America/Guatemala");
class Compra_modelo extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

    function ListarPersonal()
    {
        $sql="SELECT * FROM personal";
        $res = $this->db->query($sql);
        return $res->result();
    }

     function ListaCompra(){

        $sql="SELECT c.idgs_compra AS NoCompra, provee.nombre AS Proveedor,  c.fecha AS fecha, 
            p.nombre AS Empleado, c.total AS Total, IF(c.estado='1','Pagado','Cancelado') AS Estado
            FROM gs_compra AS c INNER JOIN gs_proveedor AS provee
            ON provee.idgs_proveedor=c.Proveedor_id INNER JOIN usuario AS u
            ON u.idusuario=c.Usuario_id INNER JOIN personal AS p
            ON p.idpersonal=u.id_personal";

        $res = $this->db->query($sql);
        return $res->result();
    }

	function SeleccionarCompra($id){

        $sql= "SELECT * FROM gs_compra AS c INNER JOIN usuario AS u
                ON  u.idusuario=c.Usuario_id INNER JOIN personal AS p
                ON p.idpersonal=u.id_personal
                WHERE idgs_compra = ".$id;

        $res = $this->db->query($sql);
        return $res->result();
    }

    function AsignarProductoCompra($params){

        $data = array(
            'Compra_id'         => $params['compra_id'],
            'Producto_id'       => $params['producto_id'],
            'cantidad'          => $params['cant']
        );

        $id = $_POST['producto_id'];
        $cant = $_POST['cant'];

        $res=$this->CantidadDelProdcutoCompra($id);
        $res= json_encode($res);
        $res= json_decode($res, true);
        $total= ($res[0]["stock"] + $cant);
        $actualizar=$this->ActualizarProductoCompra($id, $total);
     
        $this->db->insert("gs_detallecompra",  $data);
        $id = $this->db->insert_id();
        return $id;

        
    }

    public function CantidadDelProdcutoCompra($id)
    {
        $sql = "SELECT stock FROM gs_producto WHERE idgs_producto=".$id." ";
        $res = $this->db->query($sql);
        return $res->result(); 
    }

      public function ActualizarProductoCompra($id, $total){
        
      $sql = "UPDATE gs_producto SET stock =".$total." WHERE idgs_producto=".$id."";
      print_r($sql);
      $res = $this->db->query($sql);
      //return $res->result(); 

    }

    function ListarProductosAsignadosCompra($id){

        $sql= "SELECT 
                    dc.idgs_detallecompra as id,
                    dc.Producto_id as CODIGO, 
                    p.codigo AS Barras,
                    p.nombre as Nombre,
                    p.descripcion as Descripcion,
                    dc.cantidad as Cant,
                    p.precio_venta as PrecioV,
                    p.costo AS PrecioC
                FROM
                    gs_detallecompra AS dc INNER JOIN gs_producto AS p
                    ON p.idgs_producto=dc.Producto_id
                WHERE
                    dc.Compra_id = ".$id;

        $res = $this->db->query($sql);
        return $res->result();
    }

    function EliminarProductoCompra($params){

         $data = array(
            'Compra_id'          => $params['compra'],
            'Producto_id'        => $params['cod'],
            'cantidad'           => $params['cant'],
            'idgs_detallecompra' => $params['id']
        );

        $id = $params['id'];
        $cod = $params['cod'];
        $cant = $params['cant'];


        $res=$this->CantidadDelProdcuto($cod);
        $res= json_encode($res);
        $res= json_decode($res, true);
        $total= ($res[0]["stock"] - $cant);

        $actualizar=$this->ActualizarProductoSuma($cod, $total);

         $this->db->where('idgs_detallecompra', $params['id']);
         $this->db->delete('gs_detallecompra');

        return $params['id'];
    }

     public function ActualizarProductoSuma($id, $total){
        
      $sql = "UPDATE gs_producto SET stock =".$total." WHERE idgs_producto=".$id."";
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

    function ultimacompra()
    {
        $sql = "SELECT idgs_compra FROM gs_compra ORDER BY idgs_compra DESC LIMIT 1;";
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function insertCompra($params)
    {
       // $fecha=date('Y-m-d H:i:s');
        
        $data = array(
                     'fecha'             => $params['fecha'],
                     'numerocompra'      => $params['numerocompra'],
                     'total'             => null,
                     'Proveedor_id'      => $params['proveedor'],
                     'Usuario_id'        => $params['usuario'],
                     'estado'            => 0
        );
        $this->db->insert('gs_compra',  $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function EditarCompra($params){

        $data = array(
            'idgs_compra'   => $params['compra_id'],
            'total'         => $params['total'],
            'estado'        => 1
        );

        $this->db->where('idgs_compra',$params['compra_id']);
        return $this->db->update("gs_compra", $data);

        return $params['compra_id'];
    }

    public function ListarProveedor()
    {
        $sql = "SELECT idgs_proveedor, nombre, nit FROM gs_proveedor";
        $res = $this->db->query($sql);
        return $res->result();
    }
}
