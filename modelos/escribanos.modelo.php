<?php

require_once "conexion.php";

class ModeloEscribanos{

	/*=============================================
	MOSTRAR ESCRIBANOS
	=============================================*/

	static public function mdlMostrarEscribanos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and activo = 1");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where activo = 1 order by nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	

	/*=============================================
	CREAR ESCRIBANOS
	=============================================*/
	static public function mdlIngresarEscribano($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`nombre`,`documento`,`id_tipo_iva`,`tipo`,`facturacion`,`tipo_factura`,`cuit`,`direccion` ,`localidad`,`telefono`,`email`,`id_categoria`,`id_escribano_relacionado`,`id_osde`,`ultimolibrocomprado`,`ultimolibrodevuelto`,`inhabilitado`) VALUES
					 (:nombre,:documento,:id_tipo_iva,:tipo,:facturacion,:tipo_factura,:cuit,:direccion,:localidad,:telefono,:email,:id_categoria,:id_escribano_relacionado,:id_osde,:ultimolibrocomprado,:ultimolibrodevuelto,:inhabilitado)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_tipo_iva", $datos["id_tipo_iva"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_INT);
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
		$stmt->bindParam(":inhabilitado", $datos["inhabilitado"], PDO::PARAM_INT);
			   
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR ESCRIBANO
	=============================================*/

	static public function mdlEliminarEscribano($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR ESCRIBANO
	=============================================*/

	static public function mdlEditarEscribano($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento,cuit =:cuit,direccion = :direccion ,localidad = :localidad, telefono = :telefono, email = :email, id_categoria = :id_categoria, id_escribano_relacionado =:id_escribano_relacionado,id_osde = :id_osde WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":cuit", $datos["cuit"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_escribano_relacionado", $datos["id_escribano_relacionado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_osde", $datos["id_osde"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		

		$stmt->close();
		$stmt = null;

	}

	static public function mdlbKEscribano($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`tabla`,`tipo`,`datos`,`usuario`) VALUES
					 (:tabla,:tipo,:datos,:usuario)");

		$stmt->bindParam(":tabla", $datos["tabla"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":datos", $datos["datos"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
	   
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR HABILITADO
	=============================================*/

	static public function mdlEscribanosHabilitar($tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET inhabilitado = 0");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR INHABILITADO
	=============================================*/

	static public function mdlEscribanosInhabilitar($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET inhabilitado = 1 where id=:id");
		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}
