<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("America/Guatemala");
class Facturacion_modelo extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function ListaFactura(){

        $sql="SELECT f.idgs_factura AS NoFactura, c.nombre AS Cliente, f.metododepago AS Pago, f.fecha AS fecha, 
            p.nombre AS Empleado, f.total AS Total, IF(f.estado='1','Pagado','Cancelado') AS Estado
            FROM gs_factura AS f INNER JOIN gs_cliente AS c
            ON c.idgs_cliente=f.Cliente_id INNER JOIN usuario AS u
            ON u.idusuario=f.Usuario_id INNER JOIN personal AS p
            ON p.idpersonal=u.id_personal";

        $res = $this->db->query($sql);
        return $res->result();
    }

    function ListarPersonal()
    {
        $sql="SELECT * FROM personal";
        $res = $this->db->query($sql);
        return $res->result();
    }

     function SeleccionarFactura($id){

        $sql= "SELECT * FROM gs_factura WHERE idgs_factura = ".$id;

        $res = $this->db->query($sql);
        return $res->result();
    }

    function EliminarFactura($params){

         $this->db->where('idgs_factura', $params['id']);
         return $this->db->delete('gs_factura');

        return $params['id'];
    }





    public function ListarFactura()
    {
        $sql = "SELECT f.idgs_factura AS NoFactura, c.nombre AS Cliente, f.metododepago AS Pago, f.fecha AS fecha, 
                p.nombre AS Empleado, f.total AS Total, IF(f.estado='1','Pagado','Cancelado') AS Estado 
                FROM gs_factura AS f INNER JOIN gs_cliente AS c
                ON c.idgs_cliente=f.Cliente_id INNER JOIN usuario AS u
                ON u.idusuario=f.Usuario_id INNER JOIN personal AS p
                ON p.idpersonal=u.id_personal";
        $res = $this->db->query($sql);
        return $res->result();
    }
    public function obtenerLastId(){
        $sql= "SELECT idgs_factura FROM gs_factura ORDER BY idgs_factura DESC  LIMIT 1";
        $res = $this->db->query($sql);
        return $res->result();

    }
}
