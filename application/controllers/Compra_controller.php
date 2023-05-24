<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compra_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Compra_modelo');
		$this->load->library('session');
		$this->load->helper('url');
       // $this->load->library('form_validation');
	}	

   public function ListarCompra()
    {
         
         $res=$this->Compra_modelo->ListarPersonal();
         $data['personal']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Compra/ListaCompra',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }
	 

    public function tablaComprar()
   {
  
         $res=$this->Compra_modelo->ListaCompra();
         $data['compras']= json_encode($res);


          $this->load->view('/Compra/compra_table', $data);
   }

   public function empezarCompra()
    {
         $res=$this->Compra_modelo->ListarProveedor();
         $data['proveedor']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Compra/facturacompra',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }
    public function comprar()
    {
    //  $fecha=date('Y-m-d H:i:s');
        if (!empty($_POST)){
      // print_r($_POST['usuario']);
             $params = array   (
                     'fecha'          => $_POST['fecha'],
                     'numerocompra'   => $_POST['numerocompra'],
                     'total'          => null,
                     'proveedor'      => $_POST['proveedor'],
                     'usuario'        => $_POST['usuario'],
                     'estado'         => 0                   
                  );
     
      }else{

         $params = array   (
                     'fecha'           => array(0),
                     'numerocompra'    => array(0),
                     'total'           => array(0),
                     'proveedor'       => array(0),
                     'usuario'         => array(0),
                     'estado'          => array(0)
                  );
      }
      $compra_id = $this->Compra_modelo->insertCompra($params); 
      $data['compra_id']=$compra_id;
         
      Redirect('http://localhost/pollofrito/index.php/Compra_controller/empezarDetalleCompra/'.$compra_id, false);

    }

    public function empezarDetalleCompra($compra_id){

          $compra=$this->Compra_modelo->SeleccionarCompra($compra_id);
          $data['compra']= json_encode($compra);

          $data['compra_id']=$compra_id;

          $this->load->view('/dependencias');
          $this->load->view('/Usuarios/educacion_inicio');
          $this->load->view('/Compra/detallecompra',$data);
          $this->load->view('/Usuarios/educacion_pie');
    }

    public function GenerarCompra()
    {
    
       if (!empty($_POST)){

           $total= $_POST['txtcaja'];
           $compra_id=$_POST['compra_id'];  
          // $cash=$_POST['tipopago'];
          // print_r($_POST['tipopago']);
             $params = array   (
                     'compra_id'      => $compra_id,
                     'total'          => $total,
                     'estado'         => 1                   
                  );
     
      }else{

         $params = array   (
                     
                     'compra_id'       => array(0),
                     'total'           => array(0),
                     'estado'          => array(0)
                  );
      }
      $this->Compra_modelo->EditarCompra($params); 
      //$data['factura_id']=$factura_id;
      $this->empezarCompra();
    }

  public function asignar_producto_recibir_compra()
   {
   
          if (!empty($_POST)){

               $this->Compra_modelo->AsignarProductoCompra($_POST);  

             }
   }

   public function tablacompra($compra_id)
   {            
                $res=$this->Compra_modelo->ListarProductosAsignadosCompra($compra_id);
                $data['productos']= json_encode($res);

                $compra=$this->Compra_modelo->SeleccionarCompra($compra_id);
                $data['compra']= json_encode($compra);

                $data['compra_id']=$compra_id;
              
                $this->load->view('/Compra/compra_tabla', $data);
     }

     public function tablacompra1($compra_id)
   {            
          $res=$this->Compra_modelo->ListarProductos();
          $data['productos']= json_encode($res);

          $compra=$this->Compra_modelo->SeleccionarCompra($compra_id);
          $data['compra']= json_encode($compra);

          $data['compra_id']=$compra_id;
               
                $this->load->view('/Compra/compra_tabla1', $data);
     }

  public function BorrarProductoCompra()
   {
          if (!empty($_POST)){
              
                $this->Asignacion_modelo->EliminarProductoCompra($_POST);

             }
   }

}

?>
