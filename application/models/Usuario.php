<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login()
    {
        

    }

    function InsertarNuevo($params){

         $data = array(
            'nombre' => $params['nombre']
        );

        $this->db->insert("rubro",  $data);
        $id = $this->db->insert_id();
        return $id;
 
        }

        function InsertarNuevoU($params){

         $data = array(
         	'Nit'       		 => $params['Nit'],
            'Nombre_Cliente'	 => $params['Nombre_Cliente'],
            'Direccion'          => $params['Direccion'],
            'Telefono'           => $params['Telefono'],
            'Correo_Electronico' => $params['Correo_Electronico']
        );

        $this->db->insert("cliente",  $data);
        $idCliente = $this->db->insert_id();
        return $idCliente;
 
        }




}
