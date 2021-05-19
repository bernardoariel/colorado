<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      LISTADO DE CUOTAS....*Pueden que no esten actualizados.

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cuotas a facturar</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box cajaPrincipal">

      <div class="box-header with-border">
        
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Fecha</th>
           <th>Tipo</th>
           <th>Nombre</th>
           <th>Total</th> 
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

         
          $item = null;
          $valor = null;

          $respuesta = ControladorEnlace::ctrMostrarCuotas($item, $valor);

          foreach ($respuesta as $key => $value) {

            $item = "id";
            $valor = $value["id_cliente"];

            $escribanos = ControladorEscribanos::ctrMostrarEscribanos($item, $valor);

            if($escribanos['cuit']!=0){
           
              echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>'.$value["fecha"].'</td>

                      <td>'.$value["tipo"].'</td>

                      <td>'.$value["nombre"].'</td>

                      <td>$ '.number_format($value["total"],2).'</td>';

                echo '<td>

                    <div class="btn-group">';

                      echo '<button class="btn btn-info btnVerCuota" idCuota="'.$value["id"].'" title="ver la factura" data-toggle="modal" data-target="#modalVerArticulos" title="Ver articulos de esta Factura"><i class="fa fa-eye"></i></button>';
                  

                 echo '</div>  

                  </td>

                </tr>';
              }
            }

        ?>
               
        </tbody>

       </table>
       

      </div>

    </div>

  </section>

</div>


<!--=====================================
      VER ARTICULOS
======================================-->

<div id="modalVerArticulos" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post">
      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Articulos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="verEscribano" id="verEscribano" placeholder="Ingresar Pago" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL IMPORTE FACTURA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="verTotalFc" id="verTotalFc" placeholder="Ingresar Pago" readonly>

              </div>

            </div>

            
            <!-- ENTRADA PARA EL IMPORTE FACTURA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <table class="table table-bordered tablaProductosVendidos">

                  <thead style="background:#3c8dbc; color:white">

                      <tr>

                        <th style="width: 10px;">Cant.</th>

                        <th style="width: 500px;">Articulo</th>

                        <th style="width: 150px;">Folio 1</th>

                        <th style="width: 150px;">Folio 2</th>

                        <th style="width: 200px;">Total</th>

                      </tr>

                  </thead>    

                  <tbody class="tablaArticulosVer"></tbody>

              </table>

              </div>

            </div>
            



          </div>

        </div>
      
       <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          
          <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Salir</button>

        </div>

      </form>

       <?php

        $realizarPago = new ControladorVentas();
        $realizarPago -> ctrRealizarPago("ctacorriente");

      ?>


    </div>

  </div>
</div>

