<?php 
        #ELIMINAR PRODUCTOS DEL ENLACE
       ControladorEnlace::ctrEliminarEnlace('escribanos');
        #TRAER PRODUCTOS DEL COLEGIO
        $item = null;
        $valor = null;
        $orden = "id";

        $escribanos = ControladorEnlace::ctrMostrarEscribanosEnlace($item, $valor, $orden);
        
        
        $cantidadEscribanos = count($escribanos);

        $cant=0;
        foreach ($escribanos as $key => $value) {
          # code...
         
           $tabla = "escribanos";

           $datos =array("id"=>$value["id"],
                         "nombre"=>strtoupper($value["nombre"]),
                         "documento"=>$value["documento"],
                         "id_tipo_iva"=>$value["id_tipo_iva"],
                         "tipo"=>$value["tipo"],
                         "facturacion"=>$value["facturacion"],
                         "tipo_factura"=>$value["tipo_factura"],
                         "cuit"=>$value["cuit"],
                         "direccion"=>strtoupper($value["direccion"]),
                         "localidad"=>strtoupper($value["localidad"]),
                         "telefono"=>$value["telefono"],
                         "email"=>strtoupper($value["email"]),
                         "id_categoria"=>$value["id_categoria"],
                         "id_escribano_relacionado"=>$value["id_escribano_relacionado"],
                         "id_osde"=>$value["id_osde"],
                         "ultimolibrocomprado"=>strtoupper($value["ultimolibrocomprado"]),
                         "ultimolibrodevuelto"=>strtoupper($value["ultimolibrodevuelto"]));
            $cant ++;

          #registramos los productos
          $respuesta = ModeloEnlace::mdlIngresarEscribano($tabla, $datos);
          
        }
            
        $porcentaje = ($cant * 100) /$cantidadEscribanos;

    ?>
        