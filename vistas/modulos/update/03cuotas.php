<?php 
        #ELIMINAR PRODUCTOS DEL ENLACE
       ControladorEnlace::ctrEliminarEnlace2('ventas');
        #TRAER PRODUCTOS DEL COLEGIO
        $item = null;
        $valor = null;
        $orden = "id";

        $ventas = ControladorEnlace::ctrMostrarVentasColegio($item, $valor, $orden);
       
        $cantidadVentas = count($ventas);

        $cant=0;
        foreach ($ventas as $key => $value) {
         # code...
         $tabla = "ventas";

         $datos = array("id"=>$value["id"],
         
                   "id_vendedor"=>$value["id_vendedor"],
                   "fecha"=>$value["fecha"],
                   "tipo"=>$value["tipo"],
                   "id_cliente"=>$value["id_cliente"],
                   "nombre"=>$value["nombre"],
                   "documento"=>$value["documento"],
                   "tabla"=>"escribanos",
                   "codigo"=>$value["codigo"],
                   "productos"=>$value["productos"],
                   "impuesto"=>$value["impuesto"],
                   "neto"=>$value["neto"],
                   "total"=>$value["total"],
                   "adeuda"=>$value["adeuda"],
                   "metodo_pago"=>$value["metodo_pago"],
                   "referenciapago"=>$value["referenciapago"],
                   "fechapago"=>$value["fechapago"]);

            $cant ++;

         
          #registramos los productos
          $respuesta = ModeloEnlace::mdlIngresarVenta($tabla, $datos);
          
        }

        $porcentaje = ($cant * 100) /$cantidadVentas;

    ?>