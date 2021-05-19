/*=============================================
CARGAR LA TABLA 
=============================================*/
var tablaBuscarCliente = $('.tablaBuscarClientes').DataTable({
//  "ajax":"ajax/datatable-vocabulario.ajax.php",
 "lengthMenu": [[5, 10, 25], [5, 10, 25]],
      "language": {
        "emptyTable":     "No hay datos disponibles en la tabla.",
        "info":           "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0 registros de un total de 0.",
        "infoFiltered":     "6",
        "infoPostFix":      "(actualizados)",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords":   "Cargando...",
        "processing":     "Procesando...",
        "search":       "Buscar:",
        "searchPlaceholder":  "Dato para buscar",
        "zeroRecords":      "No se han encontrado coincidencias.",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":     "Anterior"
        },
        "aria": {
          "sortAscending":  "Ordenación ascendente",
          "sortDescending": "Ordenación descendente"
        }
      }


})

$(document).ready(function() {
  // INICIO LOS COMPROBANTES
  var pathname = window.location.pathname;
  console.log("pathname", pathname);
  
  if(pathname =="/colorado/crear-venta"){

    borrarTablaComprobantes();
    borrarTablaItems();
    iniciarComprobantes();
    $("#resultadoBusqueda").html('');

  }
  
    // listarProductos();

    


});

function borrarTablaItems(){

  //borro todos los items
  var datos = new FormData();
  datos.append("items", "items");
  $.ajax({

    url:"ajax/comprobantes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    
    success:function(respuesta4){
      
    }

  })

}
        

function borrarTablaComprobantes(){
 
  var datos = new FormData();
  datos.append("iniciar","iniciar");//BORRA LA TABLA tmp_comprobantes
  
  $.ajax({
      url:"ajax/comprobantes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
         
        iniciarComprobantes();
        
      }
  }) 
}
function iniciarComprobantes(){
   var datos = new FormData();
        datos.append("todos", "todos");//MUESTRA TODOS LOS CAMPOS tmp_comprobantes

        $.ajax({
          
          url:"ajax/comprobantes.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType:"json",
          success:function(respuesta2){
            // console.log("respuesta2", respuesta2);

            for(var i = 0; i < respuesta2.length; i++){      
              
              var datos = new FormData();
              datos.append("idTmp", respuesta2[i]["id"]);
              datos.append("nombreTmp", respuesta2[i]["nombre"]);
              datos.append("numeroTmp", respuesta2[i]["numero"]);
              
              $.ajax({

                url:"ajax/comprobantes.ajax.php",//carga la tabla tmp_comprobantes
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                
                success:function(respuesta3){
                  

            
                }

              })

            }

            
          }

        })
}

/*=============================================
HACER FOCO EN EL BUSCADOR CLIENTES
=============================================*/
$('#myModalClientes').on('shown.bs.modal', function () {
    
    $('#buscarclientetabla_filter label input').focus();
    $('#buscarclientetabla_filter label input').val('');
    tablaBuscarCliente.search('');
    tablaBuscarCliente.draw();
  
  })



var tablaArticulo = $('#buscararticulotabla').DataTable({
      "lengthMenu": [[4, 10, 25], [4, 10, 25]],
      "language": {
        "emptyTable":     "No hay datos disponibles en la tabla.",
        "info":           "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0 registros de un total de 0.",
        "infoFiltered":     "6",
        "infoPostFix":      "(actualizados)",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords":   "Cargando...",
        "processing":     "Procesando...",
        "search":       "Buscar:",
        "searchPlaceholder":  "Dato para buscar",
        "zeroRecords":      "No se han encontrado coincidencias.",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":     "Anterior"
        },
        "aria": {
          "sortAscending":  "Ordenación ascendente",
          "sortDescending": "Ordenación descendente"
        }
      },
      
      
    });
$('#modalClienteDni').on('shown.bs.modal', function () {
     $("#myModalClientes").modal('hide');
     $('#nombreClienteEventual').focus();
   
})

// $("#seleccionarClienteDni").on("click",function(){

