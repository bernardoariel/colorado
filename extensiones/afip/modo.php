<?php

$prueba = "SI"; //SI O NO

if($prueba=="NO"){

	// MODO DE PRODUCCION

	$CUIT = 30584197680;
	$MODO = Wsaa::MODO_PRODUCCION;

}
if($prueba=="SI"){

	// MODO DE PRUEBA
	$CUIT = 20241591310;
	$MODO = Wsaa::MODO_HOMOLOGACION;
}

?>