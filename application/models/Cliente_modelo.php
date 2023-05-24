<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//date_default_timezone_set("America/Guatemala");
class Cliente_modelo extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function ListaClientes(){

        $sql= "SELECT * FROM gs_cliente";

        $res = $this->db->query($sql);
        return $res->result();
    }

    function ListarPersonal()
    {
        $sql="SELECT * FROM personal";
        $res = $this->db->query($sql);
        return $res->result();
    }

     function SeleccionarCliente($id){
       $sql= "SELECT * FROM gs_cliente WHERE idgs_cliente = ".$id;
        $res = $this->db->query($sql);
        return $res->result();

    }
    function SeleccionarClienteNit($nit){
        try {
            $sql= "SELECT idgs_cliente, nit, nombre, direccion_cont FROM gs_cliente WHERE nit = ".$nit;
            $res = $this->db->query($sql);
            if ($res->num_rows() <= 0)
                return '0';
            else
                return $res->result();
        } catch(Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function EliminarCliente($params){
         $this->db->where('idgs_cliente', $params['id']);
         return $this->db->delete('gs_cliente');
        return $params['id'];
    }


    function InsertarCliente($params){

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

        $this->db->insert("gs_cliente",  $data);
        $id = $this->db->insert_id();
        return $id;
 
        }

    function EditarCliente($params){

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

        $this->db->where('idgs_cliente', $params['idcliente']);
        return $this->db->update("gs_cliente", $data);

        return $params['idcliente'];
    }

    public function ListarCliente()
    {
        $sql = "SELECT idgs_cliente,nombre,nit FROM gs_cliente";
        $res = $this->db->query($sql);
        return $res->result();
    }
}
