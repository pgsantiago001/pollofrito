<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_modelo extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login()
    {
        

    }

    function InsertarNuevoUsuario($params){

         $data = array(
            'usuario'     => $params['usuario'],
            'clave'       => $params['clave'],
            'id_personal' => $params['id_personal'],
            'estado'      => $params['estado'],
            'tipo_usuario'=> $params['tipo_usuario']
        );
        $this->db->insert("usuario",  $data);
        $id = $this->db->insert_id();
        $res=$this->LogMds($id);
        return $res;
        }
    function LogMds($id){

        $data = array(
            'usuario_idusuario'   => $id
        );
        $this->db->insert("gs_ctrl_acceso",  $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function InsertarPersona($params){

        $data = array(
            'nombre '    => $params['nombre'],
            'direccion ' => $params['direccion'],
            'dpi'        => $params['dpi'],
            'tel '       => $params['tel']
        );

        $this->db->insert("personal",  $data);
        $id = $this->db->insert_id();
        return $id;

    }
    function EditarUsuario($params){

        $data = array(
            'usuario'     => $params['usuario'],
            'clave'       => $params['clave'],
            'id_personal' => $params['id_personal'],
            'estado'      => $params['estado'],
            'tipo_usuario'=> $params['tipo_usuario']
        );

       /* $this->db->insert("eventos",  $params['nombre']);
        $id = $this->db->insert_id();*/


        $this->db->where('idusuario', $params['idusuario']);
        return $this->db->update("usuario", $data);

        return $params['idusuario'];
    }

    function EliminarUsuario($params){

         $this->db->where('idusuario', $params['id']);
         return $this->db->delete('usuario');

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


    function SeleccionarUsuario($id){


        $sql= "SELECT * FROM usuario WHERE idusuario = ".$id;

        $res = $this->db->query($sql);
        return $res->result();
    }
     function CargarUsrAccess(){
         $idUsr = $_POST['idUserLg'];
         $sql= "SELECT u.idusuario as ID, u.usuario as Usuario,  u.tipo_usuario as Tipo, 
     aclog.AcUno, aclog.AcDos, aclog.AcTres, aclog.AcCuatro, aclog.AcCinco, aclog.AcSeis, aclog.AcSiete, 
     aclog.AcOcho, aclog.AcNueve, aclog.AcDiez, aclog.RepVen, aclog.RepCom, aclog.RepInv, aclog.chAcConsultarProd
         FROM usuario as u 
         inner join gs_ctrl_acceso as aclog on aclog.usuario_idusuario = u.idusuario
         WHERE u.id_personal =".$idUsr." LIMIT 1";
         $res = $this->db->query($sql);
         return $res->result();
    }
    function ActualizarAccesos($params){

        $data = array(
            $params['campo']  => $params['valor']
        );
        $this->db->where('usuario_idusuario', $params['idUserLg']);
        return $this->db->update("gs_ctrl_acceso", $data);

        return $params['idusuario'];
    }
    function ListaSucursales(){
        $idUsr = $_POST['idUsrLg'];
        $sql="SELECT em.idgs_empresa AS ID, em.nombre AS Empresa
            FROM gs_asignaciontienda AS asig INNER JOIN  gs_empresa AS em
            ON em.idgs_empresa=asig.Tienda_id INNER JOIN usuario AS u
            ON u.idusuario=asig.Usuario_id INNER JOIN personal AS p
            ON p.idpersonal=u.id_personal 
            WHERE asig.Usuario_id=".$idUsr."";
        $res = $this->db->query($sql);
        return $res->result_array();
    }



}
