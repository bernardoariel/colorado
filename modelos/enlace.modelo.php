<?php

require_once "conexion.php";

class ModeloEnlace{

	/*=============================================
	ELIMINAR DATOS DE LA TABLA ENLACE
	=============================================*/

	static public function mdlEliminarEnlace($tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");

		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEliminarEnlace2($tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo like '1'");

		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRODUCTOS ENLACE
	=============================================*/

	static public function mdlMostrarProductosEnlace($tabla, $item, $valor, $orden){

	
		$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	INGRESAR PRODUCTOS AL LOCALHOST
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`id`,`nombre`, `descripcion`, `codigo`, `nrocomprobante`, `cantventa`, `id_rubro`, `cantminima`, `cuotas`, `importe`, `obs`) VALUES (:id,:nombre,:descripcion,:codigo,:nrocomprobante,:cantventa,:id_rubro,:cantminima,:cuotas,:importe,:obs)");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nrocomprobante", $datos["nrocomprobante"], PDO::PARAM_INT);
		$stmt->bindParam(":cantventa", $datos["cantventa"], PDO::PARAM_INT);
		$stmt->bindParam(":id_rubro", $datos["id_rubro"], PDO::PARAM_INT);
		$stmt->bindParam(":cantminima", $datos["cantminima"], PDO::PARAM_INT);
		$stmt->bindParam(":cuotas", $datos["cuotas"], PDO::PARAM_INT);
		$stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datos["obs"], PDO::PARAM_STR);
		
	

		if($stmt->execute()){

			 return "ok";

			
		}else{

			 return "error";

		
		}

		// $stmt->close();
		// $stmt = null;

	}

	/*=============================================
	MOSTRAR ESCRIBANOS
	=============================================*/

	static public function mdlMostrarEscribanosEnlace($tabla, $item, $valor){

		$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

			

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	INTRODUCIR  ESCRIBANOS AL ENLACE
	=============================================*/

	static public function mdlIngresarEscribano($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`id`,`nombre`,`documento`,`id_tipo_iva`,`tipo`,`facturacion`,`tipo_factura`,`cuit`, `direccion`,`localidad`, `telefono`,`email` ,  `id_categoria`,`id_escribano_relacionado`, `id_osde`,`ultimolibrocomprado`,`ultimolibrodevuelto`) VALUES
					 (:id,:nombre,:documento,:id_tipo_iva,:tipo,:facturacion,:tipo_factura,:cuit,:direccion,:localidad,:telefono,:email,:id_categoria,:id_escribano_relacionado,:id_osde,:ultimolibrocomprado,:ultimolibrodevuelto)");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);

		$stmt->bindParam(":id_tipo_iva", $datos["id_tipo_iva"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":facturacion", $datos["facturacion"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_factura", $datos["tipo_factura"], PDO::PARAM_STR);


		$stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_escribano_relacionado", $datos["id_escribano_relacionado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_osde", $datos["id_osde"], PDO::PARAM_INT);
		$stmt->bindParam(":ultimolibrocomprado", $datos["ultimolibrocomprado"], PDO::PARAM_INT);
		$stmt->bindParam(":ultimolibrodevuelto", $datos["ultimolibrodevuelto"], PDO::PARAM_INT);
		

			   
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentasColegio($tabla){

		$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id,fecha,codigo,tipo,id_cliente, nombre,documento,id_vendedor,tabla,productos,impuesto,neto,total,adeuda,metodo_pago,fechapago,referenciapago) VALUES (:id,:fecha,:codigo,:tipo, :id_cliente,:nombre,:documento, :id_vendedor,:tabla, :productos, :impuesto, :neto, :total,:adeuda,:metodo_pago,:fechapago,:referenciapago)");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":tabla", $datos["tabla"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":adeuda", $datos["adeuda"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":referenciapago", $datos["referenciapago"], PDO::PARAM_STR);
		$stmt->bindParam(":fechapago", $datos["fechapago"], PDO::PARAM_STR);
		
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarUltimaActualizacion($tabla){

		$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla limit 1");

		$stmt -> execute();

		return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarUltimaVenta($tabla){

		$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla  order by id desc limit 1");

		$stmt -> execute();

		return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}


	
    /*=============================================
	REGISTRO DE VENTA
	=============================================*/
	static public function mdlIngresarVentaEnlace($tabla, $datos){

		$stmt = Conexion::conectarEnlace()->prepare("INSERT INTO $tabla(id,fecha,codigo,tipo,id_cliente,nombre,documento,tabla, id_vendedor, productos,impuesto,neto,total,adeuda,cae,fecha_cae,metodo_pago,fechapago,referenciapago,observaciones) VALUES (:id,:fecha,:codigo,:tipo, :id_cliente,:nombre,:documento,:tabla, :id_vendedor, :productos, :impuesto, :neto, :total,:adeuda,:cae,:fecha_cae,:metodo_pago,:fechapago,:referenciapago,:observaciones)");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":tabla", $datos["tabla"], PDO::PARAM_STR);

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":adeuda", $datos["adeuda"], PDO::PARAM_STR);

		$stmt->bindParam(":cae", $datos["cae"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cae", $datos["fecha_cae"], PDO::PARAM_STR);

		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":referenciapago", $datos["referenciapago"], PDO::PARAM_STR);
		$stmt->bindParam(":fechapago", $datos["fechapago"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		

                    
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarInhabilitado($tabla){

		$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla ");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR MODIFICACIONES
	=============================================*/

	static public function mdlMostrarModificacionesEnlace($tabla, $item, $valor){


		$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla WHERE $item = :$item and colorado = 0 order by id desc limit 1");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

	

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarCuotas($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by id desc limit 1");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectarEnlace()->prepare("SELECT * FROM $tabla order by id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRAR MODIFICACIONES
	=============================================*/
	static public function mdlSubirModificaciones($tabla,$datos){
	
		$stmt = Conexion::conectarEnlace()->prepare("UPDATE $tabla SET colorado = 1 WHERE $datos");

		if($stmt->execute()){

			 return "ok";

			
		}else{

			 return "error";

		
		}

		$stmt->close();
		$stmt = null;

	}

}

