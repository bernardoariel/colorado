<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/comprobantes.controlador.php";
require_once "../modelos/comprobantes.modelo.php";
require_once "../controladores/escribanos.controlador.php";
require_once "../modelos/escribanos.modelo.php";
require_once "../controladores/caja.controlador.php";
require_once "../modelos/caja.modelo.php";

class AjaxCrearVenta{

	/*=============================================
	CREAR NUEVA VENTA
	=============================================*/	
	public function ajaxNuevaVenta(){

		$respuesta = ControladorVentas::ctrCrearVenta();
		
		return $respuesta;
		// print_r($_POST);

	}

	/*=============================================
	EDITAR ULTIMA VENTA
	=============================================*/	
	public function ajaxEditarVenta(){

		$respuesta = ControladorVentas::ctrEditarVenta();
	
		return $respuesta;

	}

	/*=============================================
	TRAER LA ULTIMA VENTA
	=============================================*/	
	public function ajaxUltimaVenta(){
	
		$respuesta =  ControladorVentas::ctrUltimoId();
		echo json_encode($respuesta);

	}
	/*=============================================
	FACTURA SIN HOMOLOGACION
	=============================================*/	
	public function ajaxSinHomologacion(){

		$fecha = date("Y-m-d");

		if ($_POST["listaMetodoPago"]=="CTA.CORRIENTE"){
			
			$adeuda=$_POST["totalVenta"];

			$fechapago="0000-00-00";

		}else{

			$adeuda=0;

			$fechapago = $fecha;
		}
		
		$tabla = 'ventas';
		$codigoFactura ="SIN HOMOLOGAR";
		echo '<center><pre>'; print_r($_POST); echo '</pre></center>';
		$datos = array("id_vendedor"=>$_POST["idVendedor"],
					   "fecha"=>$fecha,
					   "tipo"=>"FC",
					   "id_cliente"=>$_POST["seleccionarCliente"],
					   "nombre"=>$_POST['nombreCliente'],
					   "documento"=>$_POST['documentoCliente'],
					   "tabla"=>$_POST['tipoCliente'],
					   "codigo"=>$codigoFactura,
					   "productos"=>$_POST["listaProductos"],
					   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
					   "neto"=>$_POST["nuevoPrecioNeto"],
					   "total"=>$_POST["totalVenta"],
					   "adeuda"=>$adeuda,
					   "obs"=>'',
					   "metodo_pago"=>$_POST["listaMetodoPago"],
					   "referenciapago"=>$_POST["nuevaReferencia"],
					   "cae"=>'',
					   "fecha_cae"=>'',
					   "fechapago"=>$fechapago,
						"qr"=>'');

	   

				$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
	}

	/*=============================================
	FACTURA SIN HOMOLOGACION
	=============================================*/	
	public function ajaxEditarVentaSinHomologar(){

  //   	$tablaClientes = "escribanos";

		// $item = "id";
		// $valor = $_POST["seleccionarCliente"];

		// $traerCliente = ModeloEscribanos::mdlMostrarEscribanos($tablaClientes, $item, $valor);
		// if($traerCliente['facturacion']=="CUIT"){
		// 			$nombre=$traerCliente['nombre'];
		// 			$documento=$traerCliente['cuit'];
		// 		}else{
		// 			$nombre=$traerCliente['nombre'];
		// 			$documento=$traerCliente['documento'];

		// 		}	
		/*=============================================
		FORMATEO LOS DATOS
		=============================================*/	
	
		$fecha = date("Y-m-d");

		if ($_POST["listaMetodoPago"]=="CTA.CORRIENTE"){
			
			$adeuda=$_POST["totalVenta"];

			$fechapago="0000-00-00";


		}else{

			$adeuda=0;

			$fechapago = $fecha;
		}
			
		

		$tabla = "ventas";
		

    	$codigoFactura ="SIN HOMOLOGAR";
        $datos = array("id"=>$_POST["idVentaSinHomologacion"],
				  "id_vendedor"=>1,
				   "fecha"=>date('Y-m-d'),
				   "codigo"=>$codigoFactura,
				   "tipo"=>'CU',
				   "id_cliente"=>$_POST['seleccionarCliente'],
				   "nombre"=>$traerCliente['nombre'],
				   "documento"=>$traerCliente['documento'],
				   "productos"=>$_POST['listaProductos'],
				   "impuesto"=>0,
				   "neto"=>0,
				   "total"=>$_POST["totalVenta"],
				   "adeuda"=>'0',
				   "obs"=>'',
				   "cae"=>'',
				   "fecha_cae"=>'',
				   "fechapago"=>$fechapago,
				   "metodo_pago"=>$_POST['listaMetodoPago'],
				   "referenciapago"=>$_POST['nuevaReferencia']
				   );


		$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);
	}
	/*=============================================
	HOLOGOGACION VENTA
	=============================================*/	
	public function ajaxHomogacionVenta(){

		$respuesta = ControladorVentas::ctrHomologacionVenta();
	
		return $respuesta;

	}
}
/*=============================================
Traer el ultimo id de factura
=============================================*/	

if(isset($_POST["ultimaFactura"])){

	$nuevaVenta = new AjaxCrearVenta();
	$nuevaVenta -> ajaxUltimaVenta();

}
/*=============================================
CREAR NUEVA VENTA CON FACTURA ELECTRONICA SI NO HAY NINGUN ERROR
=============================================*/	

if(isset($_POST["nuevaVenta"])){

	$nuevaVenta = new AjaxCrearVenta();
	$nuevaVenta -> ajaxNuevaVenta();

}
/*=============================================
CREAR NUEVA VENTA CON PENDIENTE A FACTURAR PERO SI EXISTE UN ERROR
=============================================*/	

if(isset($_POST["sinHomologacion"])){

	$nuevaVenta = new AjaxCrearVenta();
	$nuevaVenta -> ajaxSinHomologacion();

}

/*=============================================
EDITA UNA VENTA CUOTA O REINTEGRO PERO SI NO TIENE ERROR
=============================================*/	

if(isset($_POST["idVenta"])){

	$nuevaVenta = new AjaxCrearVenta();
	$nuevaVenta -> ajaxEditarVenta();

}
/*=============================================
EDITA UNA VENTA CUOTA O REINTEGRO PERO SI NO TIENE ERROR
=============================================*/	

if(isset($_POST["idVentaSinHomologacion"])){

	$nuevaVenta = new AjaxCrearVenta();
	$nuevaVenta -> ajaxEditarVentaSinHomologar();

}

// ControladorVentas();
//           $realizarHomologacion -> ctrHomologacionVenta();

/*=============================================
HOMOLOGA UNA FACTURA SI TIENE LOS DATOS CORRECTOS Y SI HAY INTERNET
=============================================*/	
if(isset($_POST["idVentaHomologacion"])){


	$nuevaVenta = new AjaxCrearVenta();
	$nuevaVenta -> ajaxHomogacionVenta();

}