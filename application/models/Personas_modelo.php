<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas_modelo extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login()
    {
        

    }

    function InsertarNuevoPersona($params){

         $data = array(
            'nombre'          => $params['nombre'],
            'direccion'       => $params['direccion'],
            'dpi'             => $params['dpi'],
            'tipo_tel'        => $params['tipo_tel'],
            'tel'             => $params['tel'],
            'estado'          => $params['estado']
        );

        $this->db->insert("personal",  $data);
        $id = $this->db->insert_id();
        return $id;
 
        }

    function EditarPersona($params){

        $data = array(
            'nombre'          => $params['nombre'],
            'direccion'       => $params['direccion'],
            'dpi'             => $params['dpi'],
            'tipo_tel'        => $params['tipo_tel'],
            'tel'             => $params['tel'],
            'estado'          => $params['estado']
        );

       /* $this->db->insert("eventos",  $params['nombre']);
        $id = $this->db->insert_id();*/


        $this->db->where('idpersonal', $params['idpersonal']);
        return $this->db->update("personal", $data);

        return $params['idpersonal'];
    }

    function EliminarPersona($params){

         $this->db->where('idpersonal', $params['id']);
         return $this->db->delete('personal');

        return $params['id'];
    }

    function ListarUsuario(){

        $sql= "SELECT u.idusuario as idusuario, u.usuario as usuario, u.clave as clave, 
        u.id_personal as idpersonal,  u.estado as estadousuario, u.tipo_usuario as tipousuario, p.idpersonal as idpersonal, p.nombre as nombrepersonal, p.direccion as direccion  FROM usuario AS u INNER JOIN personal AS p
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


    function SeleccionarPersona($id){


        $sql= "SELECT * FROM personal WHERE idpersonal = ".$id;

        $res = $this->db->query($sql);
        return $res->result();
    }

}
