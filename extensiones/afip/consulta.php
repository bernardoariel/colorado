<?php

include_once (__DIR__ . '/wsfev1.php');
include_once (__DIR__ . '/wsfexv1.php');
include_once (__DIR__ . '/wsaa.php');


// $CUIT = 30584197680;
// $MODO = Wsaa::MODO_PRODUCCION;
include ('modo.php');
$PTOVTA = 6; //lo puse acá para pasarlo como parámetro para los certificados por pto de vta

$afip = new Wsfev1($CUIT,$MODO,$PTOVTA);

$result = $afip->init();
if ($result["code"] === Wsfev1::RESULT_OK) {
    $result = $afip->dummy();
    if ($result["code"] === Wsfev1::RESULT_OK) {
    	// echo '<pre>'; print_r($result); echo '</pre>';
        
        //$datos = print_r($result["msg"], TRUE);
        //echo "Resultado: " . $datos . "\n";
		
		//$afip = new Wsfev1($CUIT, Wsaa::MODO_HOMOLOGACION); 

	    //$result = $afip->init(); //Crea el cliente SOAP
		//$ptovta = 2;
		$tipocbte = 13;
	
	
		// $result = $afip->consultarComprobante($PTOVTA,$tipocbte,$_GET['numero']);
		// echo '<pre>'; print_r($result); echo '</pre>';
	
     
  
		
    } else {
        echo $result["msg"] . "\n";
    }
} else {
    echo $result["msg"] . "\n";
}

