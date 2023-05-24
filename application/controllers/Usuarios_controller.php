<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Usuario_modelo');
		$this->load->library('session');
		$this->load->library('session');
		$this->load->helper('url');
       // $this->load->library('form_validation');
	}		

	public function portadaUsuario()
   {
      	$res=$this->Usuario_modelo->ListarPersonal();
         $data['personal']= json_encode($res);
        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
       $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Usuario/u_crud', $data);
        $this->load->view('/Usuarios/educacion_pie');
   }
public function accUserPer()
   {

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
       $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Usuario/accesosUsrV');
        $this->load->view('/Usuarios/educacion_pie');
   }


  public function tablaUsuario()
   {
  
          $res=$this->Usuario_modelo->ListarUsuario();
          $data['usuario']= json_encode($res);


          $this->load->view('/Usuario/u_tabla', $data);
   }

  public function nuevoUsuario()
   {
   
          if (!empty($_POST)){
               if($_POST["estado"]=='Activo'){
                  $this->Usuario_modelo->InsertarNuevoUsuario($_POST);
               }else{
                  $this->Usuario_modelo->EditarUsuario($_POST);
               } 
          $this->load->view('/Usuario/usuarios_tabla');
      }

   }
   ///Crear usuario para poder loguearse
    public function UsrNew()   {
        $res=$this->Usuario_modelo->InsertarNuevoUsuario($_POST);
        echo json_encode($res);
  }


  public function eliminarUsuario()
   {
          if (!empty($_POST)){
                $this->Usuario_modelo->EliminarUsuario($_POST);
             }
         $this->load->view('/Usuario/u_tabla');
      }


   public function mostrar_datos_usuario()
   {
          if (!empty($_POST)){

                $id = $_POST["id"];
                $res=$this->Usuario_modelo->SeleccionarUsuario($id);
                $data['usuario']= json_encode($res);

                 echo $data['usuario'];

             }
          //$this->load->view('/Eventos/tabla');
   }
   public function addPersona(){
       $res=$this->Usuario_modelo->InsertarPersona($_POST);
       echo json_encode($res);

      // $this->Usuario_modelo->InsertarPersona($_POST);
      // echo json_encode($res);
   }
public function verPersonalLst(){
       $res=$this->Usuario_modelo->ListarPersonal();
       echo json_encode($res);
   }
public function verAcLogMenu(){
       $res=$this->Usuario_modelo->CargarUsrAccess($_POST);
       echo json_encode($res);
   }

public function ActAccLogue(){
       $res=$this->Usuario_modelo->ActualizarAccesos($_POST);
       echo json_encode($res);
   }
   public function ObtSucursales()
    {
        $res=$this->Usuario_modelo->ListaSucursales($_POST);
        echo json_encode($res);
    }


}

?>
