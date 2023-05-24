<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Usuario_model');
		$this->load->library('session');
		$this->load->helper('url');
	}		

	
  public function Logout()
  {
    $this->load->library('session');
    $this->session->sess_destroy();
    header("Location:".base_url('/pollofrito/index.php/Reportes/educacion_menu_login'));
  }
  
  public function educacion_menu_login()
  {
      $this->load->view('/dependencias');
      $this->load->view('/Usuarios/educacion_inicio_login');
      $this->load->view('/Usuarios/educacion_menu_login');
      $this->load->view('/Usuarios/educacion_pie');
  }
}

?>