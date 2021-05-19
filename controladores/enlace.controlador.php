<?php

class ControladorEnlace{

	/*=============================================
	ELIMINAR SEGUN LA TABLA CAJA
	=============================================*/

	static public function ctrEliminarEnlace($tabla){

		$respuesta = ModeloEnlace::mdlEliminarEnlace($tabla);

		return $respuesta;
	
	}

	/*=============================================
	ELIMINAR SEGUN LA TABLA CAJA
	=============================================*/

	static public function ctrEliminarEnlace2($tabla){

		$respuesta = ModeloEnlace::mdlEliminarEnlace2($tabla);

		return $respuesta;
	
	}



	/*=============================================
	MOSTRAR PRODUCTOS ENLACE
	=============================================*/

	static public function ctrMostrarProductosEnlace($item, $valor, $orden){

		$tabla = "productos";

		$respuesta = ModeloEnlace::mdlMostrarProductosEnlace($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR ESCRIBANOS
	=============================================*/

	static public function ctrMostrarEscribanosEnlace($item, $valor){

		$tabla = "escribanos";

		$respuesta = ModeloEnlace::mdlMostrarEscribanosEnlace($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrMostrarVentasColegio(){

		$tabla = "ventas";

		$respuesta = ModeloEnlace::mdlMostrarVentasColegio($tabla);

		return $respuesta;

	}

	static public function ctrMostrarUltimaActualizacion(){

		$tabla = "ventas";

		$respuesta = ModeloEnlace::mdlMostrarUltimaActualizacion($tabla);

		return $respuesta;

	}

	static public function ctrMostrarUltimaAVenta(){

		$tabla = "colorado";

		$respuesta = ModeloEnlace::mdlMostrarUltimaVenta($tabla);

		return $respuesta;

	}

	static public function ctrMostrarInhabilitado(){

		$tabla = "inhabilitados";

		$respuesta = ModeloEnlace::mdlMostrarInhabilitado($tabla);

		return $respuesta;

	}

	static public function ctrMostrarModificacionesEnlace($item,$valor){

		$tabla = "modificaciones";

		$respuesta = ModeloEnlace::mdlMostrarModificacionesEnlace($tabla,$item,$valor);

		return $respuesta;

	}

	static public function ctrMostrarCuotas($item,$valor){

		$tabla = "cuotas";

		$respuesta = ModeloEnlace::mdlMostrarCuotas($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	SUBIR MODIFICACIONES
	=============================================*/	

	static public function ctrSubirModificaciones($datos){

		$tabla = "modificaciones";

		$respuesta = ModeloEnlace::mdlSubirModificaciones($tabla, $datos);

		return $respuesta;
		
	}


	

}
