<?php

require_once "../controladores/escribanos.controlador.php";
require_once "../modelos/escribanos.modelo.php";
require_once "../controladores/enlace.controlador.php";
require_once "../modelos/enlace.modelo.php";
require_once "../controladores/modificaciones.controlador.php";
require_once "../modelos/modificaciones.modelo.php";
class AjaxUpdateEscribanos{

	/*=============================================
	ACTUALIZAR PRODUCTOS
	=============================================*/	
	public function ajaxDescargarEscribanos(){

      #DESCARGAR ESCRIBANOS DEL ENLACE
      $item = null;
      $valor = null;
      
      $escribanos = ControladorEnlace::ctrMostrarEscribanosEnlace($item,$valor);
      
      #ELIMINAR LOS ESCRIBANOS DE LOCALHOST
      ControladorEnlace::ctrEliminarEnlace('escribanos');

      foreach ($escribanos as $key => $value) {

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
                     "ultimolibrodevuelto"=>strtoupper($value["ultimolibrodevuelto"]),
                     "inhabilitado"=>$value["inhabilitado"]);
          #registramos los productos
          $respuesta = ModeloEnlace::mdlIngresarEscribano($tabla, $datos);
	    }
      echo count($escribanos);
      $datos = array("nombre"=>"escribanos","fecha"=>date("Y-m-d"));
      $respuesta=ControladorModificaciones::ctrMostrarModificaciones($datos);
      
      
      if (empty($respuesta)){

        ControladorModificaciones::ctrIngresarModificaciones($datos);  
      }
      
   }


  /*=============================================
  MOSTRAR ESCRIBANOS
  =============================================*/ 
  public function ajaxMostrarEscribanos(){

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
               <th>Telefono</th>
               <th>Estado</th>

             </tr> 

            </thead>

            <tbody>';

       

           $item = null;
          $valor = null;

          $escribanos = ControladorEscribanos::ctrMostrarEscribanos($item, $valor);

          foreach ($escribanos as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                    if($value["inhabilitado"]==0){

                      echo '<td class="text-uppercase">HABILITADO</td>';

                    }else{

                      echo '<td class="text-uppercase">INHABILITADO</td>';
                    }
                    

                  echo '</tr>';
          }

        
        echo'
        </tbody>

       </table>';

     }

}

/*=============================================
ESCRIBANOS
=============================================*/	
if(isset($_POST["downEscribanos"])){

	$escribanos = new AjaxUpdateEscribanos();
	$escribanos -> ajaxDescargarEscribanos();
}

if(isset($_POST["mostrarEscribanos"])){

  $escribanos = new AjaxUpdateEscribanos();
  $escribanos -> ajaxMostrarEscribanos();
}
