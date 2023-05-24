<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cargararchivo_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function autenticarUsuario($nick = '')
	{
	 $result = $this->db->query("SELECT u.idusuario as ID, u.usuario as Usuario, u.clave as Clave, p.nombre as Nombre, p.direccion as Direccion, p.tel as Telefono, u.tipo_usuario as Tipo, 
     aclog.AcUno, aclog.AcDos, aclog.AcTres, aclog.AcCuatro, aclog.AcCinco, aclog.AcSeis, aclog.AcSiete, aclog.AcOcho, aclog.AcNueve, aclog.AcDiez, aclog.RepVen, aclog.RepVenE, aclog.RepCom, aclog.RepInv
         FROM usuario as u 
         inner join personal as p  on p.idpersonal=u.id_personal 
         inner join gs_ctrl_acceso as aclog on aclog.usuario_idusuario = u.idusuario
         WHERE usuario='".$nick."' LIMIT 1");
		if($result->num_rows()>0){
			return $result->row();
		}else{
			return null;
		}
	}
public function cargaAcceso($idUser = '')
	{
	 $result = $this->db->query("SELECT u.idusuario as ID, u.usuario as Usuario, u.clave as Clave, p.nombre as Nombre, u.tipo_usuario as Tipo FROM usuario as u inner join personal as p
         on p.idpersonal=u.id_personal WHERE usuario='".$nick."' LIMIT 1");
		if($result->num_rows()>0){
			return $result->row();
		}else{
			return null;
		}
	}





	function ConvertirTexto($datos=null)
	{
		$texto="(";

		$cont=0;
		foreach ($datos as $key => $dato) {
			
			if($cont==0){
				$texto.=$dato;
			}else{
				$texto.=",".$dato;
			}
			$cont++;
		}

		$texto .= ")";

		return $texto;
	}


 /* Devuelve la lista de alumnos que se encuentran en la tabla tblalumno */

};
			