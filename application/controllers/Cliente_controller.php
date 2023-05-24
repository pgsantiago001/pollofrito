<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Cliente_modelo');
		$this->load->library('session');
		$this->load->helper('url');
       // $this->load->library('form_validation');
	}		

   public function ListarCliente()
    {
         
        $res=$this->Cliente_modelo->ListarPersonal();
        $data['personal']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Cliente/ListaClientes',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }


    public function tablaCliente()
   {
  
         $res=$this->Cliente_modelo->ListaClientes();
         $data['clientes']= json_encode($res);


          $this->load->view('/Cliente/c_tabla', $data);
   }


   public function nuevoCliente()
   {
                 
          if (!empty($_POST)){
               if($_POST["idcliente"]==0){
                 $this->Cliente_modelo->InsertarCliente($_POST);
               }else{
                 $this->Cliente_modelo->EditarCliente($_POST);
               } 
          $this->load->view('/Cliente/c_tabla');
      }

   }
  
  public function eliminarCliente()
   {
          if (!empty($_POST)){
                $this->Cliente_modelo->EliminarCliente($_POST);
             }
         $this->load->view('/Cliente/c_tabla');
      }


   public function mostrar_datos_cliente()
   {
          //print_r($_POST);
          if (!empty($_POST)){

                $id = $_POST["id"];
                $res=$this->Cliente_modelo->SeleccionarCliente($id);
                $data['cliente']= json_encode($res);

                 echo $data['cliente'];
                // print_r($data['cliente']);

             }
          //$this->load->view('/Eventos/tabla');
   }
 public function consultarClienteNit(){
  if (!empty($_POST)){
                $nit = $_POST["buscar"];
                $res=$this->Cliente_modelo->SeleccionarClienteNit($nit);
               echo json_encode($res);

             }
   }
}

?>
