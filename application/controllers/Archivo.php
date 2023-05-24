<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class archivo extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Usuario_model');
		$this->load->model('cargararchivo_model');
		$this->load->library('session');
		$this->load->helper('url');
	}		

	public function educacion_menu_login()
  {
      
      $this->load->view('/dependencias');
      $this->load->view('/Usuarios/educacion_inicio_login');
      $this->load->view('/Usuarios/educacion_menu_login');
      $this->load->view('/Usuarios/educacion_pie');
  }
  public function index2(){
    $this->load->view('/dependencias');
    $this->load->view('/Usuarios/educacion_inicio');
    $this->load->view('/Usuarios/educacion_menu');
    $this->load->view('/Usuarios/homeMenu');
    $this->load->view('/Usuarios/educacion_pie');
  }
  public function index()
  {

    $usuario =$this->input->post('nick');
    $contra =$this->input->post('contra');
    $tipo = "SUPER";
    $tipo2 = "NORMAL";
    $Sucursal;

   $this->load->model('cargararchivo_model');
   $fila= $this->cargararchivo_model->autenticarUsuario($usuario);


   if($fila != null){
      if((trim($fila->Clave) == trim($contra)) and (trim($fila->Tipo)== trim($tipo))){
        $data = $arrayName = array(
          'Usuario'    => $usuario , 
          'Nombre'     => $fila->Nombre,
          'ID'         => $fila->ID,
          'login'      => true,
           'AcUno'     => $fila->AcUno,
           'AcDos'     => $fila->AcDos,
           'AcTres'    => $fila->AcTres,
           'AcCuatro'  => $fila->AcCuatro,
           'AcCinco'   => $fila->AcCinco,
           'AcSeis'    => $fila->AcSeis,
           'AcSiete'   => $fila->AcSiete,
           'AcOcho'    => $fila->AcOcho,
           'AcNueve'   => $fila->AcNueve,
           'AcDiez'    => $fila->AcDiez,
           'RepVen'    => $fila->RepVen,
           'RepVenE'   => $fila->RepVenE,
           'RepCom'    => $fila->RepCom,
           'RepInv'    => $fila->RepInv,
           'nivel'     => $fila->Tipo,
           'Direccion' => $fila->Direccion,
           'Telefono'  => $fila->Telefono

      );
          $this->session->set_userdata($data);
          $this->load->view('/dependencias');
          $this->load->view('/Usuarios/educacion_inicio');
          $this->load->view('/Usuarios/SeleccionarAcceso');
          $this->load->view('/Usuarios/homeMenu');
          $this->load->view('/Usuarios/educacion_pie');
      }else{
        if((trim($fila->Clave) == trim($contra)) and (trim($fila->Tipo)== trim($tipo2))){
          $data = $arrayName = array(
              'Usuario'    => $usuario ,
              'Nombre'     => $fila->Nombre,
              'ID'         => $fila->ID,
              'login'      => true,
              'AcUno'     => $fila->AcUno,
              'AcDos'     => $fila->AcDos,
              'AcTres'    => $fila->AcTres,
              'AcCuatro'  => $fila->AcCuatro,
              'AcCinco'   => $fila->AcCinco,
              'AcSeis'    => $fila->AcSeis,
              'AcSiete'   => $fila->AcSiete,
              'AcOcho'    => $fila->AcOcho,
              'AcNueve'   => $fila->AcNueve,
              'AcDiez'    => $fila->AcDiez,
              'RepVen'    => $fila->RepVen,
              'RepVenE'   => $fila->RepVenE,
              'RepCom'    => $fila->RepCom,
              'RepInv'    => $fila->RepInv,
              'nivel'     => $fila->Tipo,
              'Direccion' => $fila->Direccion,
              'Telefono'  => $fila->Telefono
      );
          $this->session->set_userdata($data);
          $this->load->view('/dependencias');
            $this->load->view('/dependencias');
            $this->load->view('/Usuarios/educacion_inicio');
            $this->load->view('/Usuarios/SeleccionarAcceso');
            //$this->load->view('/Usuarios/homeMenu');
            $this->load->view('/Usuarios/educacion_pie');

        }else{
          header("Location:".base_url('/pollofrito/index.php/archivo/educacion_menu_login'));
        }
      }
   }else{
    header("Location:".base_url('/pollofrito/index.php/archivo/educacion_menu_login'));
   }
  } 

  public function Logout()
  {
    $this->load->library('session');
    $this->session->sess_destroy();
    header("Location:".base_url().'/pollofrito/index.php/archivo/educacion_menu_login');
  } 
}

?>