//     var idCliente = 0;
//     var nombreClienteEventual = $("#nombreClienteEventual").val();
//     var documentoClienteEventual = $("#documentoClienteEventual").val();
//     var tipoDocumentoEventual = "DNI";
    
//     $("#seleccionarCliente").val(idCliente);
//     $("#nombreCliente").val((nombreClienteEventual).toUpperCase());
//     $("#documentoCliente").val(documentoClienteEventual);
//     $("#tipoDocumento").val(tipoDocumentoEventual);
//     $("#modalClienteDni").modal('hide');
//   })
/*=============================================
SELECCIONAR CLIENTE
=============================================*/
// $(".tablaBuscarClientes").on("click", ".btnBuscarCliente", function(){

//     var idCliente = $(this).attr("idCliente");
//     var nombreCliente = $(this).attr("nombreCliente");
//     var documentoCliente = $(this).attr("documentoCliente");
//     var tipoDocumento = $(this).attr("tipoDocumento");
    
//     $("#seleccionarCliente").val(idCliente);
//     $("#nombreCliente").val(nombreCliente);
//     $("#documentoCliente").val(documentoCliente);
//     $("#tipoDocumento").val(tipoDocumento);
// })
/*=============================================
FACTURA ELECTRONICA
=============================================*/

 $("#guardarVenta").on("click",function(){
    
    $("#guardarVenta").attr('disabled','disabled');
   
    var idUltimaFactura=0;
    var codigoUltimaFactura=0;
    var datos = new FormData();
    datos.append("sinHomologacion",1 );
    datos.append("listaProductos", $('#listaProductos').val());
    datos.append("idVendedor", $('#idVendedor').val());
    datos.append("nombreCliente",$("#nombreCliente").val());
    datos.append("tipoCliente",$("#tipoCliente").val());
    datos.append("documentoCliente",$("#documentoCliente").val());
    datos.append("tipoDocumento",$("#tipoDocumento").val());
    datos.append("seleccionarCliente", $('#seleccionarCliente').val());
    datos.append("listaMetodoPago", $('#listaMetodoPago').val());
    datos.append("nuevaReferencia", $('#nuevaReferencia').val());
    datos.append("totalVenta", $('#totalVenta').val());
    datos.append("nuevoPrecioImpuesto", $('#nuevoPrecioImpuesto').val());
    datos.append("nuevoPrecioNeto", $('#nuevoPrecioNeto').val());
    datos.append("nuevoTotalVentas", $('#nuevoTotalVentas').val());

    $.ajax({
      url:"ajax/crearventa.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
       
      success:function(respuestaSinHomologacion){
        console.log("respuestaSinHomologacion", respuestaSinHomologacion);
          
        ultimaFactura = 'ultimaFactura';
        var datos = new FormData();
        datos.append("ultimaFactura",ultimaFactura);
        $.ajax({

          url:"ajax/crearventa.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType:"json",
            
          success:function(respuestaUltimaFactura){
            
            // setTimeout(() => {
              
            // }, 3000);
            idUltimaFactura=respuestaUltimaFactura["id"];
            codigoUltimaFactura=respuestaUltimaFactura["codigo"];
            
            
           window.location = "index.php?ruta=ventas&id="+idUltimaFactura;
            
          } 

        })
          
      }

    })

   
})
/*=============================================
SI ENVIA EL FORUMLARIO
=============================================*/
$("#frmVenta").on("submit", function(){
  
  
  if($("#nombrecliente").val()==""){

    swal("Le Falta Seleccionar el nombre del Escribano", "Elija un Escribano por favor", "warning");
    

   return false;
    
  }
  if($("#listaProductos").val()==""){

    swal("No se ha seleccionado aun ningun articulo", "Elija uno por favor", "warning");
    

   return false;
    
  }
 
  
 })

/*=============================================
SI ENVIA EL FORUMLARIO
=============================================*/
// $("#pagarFactura").on("click", ".btnSeleccionarProducto", function(){


// })
// $("#frmVentaEditada").on("submit", function(){
  
//   if($("#nombrecliente").val()==""){

