<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Reportes_modelo');
		$this->load->library('session');
		$this->load->helper('url');
       // $this->load->library('form_validation');
	}	

    public function ListarVentasReporteEmpleado()
    {
         
        $res=$this->Reportes_modelo->ListarPersonal();
        $data['personal']= json_encode($res);

        $res=$this->Reportes_modelo->ListarEmpleados();
        $data['empleado']=json_encode($res); 

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Reporteria/ListaVentaReportesEmpleado',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }

    public function ListarProductosReporte()
    {
         
        $res=$this->Reportes_modelo->ListarPersonal();
        $data['personal']= json_encode($res);

         $res=$this->Reportes_modelo->ListarCategoria();
         $data['categoria']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Reporteria/ListaProductosReportes',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }
    

   public function ListarVentasReporte()
    {
         
        $res=$this->Reportes_modelo->ListarPersonal();
        $data['personal']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Reporteria/ListaVentaReportes',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }

     public function ListarComprasReporte()
    {
         
        $res=$this->Reportes_modelo->ListarPersonal();
        $data['personal']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
        $this->load->view('/Usuarios/educacion_menu');
        $this->load->view('/Reporteria/ListaCompraReportes',$data);
        $this->load->view('/Usuarios/educacion_pie');

    }
	 
      public function tablaListaCompraReportes()
   {
        if(!empty($_POST)){
        $fecha1= $_POST['fecha1'];
        $fecha2= $_POST['fecha2'];
        $res=$this->Reportes_modelo->ListaCompraReporte($fecha1,$fecha2);
        $data['listaCR']= json_encode($res);

         $this->load->view('/Reporteria/reportecompra_table', $data);

        }else{

        $fecha1=date("2019-01-01");
        $fecha2=date("2020-04-30");

        $res=$this->Reportes_modelo->ListaCompraReporte($fecha1,$fecha2);
        $data['listaCR']= json_encode($res);

        
         $this->load->view('/Reporteria/reportecompra_table', $data);
        }
   }

    public function tablaListaVentaReportes()
   {
        if(!empty($_POST)){
        $fecha1= $_POST['fecha1'];
        $fecha2= $_POST['fecha2'];
        $res=$this->Reportes_modelo->ListaVentaReporte($fecha1,$fecha2);
        $data['listaVR']= json_encode($res);

         $this->load->view('/Reporteria/reporteventas_table', $data);

        }else{

        $fecha1=date("2019-01-01");
        $fecha2=date("2020-04-30");

        $res=$this->Reportes_modelo->ListaVentaReporte($fecha1,$fecha2);
        $data['listaVR']= json_encode($res);

        
         $this->load->view('/Reporteria/reporteventas_table', $data);
        }
   }
   public function tablaListaVentaReportesProductos()
   {
        if(!empty($_POST)){
        $fecha1= $_POST['fecha1'];
        $fecha2= $_POST['fecha2'];

        $res=$this->Reportes_modelo->ListaVentaReporteProductos($fecha1,$fecha2);
        $data['listaVRP']= json_encode($res);

         $this->load->view('/Reporteria/reporteventas_tableProductos', $data);
        }else{

        $fecha1=date("2019-01-01");
        $fecha2=date("2020-04-30");

        $res=$this->Reportes_modelo->ListaVentaReporteProductos($fecha1,$fecha2);
        $data['listaVRP']= json_encode($res);

        
         $this->load->view('/Reporteria/reporteventas_tableProductos', $data);
        }
   }
    public function tablaListaVentaReportesEmpleado()
   {

        if(!empty($_POST)){
            $empleado = $_POST['empleado'];    
            $params = array (
            'empleado' => $empleado
        );
    }else{
      $params = array (
        'empleado' => array(0)
        );
    } 

        if(!empty($_POST)){
        $fecha1= $_POST['fecha1'];
        $fecha2= $_POST['fecha2'];

        $res=$this->Reportes_modelo->ListaVentaReporteEmpleado($fecha1,$fecha2,$params);
        $data['listaVRE']= json_encode($res);

         $this->load->view('/Reporteria/reporteventas_tableEmpleado', $data);

        }else{

        $fecha1=date("2019-01-01");
        $fecha2=date("2020-04-30");
        $res=$this->Reportes_modelo->ListaVentaReporteEmpleado($fecha1,$fecha2,$params);
        $data['listaVRE']= json_encode($res);

        
         $this->load->view('/Reporteria/reporteventas_tableEmpleado', $data);
        }
   }
    public function tablaListaProductosReportes()
   { 
        if(!empty($_POST)){
          $categoria=$_POST['Categoria_id'];
            if ($categoria>0){
                $res=$this->Reportes_modelo->ListarProductosReportesParametro($categoria);
                $data['listaPR']= json_encode($res);
                $this->load->view('/Reporteria/reporteprodcuto_table', $data);
            }else{
              $res=$this->Reportes_modelo->ListarProductosReportes();
              $data['listaPR']= json_encode($res);
              $this->load->view('/Reporteria/reporteprodcuto_table', $data);
            }
           
        }else{
          
          $res=$this->Reportes_modelo->ListarProductosReportes();
          $data['listaPR']= json_encode($res);

        $this->load->view('/Reporteria/reporteprodcuto_table', $data);
        }
        
  }


   public function empezarCompra()
    {
         $res=$this->Compra_modelo->ListarProveedor();
         $data['proveedor']= json_encode($res);

        $this->load->view('/dependencias');
        $this->load->view('/Usuarios/educacion_inicio');
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
