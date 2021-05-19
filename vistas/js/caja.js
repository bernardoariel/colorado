/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnImprimirCaja", function(){

	var fecha = $(this).attr("fecha");
	console.log("fecha", fecha);

	window.open("extensiones/fpdf/pdf/caja.php?fecha1="+fecha);
				 window.location = "caja";

})
