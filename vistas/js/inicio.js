$(document).ready(function() {
  // INICIO LOS COMPROBANTES
  var pathname = window.location.pathname;
  
  
  if(pathname =="/colorado/iniciosinconexion"){

    if(navigator.onLine) {
    // el navegador está conectado a la red
      window.location = "inicio";
    } else {
        // el navegador NO está conectado a la red
      $('#modalMostar #titulo').html("ERROR DE CONEXION");
      $('#modalMostar #mostrarBody').html("<center><img src='vistas/img/plantilla/desconectado.jpg'><h3>SIN CONEXION</h3><h4>Funciones reducidas</h4></center>");
      $("#modalMostar #cabezaLoader").css("background", "#ffbb33");
      $("#mostrarSalir").removeClass("btn-danger");
      $("#mostrarSalir").addClass("btn-warning");
      $('#modalMostar').modal('show');
    }

    

  }

})
/*=============================================
CARGAR LA TABLA 
=============================================*/

$("#downInhabilitados").click(function() {

  var datos = new FormData();
  datos.append("downInhabilitados", "1");

  $.ajax({

      url:"ajax/updateInhabilitados.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,

      beforeSend: function(){
        $("#cabezaLoader").css("background", "#ffbb33");
        $('#actualizacionparrafo').html("<strong>ACTUALIZANDO LOS INHABILITADOS</strong>");
        $('#modalLoader').modal('show');
      },
      
      success:function(respuesta){
       $('#modalLoader').modal('hide');
       $('#inhabilitadosResultados').html('<button class="btn btn-link" id="btnMostrarInhabilitados">'+respuesta+'</button>');
       
      }

    })

})

$("#btnMostrarInhabilitados").click(function() {

  var datos = new FormData();
  datos.append("mostrarInhabilitados", "1");

  $.ajax({

      url:"ajax/updateInhabilitados.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $('#modalMostar #titulo').html("ESCRIBANOS INHABILITADOS");
        $('#modalMostar #mostrarBody').html(respuesta);
        $("#modalMostar #cabezaLoader").css("background", "#ffbb33");
        $("#mostrarSalir").removeClass("btn-danger");
        $("#mostrarSalir").addClass("btn-warning");
        $('#modalMostar').modal('show');
       
      }

    })

})

$("#downProductos").click(function() {

  var datos = new FormData();
  datos.append("downProductos", "1");

  $.ajax({

      url:"ajax/updateProductos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,

      beforeSend: function(){
        $("#cabezaLoader").css("background", "#ff4444");
        $('#actualizacionparrafo').html("<strong>ACTUALIZANDO LOS PRODUCTOS</strong>");
        $('#modalLoader').modal('show');
      },
      
      success:function(respuesta){
        console.log("respuesta", respuesta);
       $('#modalLoader').modal('hide');
       $('#productosResultados').html('<button class="btn btn-link" id="btnMostrarProductos">'+respuesta+'</button>');
      }

    })

})

$("#btnMostrarProductos").click(function() {

  var datos = new FormData();
  datos.append("mostrarProductos", "1");

  $.ajax({

      url:"ajax/updateProductos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $('#modalMostar #titulo').html("PRODUCTOS");
        $('#modalMostar #mostrarBody').html(respuesta);
        $("#modalMostar #cabezaLoader").css("background", "#ff4444");
        $("#mostrarSalir").removeClass("btn-danger");
        $("#mostrarSalir").addClass("btn-danger");
        $('#modalMostar').modal('show');
       
      }

    })

})

$("#downEscribanos").click(function() {

  var datos = new FormData();
  datos.append("downEscribanos", "1");

  $.ajax({

      url:"ajax/updateEscribanos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,

      beforeSend: function(){
        $("#cabezaLoader").css("background", "#00C851");
        $('#actualizacionparrafo').html("<strong>ACTUALIZANDO LOS ESCRIBANOS</strong>");
        $('#modalLoader').modal('show');
      },
      
      success:function(respuesta){
       $('#modalLoader').modal('hide');
       $('#escribanosResultados').html('<button class="btn btn-link" id="btnMostrarEscribanos">'+respuesta+'</button>');
      }

    })

})

$("#btnMostrarEscribanos").click(function() {

  var datos = new FormData();
  datos.append("mostrarEscribanos", "1");

  $.ajax({

      url:"ajax/updateEscribanos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $('#modalMostar #titulo').html("ESCRIBANOS");
        $('#modalMostar #mostrarBody').html(respuesta);
        $("#modalMostar #cabezaLoader").css("background", "#00C851");
        $("#mostrarSalir").removeClass("btn-danger");
        $("#mostrarSalir").addClass("btn-success");
        $('#modalMostar').modal('show');
       
      }

    })

})

