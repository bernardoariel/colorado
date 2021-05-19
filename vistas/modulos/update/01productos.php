 <?php 
        #ELIMINAR PRODUCTOS DEL ENLACE
       ControladorEnlace::ctrEliminarEnlace('productos');
        #TRAER PRODUCTOS DEL COLEGIO
        $item = null;
        $valor = null;
        $orden = "id";

        $productos = ControladorEnlace::ctrMostrarProductosEnlace($item, $valor, $orden);
        $cantidadProductos = count($productos);
        

        $cant=0;
        foreach ($productos as $key => $value) {
          # code...
         
          if($value['ver']==1){
            
            $tabla ="productos";

            $datos = array("id" => $value["id"],
              "nombre" => strtoupper($value["nombre"]),
              "descripcion" => strtoupper($value["descripcion"]),
              "codigo" => $value["codigo"],
              "nrocomprobante" => $value["nrocomprobante"],
              "cantventa" => $value["cantventa"],
              "id_rubro" => $value["id_rubro"],
              "cantminima" => $value["cantminima"],
              "cuotas" => $value["cuotas"],
              "importe" => $value["importe"],
              "obs" => $value["obs"]);

            $cant ++;

          }
          #registramos los productos
          $respuesta = ModeloEnlace::mdlIngresarProducto($tabla, $datos);
          
        }
        $porcentaje = ($cant * 100) /$cantidadProductos;

    ?>