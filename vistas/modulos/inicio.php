<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">

    <!-- <div class="box box-primary"> -->

    
      
      <div class="box-body">

        <?php 

          /*============================================================================
          =            SIEMPRE REALIZO LA COMPROBACION DE LOS INHABILITADOS            =
          ============================================================================*/
          $item = null;
          $valor = null;
          #SE REVISA LOS INHABILITADOS
          $inhabilitado = ControladorEnlace::ctrMostrarInhabilitado($item, $valor);
          $cantInhabilitados = 0;
          
          #HABILITO A TODOS LOS DEUDORES EN LA TABLA ESCRIBANOS
          $respuesta=ControladorEscribanos::ctrEscribanosHabilitar();
     
          
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
          
          #TRAER PRODUCTOS DEL COLEGIO
          $item = null;
          $valor = null;
          $orden ="id";
          $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);    
          
          /*===========================================
           = REVISO SI TIENE MODIFICACIONES           =
          ===========================================*/
          #EN EL SERVIDOR
          $item ="nombre";
          $valor = "productos";
          $respuestaServidor=ControladorEnlace::ctrMostrarModificacionesEnlace($item,$valor);

          
          if (!empty($respuestaServidor)) {

            // echo '<br>Hay que actualizar Productos';

            //   #DESCARGO LOS PRODUCTOS DEL ENLACE
            $item = null;
            $valor = null;
            $orden = "id";
            $productos = ControladorEnlace::ctrMostrarProductosEnlace($item, $valor, $orden);
            // #ELIMINAR PRODUCTOS DE LOCALHOST
            ControladorEnlace::ctrEliminarEnlace('productos');

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
             
            }

            $datos = $respuestaServidor['id'];
            ControladorEnlace::ctrSubirModificaciones($datos);
    
          }else{

            // echo '<br>No hay que acualizar Productos';

          }

          #EN EL SERVIDOR  
          $item ="nombre";
          $valor = "escribanos";
          $respuestaServidor=ControladorEnlace::ctrMostrarModificacionesEnlace($item,$valor);
          

          if (!empty($respuestaServidor)) {

            // echo '<br>Hay que actualizar Escribanos';

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

            
            $datos = $respuestaServidor['id'];
            ControladorEnlace::ctrSubirModificaciones($datos);
    
          }else{

            // echo '<br>No hay que acualizar Escribanos';

          }

          /*=================================================
          =            CHEQUEAR QUE HAYAN VENTAS            =
          =================================================*/
     
          $ventasEnlace =ControladorEnlace::ctrMostrarUltimaAVenta();//toma la ultima del servidor
          
          if (empty($ventasEnlace)){//si esta vacio cargo todas las ventas   

            $item = null;
            $valor = null;
            $orden = "id";

            $ventas = ControladorVentas::ctrMostrarVentasFc($item, $valor, $orden);

            foreach ($ventas as $key => $value) {
             # code...
             $tabla = "colorado";

             $datos = array("id"=>$value["id"],
                            "fecha"=>$value["fecha"],
                            "codigo"=>$value["codigo"],
                            "tipo"=>$value["tipo"],
                            "id_cliente"=>$value["id_cliente"],
                            "nombre"=>$value["nombre"],
                            "documento"=>$value["documento"],
                            "tabla"=>$value["tabla"],
                            "id_vendedor"=>$value["id_vendedor"],
                            "productos"=>$value["productos"],
                            "impuesto"=>$value["impuesto"],
                            "neto"=>$value["neto"],
                            "total"=>$value["total"],
                            "adeuda"=>$value["adeuda"],       
                            "metodo_pago"=>$value["metodo_pago"],       
                            "fechapago"=>$value["fechapago"],       
                            "cae"=>$value["cae"],       
                            "fecha_cae"=>$value["fecha_cae"],
                            "referenciapago"=>$value["referenciapago"],
                            "observaciones"=>$value["observaciones"]);

              #registramos los productos
              $respuesta = ModeloEnlace::mdlIngresarVentaEnlace($tabla, $datos);
              
            }

          }else{

            $ultimoIdServidor = $ventasEnlace['id'];

            $ventasLocal = ControladorVentas::ctrMostrarUltimaAVenta();
            $ultimoIdLocal = $ventasLocal['id'];

            if ($ultimoIdServidor < $ultimoIdLocal){
              #CONSULTA DE VENTAS MAYORES AL ULTIMO ID DEL SERVIDOR
              $item = "id";
              $valor = $ultimoIdServidor;
              
              $ventasUltimasVentas = ControladorVentas::ctrMostrarUltimasVentas($item, $valor);
              foreach ($ventasUltimasVentas as $key => $value) {
                # code...
                $tabla = "colorado";

                $datos = array("id"=>$value["id"],
                            "fecha"=>$value["fecha"],
                            "codigo"=>$value["codigo"],
                            "tipo"=>$value["tipo"],
                            "id_cliente"=>$value["id_cliente"],
                            "nombre"=>$value["nombre"],
                            "documento"=>$value["documento"],
                            "tabla"=>$value["tabla"],
                            "id_vendedor"=>$value["id_vendedor"],
                            "productos"=>$value["productos"],
                            "impuesto"=>$value["impuesto"],
                            "neto"=>$value["neto"],
                            "total"=>$value["total"],
                            "adeuda"=>$value["adeuda"],       
                            "metodo_pago"=>$value["metodo_pago"],       
                            "fechapago"=>$value["fechapago"],       
                            "cae"=>$value["cae"],       
                            "fecha_cae"=>$value["fecha_cae"],
                            "referenciapago"=>$value["referenciapago"],
                            "observaciones"=>$value["observaciones"]);

              #registramos los productos
                $respuesta = ModeloEnlace::mdlIngresarVentaEnlace($tabla, $datos);
              }

            } 
          } 

          /*=============================================
          =              GENERO LA CAJA                =
          =============================================*/
          $item = "fecha";
          $valor = date('Y-m-d');

          $caja = ControladorCaja::ctrMostrarCaja($item, $valor);
          
          if(count($caja)==0){
            
            $datos = array("fecha"=>date('Y-m-d'),
               "efectivo"=>0,
               "tarjeta"=>0,
               "cheque"=>0,
               "transferencia"=>0);
            
            $insertarCaja = ControladorCaja::ctrIngresarCaja($item, $datos);

          }
        
        ?>

         <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">ESCRIBANOS</h3>
              <h5 class="widget-user-desc">Actualizacion en Nube</h5>
            </div>
            <a href="escribanos">

              <div class="widget-user-image">
                <img class="img-circle" src="vistas/img/usuarios/admin/escribanos.jpg" alt="User Avatar">
              </div>
            </a>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header" style="color:red;" id="inhabilitadosResultados"><button class="btn btn-link" id="btnMostrarInhabilitados"><?php echo $cantInhabilitados;?></button></h5>
                    <span class="description-text" style="color:red;">INHABILITADOS</span>
                    <h3 class="description-header"><button class="btn btn-warning"id="downInhabilitados"><i class="fa fa-cloud-download" aria-hidden="true"></i></button></h3>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header" id="escribanosResultados"><button class="btn btn-link" id="btnMostrarEscribanos"><?php echo count($escribanos);?></button></h5>
                    <span class="description-text">TODOS</span>
                    <h3 class="description-header"><button class="btn btn-success"id="downEscribanos"><i class="fa fa-cloud-download" aria-hidden="true"></i></button></h3>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header" id="productosResultados"><button class="btn btn-link" id="btnMostrarProductos"><?php echo count($productos);?></button></h5>
                    <span class="description-text">PRODUCTOS</span>
                    <h3 class="description-header"><button class="btn btn-danger"id="downProductos"><i class="fa fa-cloud-download" aria-hidden="true"></i></button></h3>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <?php

          /*==========================================
          =            CANTIDAD DE VENTAS            =
          ==========================================*/
          
        $item = "fecha";
        $valor= date('Y-m-d');
        
        $ventas = ControladorVentas::ctrMostrarVentasFecha($item, $valor);

        
          
          // /*=====  End of CANTIDAD DE VENTAS  ======*/
          
        ?>
        <div class="col-md-3">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <h3 class="widget-user-username">VENTAS</h3>
              <h5 class="widget-user-desc">Formosa</h5>
            </div>

            <a href="crear-venta">

              <div class="widget-user-image">
              
                <img class="img-circle" src="vistas/img/usuarios/admin/colegio.jpg" alt="User Avatar">
              
              </div>

            </a>
            <div class="box-footer">
              <div class="row">
               
                <!-- /.col -->
                <div class="col-sm-12 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo count($ventas); ?></h5>
                    <h6> - </h6>
                    <span class="description-text">COLORADO</span>
                    <h3 class="description-header"><a href="ventas"><button class="btn btn-success"><i class="fa fa-file-text-o" aria-hidden="true"></i></button></a></h3>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
    

<div id="modalLoader" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  
  <div class="modal-dialog">

    <div class="modal-content">


      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" id="cabezaLoader" style="background:#3c8dbc;color:white">

        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->

        <h4 class="modal-title">Aguarde un instante</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <center>
            <img src="vistas/img/afip/loader.gif" alt="">
          </center>
         
         

        </div>  

      </div>

      <div class="modal-footer">

        <p id="actualizacionparrafo"></p>

      </div>
        

    </div>

  </div>

</div>

<div id="modalMostar" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  
  <div class="modal-dialog">

    <div class="modal-content">


      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" id="cabezaLoader" style="background:#3c8dbc;color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title" id="titulo"></h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body" id="mostrarBody">
         

        </div>  

      </div>

      <div class="modal-footer">

        <button type="button" id="mostrarSalir" class="btn btn-danger" data-dismiss="modal">Salir</button>

      </div>
        

    </div>

  </div>

</div>



     </div>

  </section>
 
</div>