//     swal("Le Falta Seleccionar el nombre del Escribano", "Elija un Escribano por favor", "warning");
    

//    return false;
    
//   }

//   window.open('extensiones/fpdf/pdf/factura.php?idventa='+3,'FACTURA',1,2);
  
//  })

/*=============================================
SELECCIONO EL PRODUCTO
=============================================*/
$(".tablaBuscarProductos").on("click", ".btnSeleccionarProducto", function(){

    var idProducto = $(this).attr("idProducto");
    var productoNombre = $(this).attr("productoNombre");
    var precioVenta = $(this).attr("precioVenta");
    var idNroComprobante = $(this).attr("idNroComprobante");
    var cantVentaProducto = $(this).attr("cantventaproducto");
    

    //DATOS AJAX DE QUE SE REALIZO EL CAMBIO
    datos="<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Bien hecho!</strong>Los datos han sido introducidos satisfactoriamente.";
    $("#datos_ajax_producto").html(datos);
    $("#datos_ajax_producto").hide(1000);
    //CIERRO LA TABLA
    $("#contenido_producto").hide(500);
    //MUESTRO LOS RESULATADOS
    $("#contenidoSeleccionado").show();
    //SELECCIONO EL INPUT DE LA CANTIDAD
    $("#cantidadProducto").val('1');
    $("#cantidadProducto").focus();
    $("#cantidadProducto").select();
    //ASIGNO A CADA INPUT EL VALOR OBTENIDO DE LOS PARAMETROS
    $("#idproducto").val(idProducto);
    $("#idNroComprobante").val(idNroComprobante);
    $("#nombreProducto").val(productoNombre);
    $("#precioProducto").val(precioVenta);
    $("#cantVentaProducto").val(cantVentaProducto);
})
/*=============================================
CUANDO ABRO EL MODAL DE PRODUCTOS
=============================================*/
$('#myModalProductos').on('shown.bs.modal', function () {
     
     $("#datos_ajax").show();
     //MUESTRO LOS RESULTADOS
      $("#contenido_producto").show();
      //ESCONDO EL PRODUCTO SELECCIONADO
      $("#contenidoSeleccionado").hide();
      //PONGO A CERO LOS VALUES
      $("#idproducto").val("");
      $("#nombreProducto").val("");
      $("#cantidadProducto").val("1");
      $("#precioProducto").val("");
   
})


 //Date picker
 $('#datepicker').datepicker({
     autoclose: true
 })
/*=============================================
SELECCIONO EL PRODUCTO
=============================================*/
$("#grabarItem").on("click",function(){

    

    idProducto = $("#idproducto").val();

    idNroComprobante = $("#idNroComprobante").val();

    cantVentaProducto = $("#cantVentaProducto").val();
   
    cantidadProducto = $("#cantidadProducto").val();
    
    productoNombre = $("#nombreProducto").val();
  
    precioVenta = $("#precioProducto").val();

    precioVentaTotal = $("#totalVenta").val();

    idVenta = $("#idVenta").val();

    precioVentaTotal=parseFloat(precioVentaTotal).toFixed(2);
    
   

    /*=============================================
    GRABO LO SELECCIONADO EL PRODUCTO
    =============================================*/
    var datos = new FormData();
    datos.append("idproducto",$("#idproducto").val());
    datos.append("idNroComprobante",idNroComprobante);
    datos.append("cantidadProducto",cantidadProducto);
    datos.append("cantVentaProducto",cantVentaProducto);
    datos.append("productoNombre",productoNombre);
    datos.append("precioVenta",precioVenta);
    datos.append("idVenta",idVenta);

    $.ajax({ //tomo el nombre

      url:"ajax/comprobantes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      
      success:function(respuesta){

          $(".tablaProductosSeleccionados").html(respuesta);

          listarProductos();
          
      }

    })



  $("#contenidoSeleccionado").hide();
  $("#contenido_producto").css("display","block");
  $('#buscararticulotabla_filter label input').focus();
  $('#buscararticulotabla_filter label input').val('');

     

})

/*=============================================
QUITAR EL PRODUCTO
=============================================*/


