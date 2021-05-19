<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/enlace.controlador.php";
require_once "../modelos/enlace.modelo.php";
require_once "../controladores/modificaciones.controlador.php";
require_once "../modelos/modificaciones.modelo.php";
class AjaxUpdateProductos{

	/*=============================================
	ACTUALIZAR PRODUCTOS
	=============================================*/	
	public function ajaxDescargarProductos(){

      #DESCARGO LOS PRODUCTOS DEL ENLACE
      $item = null;
      $valor = null;
      $orden = "id";
      $productos = ControladorEnlace::ctrMostrarProductosEnlace($item, $valor, $orden);
      
     
      // echo count($productos);

      // #ELIMINAR PRODUCTOS DE LOCALHOST
       ControladorEnlace::ctrEliminarEnlace('productos');
      // #INGRESAR LOS PRODUCTOS DEL ENLACE AL LOCALHOST
      $cant=0;
      foreach ($productos as $key => $value) {
        # code...
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

        #registramos los productos
        $respuesta = ModeloEnlace::mdlIngresarProducto($tabla, $datos);
        $cant++;

      }
      
      $datos = array("nombre"=>"productos","fecha"=>date("Y-m-d"));
      $respuesta=ControladorModificaciones::ctrMostrarModificaciones($datos);
      
      
      if (empty($respuesta)){

        ControladorModificaciones::ctrIngresarModificaciones($datos);  
      }
      
      echo $cant;
       
  }
      
  /*=============================================
  MOSTRAR PRODUCTOS
  =============================================*/ 
  public function ajaxMostrarProductos(){
    echo '<script>$(".tablaMostrarAjax").DataTable({
      "lengthMenu": [[5, 10, 25], [5, 10, 25]],
      dom: "lBfrtip",buttons: [
        {
          extend: "colvis",
          columns: ":not(:first-child)",
        }
        ],
    "language": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }
})</script>';
    echo '<table class="table table-bordered table-striped dt-responsive tablaMostrarAjax" width="100%">
            <thead>
         
             <tr>
               
               <th style="width:10px">#</th>
               <th>Nombre</th>
               <th>Importe</th>

             </tr> 

            </thead>

            <tbody>';

       

           $item = null;
          $valor = null;
          $orden = "id";

          $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

          foreach ($productos as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["importe"].'</td>
                  
                  </tr>';
          }

        
        echo'
        </tbody>

       </table>';

     
    }
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["downProductos"])){

	$productos = new AjaxUpdateProductos();
	$productos -> ajaxDescargarProductos();
}


/*=============================================
EDITAR CATEGORÍA
=============================================*/ 
if(isset($_POST["mostrarProductos"])){

  $productos = new AjaxUpdateProductos();
  $productos -> ajaxMostrarProductos();
}