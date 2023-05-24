<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
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

	function InsertarGrafico($datos=null, $valor=null, $tipo=0)
	{
		/*0=enter, 1=string*/
		
		if(strlen($datos)==0){
			$datos='[';
		}
		$datos=str_replace(']', '', $datos);
		if($tipo==1){
			$t='"';
		}else{
			$t='';
		}
		if($datos=='['){
			$datos.=$t.$valor.$t;
		}else{
			$datos.=','.$t.$valor.$t;
		}
		$datos.=']';
		return $datos;
	}

	function InsertarGenerico($params){

			//print_r($params);

			$campo_tablaI= $params['campoI'];
			$campo_tablaII= $params['campoII'];


			$data = array(
				$campo_tablaI => $params[$campo_tablaI],
				$campo_tablaII => $params[$campo_tablaII]
			);

			//print_r($data);

			$this->db->insert($params['tabla'], $data);

			$id = $this->db->insert_id();

			//return $id;

	}


	public function ListaUsuarios()
	{
		$sql = "SELECT c.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, c.nombre AS NombreApellidos, c.puesto AS Puesto
					FROM region AS r INNER JOIN departamento AS d
					ON r.idregion=d.idregion INNER JOIN cotizador c
					ON d.codigo=c.departamento_codigo
					UNION
					SELECT de.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, de.nombre AS NombreApellidos, de.puesto AS Puesto
					FROM region AS r INNER JOIN departamento AS d
					ON r.idregion=d.idregion INNER JOIN departamento_estadistica AS de
					ON de.departamento_codigo=d.codigo
					UNION
					SELECT vb.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, vb.nombre AS NombreApellidos, vb.puesto AS Puesto
					FROM region AS r INNER JOIN departamento AS d
					ON r.idregion=d.idregion INNER JOIN visto_bueno AS vb
					ON d.codigo=vb.departamento_codigo
					UNION
					SELECT s.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, s.nombre AS NombreApellidos, s.puesto AS Puesto
					FROM region AS r INNER JOIN departamento AS d
					ON r.idregion=d.idregion INNER JOIN supervisor AS s
					ON d.codigo=s.departamento_codigo;";
		$res = $this->db->query($sql);
		return $res->result();
	}

	public function SeleccionarUsuario($parametros)
	{
		$idusuario = $_POST['id_usuario'];

$sql="SELECT c.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, c.nombre AS NombreApellidos, 
	c.puesto AS Puesto, u.cel AS Cel, u.extencion AS Extensión, u.nick AS Nick, u.contra AS Contraseña,
	ro.descripcion AS RolSistema, tp.descripcion AS TipoPuesto
	FROM region AS r INNER JOIN departamento AS d
	ON r.idregion=d.idregion INNER JOIN cotizador AS c
	ON d.codigo=c.departamento_codigo INNER JOIN usuario AS u
	ON u.idusuario=c.usuario_idusuario INNER JOIN rol AS ro
	ON ro.idrol=u.rol_idrol INNER JOIN tipo_puesto AS tp
	ON tp.idtipo_puesto=u.tipo_puesto_idtipo_puesto
	WHERE u.idusuario=".$idusuario."
	UNION
	SELECT de.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, de.nombre AS NombreApellidos, 
	de.puesto AS Puesto, u.cel AS Cel, u.extencion AS Exten, u.nick AS Nick, u.contra AS Contraseña,
	ro.descripcion AS RolSistema, tp.descripcion AS TipoPuesto
	FROM region AS r INNER JOIN departamento AS d
	ON r.idregion=d.idregion INNER JOIN departamento_estadistica AS de
	ON de.departamento_codigo=d.codigo INNER JOIN usuario AS u
	ON u.idusuario=de.usuario_idusuario INNER JOIN rol AS ro
	ON ro.idrol=u.rol_idrol INNER JOIN tipo_puesto AS tp
	ON tp.idtipo_puesto=u.tipo_puesto_idtipo_puesto
	WHERE u.idusuario=".$idusuario."
	UNION
	SELECT vb.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, vb.nombre AS NombreApellidos, 
	vb.puesto AS Puesto, u.cel AS Cel, u.extencion AS Exten, u.nick AS Nick, u.contra AS Contraseña,
	ro.descripcion AS RolSistema, tp.descripcion AS TipoPuesto
	FROM region AS r INNER JOIN departamento AS d
	ON r.idregion=d.idregion INNER JOIN visto_bueno AS vb
	ON d.codigo=vb.departamento_codigo INNER JOIN usuario AS u
	ON u.idusuario=vb.usuario_idusuario INNER JOIN rol AS ro
	ON ro.idrol=u.rol_idrol INNER JOIN tipo_puesto AS tp
	ON tp.idtipo_puesto=u.tipo_puesto_idtipo_puesto
	WHERE u.idusuario=".$idusuario."
	UNION
	SELECT s.codigo AS ID, r.etiqueta AS Region, d.etiqueta AS Depto, s.nombre AS NombreApellidos, 
	s.puesto AS Puesto, u.cel AS Cel, u.extencion AS Exten, u.nick AS Nick, u.contra AS Contraseña,
	ro.descripcion AS RolSistema, tp.descripcion AS TipoPuesto
	FROM region AS r INNER JOIN departamento AS d
	ON r.idregion=d.idregion INNER JOIN supervisor AS s
	ON d.codigo=s.departamento_codigo INNER JOIN usuario AS u
	ON u.idusuario=s.usuario_idusuario INNER JOIN rol AS ro
	ON ro.idrol=u.rol_idrol INNER JOIN tipo_puesto AS tp
	ON tp.idtipo_puesto=u.tipo_puesto_idtipo_puesto
	WHERE u.idusuario=".$idusuario."";
		
	$res = $this->db->query($sql);
	return $res->result();
	}

	

}