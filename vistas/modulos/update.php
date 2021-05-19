<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Update
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Update</li>
    
    </ol>

  </section>

  <section class="content">
    
      <?php

        require_once "update/01productos.php";

      ?>
    
      <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        <div class="info-box bg-yellow">

          <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
     
          <div class="info-box-content">

            <span class="info-box-text">Productos</span>
            <span class="info-box-number"><?php echo $cantidadProductos ;?></span>

            <div class="progress">

              <div class="progress-bar" style="width: <?php echo  $porcentaje; ?>%"></div>

            </div>

            <span class="progress-description">
                 Se actualizaron <?php echo  round($porcentaje,0); ?>% de productos (<?php echo $cant;?>)
            </span>

         </div>
        <!-- /.info-box-content -->
        </div>

      <?php

      require_once "update/02escribanos.php";

      ?>
      <div class="info-box bg-green">

        <span class="info-box-icon"><i class="fa fa-users"></i></span>

        <div class="info-box-content">

          <span class="info-box-text">Escribanos</span>
          <span class="info-box-number"><?php echo $cantidadEscribanos;?></span>

          <div class="progress">

            <div class="progress-bar" style="width: <?php echo  $porcentaje; ?>%"></div>

          </div>

          <span class="progress-description">
                Se actualizaron <?php echo  round($porcentaje,0); ?>% de Escribanos (<?php echo $cant;?>)
          </span>

        </div>
              <!-- /.info-box-content -->
      </div>
      
      <?php

      require_once "update/03cuotas.php";

      ?>
       

      <div class="info-box bg-red">
        
        <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

        <div class="info-box-content">

          <span class="info-box-text">DEUDORES</span>
          <span class="info-box-number"><?php echo $cantidadVentas;?></span>

            <div class="progress">
              <div class="progress-bar" style="width: <?php echo  $porcentaje; ?>%"></div>
            </div>

            <span class="progress-description">
              
              Se actualizaron <?php echo  round($porcentaje,0); ?>% de Ventas (<?php echo $cant+1;?>)
            
            </span>
              
        </div>
              <!-- /.info-box-content -->
              
      </div>
      
       <?php

      require_once "update/04ventasweb.php";

       ?>
      <div class="info-box bg-dark">

        <span class="info-box-icon"><i class="fa fa-cloud-upload"></i></span>

        <div class="info-box-content">

          <span class="info-box-text">Ventas</span>
          <span class="info-box-number"><?php echo $cantidadEscribanos;?></span>

          <div class="progress">

            <div class="progress-bar" style="width: <?php echo  $porcentaje; ?>%"></div>

          </div>

          <span class="progress-description">
                Se actualizaron <?php echo  round($porcentaje,0); ?>% de Ventas (<?php echo $cant;?>)
          </span>

        </div>
              <!-- /.info-box-content -->
      </div>
      <?php

    $ventas = ControladorEnlace::ctrMostrarUltimaActualizacion();
    echo '<pre>Ultima Actualizacion::: '; print_r($ventas['fechacreacion']); echo '</pre>';

    ?>

   </div>
    

        
    
  </section>
 
</div>



