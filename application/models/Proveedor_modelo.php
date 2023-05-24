<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("America/Guatemala");
class Proveedor_modelo extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function ListaProveedor(){

        $sql= "SELECT * FROM gs_proveedor";

        $res = $this->db->query($sql);
        return $res->result();
    }

    function ListarPersonal()
    {
        $sql="SELECT * FROM personal";
        $res = $this->db->query($sql);
        return $res->result();
    }

     function SeleccionarProveedor($id){

        $sql= "SELECT * FROM gs_proveedor WHERE idgs_proveedor = ".$id;

        $res = $this->db->query($sql);
        return $res->result();
    }

    function EliminarProveedor($params){

         $this->db->where('idgs_proveedor', $params['id']);
         return $this->db->delete('gs_proveedor');

        return $params['id'];
    }


    function InsertarProveedor($params){

         $data = array(
            'nombre'                    => $params['nombre'],
            'sitioweb'                  => $params['sitioweb'],
            'telefono'                  => $params['telefono'],
            'nit'                       => $params['nit'],
            'nombres_cont'              => $params['nombres_cont'],
            'apellidos_cont'            => $params['apellidos_cont'],
            'correoelectronico_cont'    => $params['correoelectronico_cont'],
            'telefono_cont'             => $params['telefono_cont'],
            'direccion_cont'            => $params['direccion_cont']
        );

        $this->db->insert("gs_proveedor",  $data);
        $id = $this->db->insert_id();
        return $id;
 
        }

    function EditarProveedor($params){

        $data = array(
            'nombre'                    => $params['nombre'],
            'sitioweb'                  => $params['sitioweb'],
            'telefono'                  => $params['telefono'],
            'nit'                       => $params['nit'],
            'nombres_cont'              => $params['nombres_cont'],
            'apellidos_cont'            => $params['apellidos_cont'],
            'correoelectronico_cont'    => $params['correoelectronico_cont'],
            'telefono_cont'             => $params['telefono_cont'],
            'direccion_cont'            => $params['direccion_cont']
        );

        $this->db->where('idgs_proveedor', $params['idproveedor']);
        return $this->db->update("gs_proveedor", $data);

        return $params['idproveedor'];
    }

    public function ListarProveedor()
    {
        $sql = "SELECT idgs_proveedor,nombre,nit FROM gs_proveedor";
        $res = $this->db->query($sql);
        return $res->result();
    }
}
