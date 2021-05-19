<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/escribanos.controlador.php";
require_once "../modelos/escribanos.modelo.php";

require_once "../controladores/enlace.controlador.php";
require_once "../modelos/enlace.modelo.php";

class AjaxCtaCorrienteVenta{

	/*=============================================
	UPDATE SELECCIONAR VENTA
	=============================================*/	
	public function ajaxVerVenta(){

		$item = "id";
		$valor = $_POST["idVenta"];

		$respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);
		
		echo json_encode($respuesta);

	}


	/*=============================================
	VER CUOTA
	=============================================*/	
	public function ajaxVerCuota(){

		$item = "id";
		$valor = $_POST["idCuota"];

		$respuesta = ControladorEnlace::ctrMostrarCuotas($item, $valor);
		
		echo json_encode($respuesta);

	}

	/*=============================================
	VER ESCRIBANO
	=============================================*/	
	public function ajaxVerEscribano(){

		$itemCliente = "id";
      	$valorCliente = $_POST["idEscribano"];

      	$respuestaCliente = ControladorEscribanos::ctrMostrarEscribanos($itemCliente, $valorCliente);
		
		echo json_encode($respuestaCliente);

	}

	/*=============================================
	VER ESCRIBANO
	=============================================*/	
	public function ajaxVerArt(){

		$item = "id";
		$valor = $_POST["idVentaArt"];

		$respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);
		
		$listaProductos = json_decode($respuesta['productos'], true);

		echo json_encode($listaProductos);
		

	}

	/*=============================================
	VER ARTICULO DE CUOTA
	=============================================*/	
	public function ajaxVerArtCuota(){

		$item = "id";
		$valor = $_POST["idCuotaArt"];

		$respuesta = ControladorEnlace::ctrMostrarCuotas($item, $valor);
		
		$listaProductos = json_decode($respuesta['productos'], true);

		echo json_encode($listaProductos);
		

	}

	/*=============================================
	VER ESCRIBANO
	=============================================*/	
	public function ajaxVerPagoDerecho(){

		$item = "id";
		$valor = $_POST["idPagoDerecho"];

		$respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);
		
		$listaProductos = json_decode($respuesta['productos'], true);

		echo json_encode($listaProductos);
		

	}
	
}

/*=============================================
EDITAR CUENTA CORRIENTE
=============================================*/	
if(isset($_POST["idVenta"])){

	$seleccionarFactura = new AjaxCtaCorrienteVenta();
	
	$seleccionarFactura -> ajaxVerVenta();
}

/*=============================================
VER CUENTA CORRIENTE CLIENTE
=============================================*/	
if(isset($_POST["idEscribano"])){

	$verEscribano = new AjaxCtaCorrienteVenta();
	
	$verEscribano -> ajaxVerEscribano();
}

/*=============================================
VER ARTICULOS CORRIENTE 
=============================================*/	
if(isset($_POST["idVentaArt"])){

	$verTabla = new AjaxCtaCorrienteVenta();
	
	$verTabla -> ajaxVerArt();
}

/*=============================================
VER ARTICULOS CORRIENTE 
=============================================*/	
if(isset($_POST["idPagoDerecho"])){

	$verTabla = new AjaxCtaCorrienteVenta();
	
	$verTabla -> ajaxVerPagoDerecho();
}

/*=============================================
EDITAR CUENTA CORRIENTE
=============================================*/	
if(isset($_POST["idCuota"])){

	$seleccionarFactura = new AjaxCtaCorrienteVenta();
	
	$seleccionarFactura -> ajaxVerCuota();
}
/*=============================================
VER ARTICULOS CUOTA 
=============================================*/	
if(isset($_POST["idCuotaArt"])){

	$verTabla = new AjaxCtaCorrienteVenta();
	
	$verTabla -> ajaxVerArtCuota();
}

