<?php

require_once "../controladores/escribanos.controlador.php";
require_once "../modelos/escribanos.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";
require_once "../controladores/enlace.controlador.php";
require_once "../modelos/enlace.modelo.php";


class AjaxUpdateInhabilitados{

	/*=============================================
	ACTUALIZAR INHABILITADOS
	=============================================*/	
	public function ajaxDescargarInhabilitados(){

          $item = null;
          $valor = null;
          #SE REVISA LOS INHABILITADOS
          $inhabilitado = ControladorEnlace::ctrMostrarInhabilitado($item, $valor);
          $cantInhabilitados = 0;
          
          #HABILITO A TODOS LOS DEUDORES EN LA TABLA ESCRIBANOS
          ControladorEscribanos::ctrEscribanosHabilitar();

          foreach ($inhabilitado as $key => $value) {

            /*===========================================
            =            CARGAR INHABILITADOS           =
            ===========================================*/
            $datos = $value['id_cliente'];
            $respuesta = ControladorEscribanos::ctrEscribanosInhabilitar($datos);
            $cantInhabilitados ++;

          }

          #SE REVISA A LOS DEUDORES
          $item = null;
          $valor = null;

          $escribanos = ControladorEscribanos::ctrMostrarEscribanos($item, $valor);
          $cantInhabilitados = 0;
          foreach ($escribanos as $key => $value) {
            
            if($value['inhabilitado']==1){

              $cantInhabilitados ++;

            }

          }

          echo $cantInhabilitados;
          
          
	}

  /*=============================================
  MOSTRAR INHABILITADOS
  =============================================*/ 
  public function ajaxMostrarInhabilitados(){

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

             </tr> 

            </thead>

            <tbody>';

       
          $item = null;
          $valor = null;
          $escribanos = ControladorEscribanos::ctrMostrarEscribanos($item,$valor);

          foreach ($escribanos as $key => $value) {
           
           if($value['inhabilitado'] == 1){

            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre"].'</td>
                  
                  </tr>';

           }
            
          }

        
        echo'
        </tbody>

       </table>';

     }
}

/*=============================================
ACTUALIZAR INHABILITADOS
=============================================*/	
if(isset($_POST["downInhabilitados"])){

	$inhabilitados = new AjaxUpdateInhabilitados();
	$inhabilitados -> ajaxDescargarInhabilitados();
  
}
/*=============================================
MOSTRAR INHABILITADOS
=============================================*/ 
if(isset($_POST["mostrarInhabilitados"])){

  $inhabilitados = new AjaxUpdateInhabilitados();
  $inhabilitados -> ajaxMostrarInhabilitados();
  
}
