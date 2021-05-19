<?php
$mesEnLetras = date("F");
switch (date("F")) {
  case 'January':
    # code...
    $mesNombre="Enero";
    break;
  case 'February':
    # code...
    $mesNombre="Febrero";
    break;
  case 'March':
    # code...
    $mesNombre="Marzo";
    break;
  case 'April':
    # code...
    $mesNombre="Abril";
    break;
  case 'May':
    # code...
    $mesNombre="Mayo";
    break;
  case 'June':
    # code...
    $mesNombre="Junio";
    break;
  case 'July':
    # code...
    $mesNombre="Julio";
    break;
  case 'August':
    # code...
    $mesNombre="Agosto";
    break;
  case 'September':
    # code...
    $mesNombre="Septiembre";
    break;
  case 'October':
    # code... 
    $mesNombre="Octubre";
    break;
  case 'November':
    # code...
    $mesNombre="Noviembre";
    break;
  case 'December':
    # code...
    $mesNombre="Diciembre";
    break;  
}

$item = "fecha";
$valor = date("m");

$contarOsdeMes = ControladorVentas::ctrContarOsde($item, $valor);
// echo '<br>Facturas = '.count($contarOsdeMes);

 $item = "fecha";
 $valor = date("m");

$contarCuotasMes = ControladorVentas::ctrContarCuotas($item, $valor);

$item = null;
$valor= null;
$escribanos = ControladorEscribanos::ctrMostrarEscribanos($item, $valor);

$item = "fecha";
$valor= date('Y-m-d');
$ventas = ControladorVentas::ctrMostrarVentasFecha($item, $valor);

?>

 <?php
          
          /*=============================================
          =            GENERO LAS CUOTAS         =
          =============================================*/

          $item = null;
          $valor = null;

          // $GenerarCuota = ControladorVentas::ctrGeneraCuota($item, $valor);

          // $GenerarOsde = ControladorVentas::ctrGeneraOsde($item, $valor);

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
  $ventasActualizacion = ControladorEnlace::ctrMostrarUltimaActualizacion();
        ?>

<div class="row">

  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-aqua">
      
      <div class="inner">
        
        <h3>Osde : <?php echo count($contarOsdeMes); ?></h3>

        <p>Osde generadas <?php echo $mesNombre;?></p>
      
      </div>
      
      <div class="icon">
        
        <i class="fa fa-heartbeat"></i>
      
      </div>
      
      <a href="afacturar" class="small-box-footer">
        
        Más info <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

  </div>

  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-red">
      
      <div class="inner">
        
        <h3>Ventas : <?php echo count($ventas); ?></h3>

        <p>Ventas del dia</p>
      
      </div>
      
      <div class="icon">
        
        <i class="ion ion-stats-bars"></i>
      
      </div>
      
      <a href="crear-venta" class="small-box-footer">
        
        Crear Ventas <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

  </div>

</div>

<div class="row">

  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-green">
      
      <div class="inner">
      
        <h3>Cuotas : <?php echo count($contarCuotasMes); ?></h3>

        <p>Cuotas generadas <?php echo $mesNombre;?></p>
      
      </div>
      
      <div class="icon">
      
        <i class="ion ion-clipboard"></i>
      
      </div>
      
      <a href="afacturar" class="small-box-footer">
        
        Más info <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

  </div>

  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-orange">
      
      <div class="inner">
        
        <h3>Update</h3>

        <p><?php echo $ventasActualizacion['fechacreacion'];?></p>
      
      </div>
      
      <div class="icon">
        
        <i class="ion ion-ios-cloud"></i>
      
      </div>
      
      <a href="update" class="small-box-footer">
        
        Actualizar <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>


  </div>



</div>

<div class="row">

  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-blue">
      
      <div class="inner">
      
        <h3><?php echo count($escribanos); ?></h3>

        <p>Escribanos Actuales </p>
      
      </div>
      
      <div class="icon">
      
        <i class="fa fa-user-circle-o"></i>
      
      </div>
      
      <div class="small-box-footer">
        
        Escribanos 
      
      </div>

    </div>

  </div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-purple">
      
      <div class="inner">
      
        <h3>Videos</h3>

        <p>videos explicativos</p>
      
      </div>
      
      <div class="icon">
      
        <i class="fa fa-file-video-o"></i>
      
      </div>
      
      <a href="videos" class="small-box-footer">
        
        Más info <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

</div>



</div>



