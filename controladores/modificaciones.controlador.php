<?php

class ControladorModificaciones{

	/*=============================================
	MOSTRAR MODIFICACIONES
	=============================================*/

	static public function ctrMostrarModificaciones($datos){

		$tabla = "modificaciones";

		$respuesta = ModeloModificaciones::mdlMostrarModificaciones($tabla, $datos);

		return $respuesta;
	
	}
	static public function ctrMostrarUltimaModificacion($item,$valor){

		$tabla = "modificaciones";

		$respuesta = ModeloModificaciones::mdlMostrarUltimaModificacion($tabla, $item,$valor);

		return $respuesta;
	
	}

	/*=============================================
	INGRESAR MODIFICACIONES
	=============================================*/

	static public function ctrIngresarModificaciones($datos){
		
		$tabla = "modificaciones";
		
		$respuesta = ModeloModificaciones::mdlIngresarModificaciones($tabla, $datos);

	}
	

}
