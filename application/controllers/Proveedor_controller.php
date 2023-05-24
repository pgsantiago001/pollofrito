<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor_controller extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->model('Proveedor_modelo');
    $this->load->library('session');
    $this->load->helper('url');
       // $this->load->library('form_validation');
  }   

   public function ListarProveedor()
    {
         
         $res=$this->Proveedor_modelo->ListarPersonal();
         $data['personal']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Proveedores/ListaProveedor',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }


    public function tablaProveedor()
   {
  
         $res=$this->Proveedor_modelo->ListaProveedor();
         $data['proveedor']= json_encode($res);


          $this->load->view('/Proveedores/p_tabla', $data);
   }


   public function nuevoProveedor()
   {
                 
          if (!empty($_POST)){
               if($_POST["idproveedor"]==0){
                 $this->Proveedor_modelo->InsertarProveedor($_POST);
               }else{
                 $this->Proveedor_modelo->EditarProveedor($_POST);
               } 
          $this->load->view('/Proveedores/p_tabla');
      }

   }
  
  public function eliminarProveedor()
   {
          if (!empty($_POST)){
                $this->Proveedor_modelo->EliminarProveedor($_POST);
             }
         $this->load->view('/Proveedores/p_tabla');
      }


   public function mostrar_datos_proveedor()
   {
          //print_r($_POST);
          if (!empty($_POST)){

                $id = $_POST["id"];
                $res=$this->Proveedor_modelo->SeleccionarProveedor($id);
                $data['proveedor']= json_encode($res);

                 echo $data['proveedor'];
                // print_r($data['cliente']);

             }
          //$this->load->view('/Eventos/tabla');
   }


}

?>
