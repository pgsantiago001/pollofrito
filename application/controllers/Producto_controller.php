<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

class Producto_controller extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->model('Producto_modelo');
    $this->load->library('session');
    $this->load->helper('url');
       // $this->load->library('form_validation');
  }   

   public function ListarProducto()
    {
         
         $res=$this->Producto_modelo->ListarPersonal();
         $data['personal']= json_encode($res);

         $res=$this->Producto_modelo->ListarCategoria();
         $data['categoria']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Productos/ListaProducto',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }
    public function ConsultarProducto()
    {
         
         $res=$this->Producto_modelo->ListarPersonal();
         $data['personal']= json_encode($res);

         $res=$this->Producto_modelo->ListarCategoria();
         $data['categoria']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Productos/ConsultarProducto',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }

    public function tablaProducto()
   {
         $res=$this->Producto_modelo->ListaProducto();
         $data['producto']= json_encode($res);
          $this->load->view('/Productos/product_tabla', $data);
   }
   public function tablaConsultarProducto()
   {
         $res=$this->Producto_modelo->ListaProducto();
         $data['producto']= json_encode($res);
          $this->load->view('/Productos/consultarproduct_tabla', $data);
   }
    //funcion para devolver  all producto
    public function tablaProductoVent()
    {
        $res=$this->Producto_modelo->ListaProductoArr();
        echo json_encode($res);
    }
   ///funcion para devolver el producto por codigo
  public function listProdVenta()
    {
        $CodProd = $_GET["buscar"];
        $res=$this->Producto_modelo->SelecProdBarras ($CodProd);
        $data['producto']= json_encode($res);
       ///echo json_encode($res);
        echo $data['producto'];
       //$this->session->sess_destroy();

        //$res['name'] = "response";
       // echo $_GET['callback']."(".json_encode($res).");";

         }
public function listProdVentaNomb()///funcion para devolver el producto por nombre
    {
        $NomProd = $_POST["buscar"];
        $res=$this->Producto_modelo->SeleccionarProductoNombre($NomProd);
        //$data['producto']= json_encode($res);
        echo json_encode($res);
        //echo $data;
         }

   public function nuevoProducto()
   {
                 
          if (!empty($_POST)){
               if($_POST["idproducto"]==0){
                 $this->Producto_modelo->InsertarProducto($_POST);
               }else{
                 $this->Producto_modelo->EditarProducto($_POST);
               } 
          $this->load->view('/Productos/product_tabla');
      }

   }
  
  public function eliminarProducto()
   {
          if (!empty($_POST)){
                $this->Producto_modelo->EliminarProducto($_POST);
             }
         $this->load->view('/Productos/product_tabla');
      }


   public function mostrar_datos_producto()
   {
          //print_r($_POST);
          if (!empty($_POST)){

                $id = $_POST["id"];
                $res=$this->Producto_modelo->SeleccionarProducto($id);
                $data['producto']= json_encode($res);

                 echo $data['producto'];
                // print_r($data['cliente']);

             }
          //$this->load->view('/Eventos/tabla');
   }


}

?>
