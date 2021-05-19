<?php
      
      /*=================================================
      =            CHEQUEAR QUE HAYAN VENTAS            =
      =================================================*/
     
      $ventasEnlace =ControladorEnlace::ctrMostrarUltimaAVenta();//toma la ultima del servidor
      
      // print_r($ventasEnlace);
      if ($ventasEnlace == null){
       
        echo "No hay nada";

        $item = null;
        $valor = null;
        $orden = "id";

        $ventas = ControladorVentas::ctrMostrarVentasFc($item, $valor, $orden);

        $cant=0;

        
          
          foreach ($ventas as $key => $value) {
           # code...
           $tabla = "colorado";

           $datos = array("id"=>$value["id"],
                     "id_vendedor"=>$value["id_vendedor"],
                     "fecha"=>$value["fecha"],
                     "tipo"=>$value["tipo"],
                     "id_cliente"=>$value["id_cliente"],
                     "nombre"=>$value["nombre"],
                     "documento"=>$value["documento"],
                     "codigo"=>$value["codigo"],
                     "productos"=>$value["productos"],
                     "impuesto"=>$value["impuesto"],
                     "neto"=>$value["neto"],
                     "total"=>$value["total"],
                     "adeuda"=>$value["adeuda"],
                     "cae"=>$value["cae"],
                     "fecha_cae"=>$value["fecha_cae"],
                     "metodo_pago"=>$value["metodo_pago"],
                     "referenciapago"=>$value["referenciapago"],
                     "fechapago"=>$value["fechapago"]);

              $cant ++;

            #registramos los productos
            $respuesta = ModeloEnlace::mdlIngresarVentaEnlace($tabla, $datos);
            
          }

      }else{

           $item = "id";
           $valor = $ventasEnlace['id'];
           $orden = "id";

           // echo $valor;
            $ventas = ControladorVentas::ctrMostrarVentasFcUltima($item, $valor, $orden);
            

            $cant=0;

            if(isset($ventas)){

              foreach ($ventas as $key => $value) {
               # code...
                 $tabla = "colorado";

                  $datos = array("id"=>$value["id"],
                     "id_vendedor"=>$value["id_vendedor"],
                     "fecha"=>$value["fecha"],
                     "tipo"=>$value["tipo"],
                     "id_cliente"=>$value["id_cliente"],
                     "nombre"=>$value["nombre"],
                     "documento"=>$value["documento"],
                     "codigo"=>$value["codigo"],
                     "productos"=>$value["productos"],
                     "impuesto"=>$value["impuesto"],
                     "neto"=>$value["neto"],
                     "total"=>$value["total"],
                     "adeuda"=>$value["adeuda"],
                     "cae"=>$value["cae"],
                     "fecha_cae"=>$value["fecha_cae"],
                     "metodo_pago"=>$value["metodo_pago"],
                     "referenciapago"=>$value["referenciapago"],
                     "fechapago"=>$value["fechapago"]);


                  $cant ++;

               
                  #registramos los productos
                  $respuesta = ModeloEnlace::mdlIngresarVentaEnlace($tabla, $datos);
                  
              // print_r($respuesta );

              }

            }
        

      }

    ?>