$(".tablaProductosSeleccionados").on("click", ".quitarProducto", function(){

var idItem = $(this).attr("idItem");

$(this).parent().parent().parent().remove();

/*=============================================
  GRABO LO SELECCIONADO EL PRODUCTO
  =============================================*/
  var datos = new FormData();
  datos.append("idItem",idItem);  
  $.ajax({ //tomo el nombre

    url:"ajax/comprobantes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    
    success:function(respuesta){

        $(".tablaProductosSeleccionados").html(respuesta);

          listarProductos();
        
    }

  })
})


/*=============================================
LISTAR TODOS LOS  PRODUCTOS
=============================================*/

function listarProductos(){

  var listaProductos = [];
  
  var descripcion = $(".nuevaDescripcionProducto");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPrecioProducto");

  var precioTotal = $(".nuevoTotalProducto");

  var nuevoFolio1 = $(".nuevoFolio1");

  var nuevoFolio2 = $(".nuevoFolio2");

  var totalVentas = 0;

  var cantidadItem = 1;

  var totalItems = 0;

  var i = 0;
  
  if(descripcion.length>=1){

    for(var i = 0; i < descripcion.length; i++){

      console.log("$(nuevoFolio1[i]).attr(\"folio1\")", $(nuevoFolio1[i]).attr("folio1"));
      listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
                  "descripcion" : $(descripcion[i]).val(),
                  "idnrocomprobante" : $(descripcion[i]).attr("idnrocomprobante"),
                  "cantventaproducto" : $(descripcion[i]).attr("cantventaproducto"),
                  "folio1" : $(nuevoFolio1[i]).val(),
                  "folio2" : $(nuevoFolio2[i]).val(),
                  "cantidad" : $(cantidad[i]).val(),
                  "precio" : $(precio[i]).attr("precioReal"),
                  "total" : $(precioTotal[i]).val()});

      cantidadItem = Number($(cantidad[i]).val());
      total = Number($(precio[i]).val());
      totalItems= total*cantidadItem;
      totalVentas += totalItems;

    } 

    if($("#nombreCliente").val()==0){
      

      $("#guardarVenta").attr('disabled',true);

    }else{

      $("#guardarVenta").attr('disabled',false);
    }

  }else{

    $("#guardarVenta").attr('disabled',true);

  }

 $("#totalVentasMostrar").html(' $ '+totalVentas.toFixed(2)); 
 $("#totalVenta").val(totalVentas.toFixed(2)); 
 $("#listaProductos").val(JSON.stringify(listaProductos)); 

 iniciarComprobantes();


    

}




/*=============================================
CAMBIAR REFERENCIA DE PAGO
=============================================*/
$("#listaMetodoPago").change(function(){

  var metodo = $(this).val();
  console.log("metodo", metodo);

  $("#nuevaReferencia").val(metodo);
  $("#nuevaReferencia").focus();
  $("#nuevaReferencia").select();

})

/*=============================================
SELECCIONAR CLIENTE
=============================================*/
$(".tablaBuscarClientes").on("click", ".btnBuscarCliente", function(){

    var idCliente = $(this).attr("idCliente");
    var nombreCliente = $(this).attr("nombreCliente");
    var documentoCliente = $(this).attr("documentoCliente");
    var tipoDocumento = $(this).attr("tipoDocumento");
    var tipoCLiente = $(this).attr("tipoCLiente");
   
    
    $("#tipoCliente").val(tipoCLiente);
    $("#seleccionarCliente").val(idCliente);
    $("#nombreCliente").val(nombreCliente);
    $("#documentoCliente").val(documentoCliente);
    $("#tipoDocumento").val(tipoDocumento);

    importeTotal = parseInt($("#totalVenta").val());

     if(importeTotal ==0){
      

      $("#guardarVenta").attr('disabled',true);

    }else{

      $("#guardarVenta").attr('disabled',false);
    }
})

