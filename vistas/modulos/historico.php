 <?php
  
  // FECHA DEL DIA DE HOY
  $fecha=date('Y-m-d');
  
  ?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box cajaPrincipal">

      

      <div class="box-body">

        <?php

        $item = null;
        $valor = null;
        $escribanos = ControladorEscribanos::ctrMostrarEscribanos($item, $valor);

        ?>

        <select name="selectescribanos" id="selectescribanos" class="form-control">
          
          <?php
          
              $bnd=0;

              foreach ($escribanos as $key => $value) {

                if(isset($_GET["idEscribano"])){

                  if ($_GET["idEscribano"]==$value['id']){

                    echo '<option value="'.$value['id'].'" selected>'.$value['nombre'].'</option>';

                  }else{

                    echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';

                  }
                  

                }else{

                  if ($bnd==0){
                    
                    echo '<option value="0" selected>SIN ESCRIBANO</option>';
                    $bnd=1;

                  }

                  echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';

                }

              }
          ?>
        </select>
        <br>
       <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th style="width:45px">Fecha</th>
           <th style="width:35px">Tipo</th>
           <th>Nro. Factura</th>
           <th>Escribano</th>
          <!--  <th>Vendedor</th> -->
           <th>Forma de pago</th>
           <th>Detalle de pago</th>
           <th style="width:50px">Total</th> 
           <th style="width:50px">Adeuda</th>
           
           <th style="width:140px">Acciones</th>

         </tr> 

        </thead>

        <tbody id="tablaHistorica">

         <?php
         
          if(isset($_GET["idEscribano"])){

            $item = "id_cliente";
            $valor = $_GET["idEscribano"];

          

          $respuesta = ControladorVentas::ctrMostrarVentasClientes($item, $valor);

          foreach ($respuesta as $key => $value) {
                # code...

                echo '<tr>'.

                        '<td>1</td>'.

                        '<td>'.$respuesta[$key]['fecha'].'</td>'.

                        '<td>'.$respuesta[$key]['tipo'].'</td>'.

                        '<td>'.$respuesta[$key]['codigo'].'</td>'.

                        '<td>ESCRIBANO</td>'.

                        '<td>'.$respuesta[$key]['metodo_pago'].'</td>'.

                        '<td>'.$respuesta[$key]['referenciapago'].'</td>'.

                        '<td>'.$respuesta[$key]['total'].'</td>'.

                        '<td>'.$respuesta[$key]['adeuda'].'</td>'.

                        '<td>'.$respuesta[$key]['adeuda'].'</td>'.

                      '</tr>';
              }
              }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();


      $eliminarPago = new ControladorVentas();
      $eliminarPago -> ctrEliminarPago();

      ?>
       

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

        <div class="modal-footer finFactura">

          <button type="button" class="btn btn-info pull-left" data-dismiss="modal" id="imprimirItems" codigo="<?php echo $value["codigo"];?>">Imprimir Factura</button>
          <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Salir</button>

        </div>

      </form>

       


    </div>

  </div>
</div>


<!--=====================================
      AGREGAR PAGO
======================================-->

<div id="modalAgregarPago" class="modal fade" role="dialog">

  <div class="modal-dialog">
    
    <div class="modal-content">

      <form role="form" method="post">
      
        <div class="modal-header" style="background:#3E4551; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Metodo Pago</h4>

        </div>

        <div class="modal-body">

            <input type="hidden" id="idVentaPago" name="idVentaPago" value="13"> 
            <input type="hidden" id="totalVentaPago" name="totalVentaPago" value="13">
            <label for="pago">PAGO</label>

            <select class="form-control" id='listaMetodoPago' name='listaMetodoPago'>
              
              <option value="EFECTIVO" selected>EFECTIVO</option>
              <option value="TARJETA">TARJETA</option>
              <option value="TRANSFERENCIA">TRANSFERENCIA</option>
              <option value="CHEQUE">CHEQUE</option>
             
            </select>

            <label for="nuevaReferencia">REFERENCIA</label>

            <input type="text" class="form-control" placeholder="REFERENCIA...." id='nuevaReferencia' name='nuevaReferencia' value='EFECTIVO' autocomplete="off">        
       

        </div><!-- Modal body-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-danger">Realizar Pago</button>
   
        </div>

        <?php

          $realizarPago = new ControladorVentas();
          $realizarPago -> ctrRealizarPagoVenta();

        ?>


      </form>
        
    </div><!-- Modal content-->
      
  </div><!-- Modal dialog-->
            
</div><!-- Modal face-->
