$("#selectescribanos").change(function () {	 
	
	var datos = new FormData();
	datos.append("idEscribano", $(this).val());

	window.location = "index.php?ruta=historico&idEscribano="+$(this).val();
	
});