function validarCuit(cuit) {
 
        if(cuit.length != 11) {
            return false;
        }
 
        var acumulado   = 0;
        var digitos     = cuit.split("");
        var digito      = digitos.pop();
 
        for(var i = 0; i < digitos.length; i++) {
            acumulado += digitos[9 - i] * (2 + (i % 6));
        }
 
        var verif = 11 - (acumulado % 11);
        if(verif == 11) {
            verif = 0;
        } else if(verif == 10) {
            verif = 9;
        }
 
        return digito == verif;
}

$("#seleccionarClientCuit").on("click",function(){
 

      var datos = new FormData();
      datos.append("documentoVerificar", $('#documentoAgregarCliente').val());
      console.log("$('#documentoAgregarCliente').val()", $('#documentoAgregarCliente').val());
      

      $.ajax({

        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json", 
             
          success:function(respuestaDoc){
            console.log("respuestaDoc", respuestaDoc);
            if(respuestaDoc){

             swal("Este cuit ya fue cargado para "+respuestaDoc['nombre'], "Verifique los datos", "warning");

            }else{

             
              if (validarCuit($('#documentoAgregarCliente').val())){

                var datos = new FormData();
                datos.append("nombreAgregarCliente", $('#nombreAgregarCliente').val());
                datos.append("documentoAgregarCliente", $('#documentoAgregarCliente').val());
                datos.append("tipoCuitAgregarCliente",$("#tipoCuitAgregarCliente").val());
                datos.append("direccionAgregarCliente",$("#direccionAgregarCliente").val());
                datos.append("localidadAgregarCliente",$("#localidadAgregarCliente").val());

                $.ajax({

                  url:"ajax/clientes.ajax.php",
                  method: "POST",
                  data: datos,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType:"json", 
                             
                  success:function(respuesta){
                    console.log("respuesta", respuesta);
                  

                    $("#nombreCliente").val(respuesta['nombre']);
                    $("#documentoCliente").val(respuesta['cuit']);
                    $("#tipoDocumento").val('CUIT');
                    $('#seleccionarCliente').val(respuesta['id']);
                    $('#tipoCliente').val('clientes');
                    
                    // $("#nombreAgregarCliente").val('');
                    // $("#documentoAgregarCliente").val('');
                    // $("#tipoCuitAgregarCliente").val('');
                    // $('#direccionAgregarCliente').val('');
                    // $('#localidadAgregarCliente').val('');


                  } 

                })


              }else{

                swal("Este cuit no es correcto "+$('#documentoAgregarCliente').val(), "Verifique los datos", "warning");

              }

              

            }

          }
      })
})
/*=============================================
SELECCIONAR CLIENTE
=============================================*/
$(".tablaBuscarClientes").on("click", ".btnBuscarCliente2", function(){

    var idCliente = $(this).attr("idCliente");
    var nombreCliente = $(this).attr("nombreCliente");
    var documentoCliente = $(this).attr("documentoCliente");
    var tipoDocumento = $(this).attr("tipoDocumento");
    var tipoCLiente = $(this).attr("tipoCLiente");
    
    $("#seleccionarCliente").val(idCliente);
    $("#nombreCliente").val(nombreCliente);
    $("#documentoCliente").val(documentoCliente);
    $("#tipoDocumento").val(tipoDocumento);
    $("#tipoCliente").val(tipoCLiente);

    importeTotal = parseInt($("#totalVenta").val());

     if(importeTotal ==0){
      

      $("#guardarVenta").attr('disabled',true);

    }else{

      $("#guardarVenta").attr('disabled',false);
    }
}) 

$("#seleccionarClienteDni").on("click",function(){

    var idCliente = 0;
    var nombreClienteEventual = $("#nombreClienteEventual").val();
    var documentoClienteEventual = $("#documentoClienteEventual").val();
    var tipoDocumentoEventual = "DNI";
    
    $("#seleccionarCliente").val(idCliente);
    $("#nombreCliente").val((nombreClienteEventual).toUpperCase());
    $("#documentoCliente").val(documentoClienteEventual);
    $("#tipoDocumento").val(tipoDocumentoEventual);
    $("#modalClienteDni").modal('hide');
    $("#tipoCliente").val('casual');
  })