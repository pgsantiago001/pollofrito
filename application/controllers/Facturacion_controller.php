<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturacion_controller extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->model('Facturacion_modelo');
    $this->load->library('session');
    $this->load->helper('url');
       // $this->load->library('form_validation');
  }   

   public function ListarFactura()
    {
         
         $res=$this->Facturacion_modelo->ListarPersonal();
         $data['personal']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Facturacion/ListaFactura',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }


    public function tablaFactura()
   {
  
         $res=$this->Facturacion_modelo->ListaFactura();
         $data['factura']= json_encode($res);


          $this->load->view('/Facturacion/factura_table', $data);
   }


   public function nuevoFactura()
   {
                 
          if (!empty($_POST)){
               if($_POST["idfactura"]==0){
                 $this->Facturacion_modelo->InsertarFactura($_POST);
               }else{
                 $this->Facturacion_modelo->EditarFactura($_POST);
               } 
          $this->load->view('/Facturacion/factura_table');
      }

   }
  
  public function eliminarFactura()
   {
          if (!empty($_POST)){
                $this->Facturacion_modelo->EliminarFactura($_POST);
             }
         $this->load->view('/Facturacion/factura_table');
      }


   public function mostrar_datos_factura()
   {
          //print_r($_POST);
          if (!empty($_POST)){

                $id = $_POST["id"];
                $res=$this->Facturacion_modelo->SeleccionarFactura($id);
                $data['factura']= json_encode($res);

                 echo $data['factura'];
                // print_r($data['cliente']);

             }
          //$this->load->view('/Eventos/tabla');
   }
public function ultimoIdFac(){
    $res=$this->Facturacion_modelo->obtenerLastId();
      echo json_encode($res);
}
public function todoslosdescuentos(){
    $res=$this->Facturacion_modelo->obtenerLastId();
      echo json_encode($res);
}

}

?>