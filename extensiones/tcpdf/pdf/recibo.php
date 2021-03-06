<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = explode("-", $respuestaVenta["fecha"]);
$fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
$productos = json_decode($respuestaVenta["productos"], true);
$adeuda = number_format($respuestaVenta["adeuda"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//TRAEMOS LA INFORMACIÓN DE LA EMPRESA
$itemEmpresa = "id";

$valorEmpresa = 1;
$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemEmpresa, $valorEmpresa);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="../../../$respuestaEmpresa[fotorecibo]"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					CUIT: $respuestaEmpresa[cuit]

					<br>
					Dirección: $respuestaEmpresa[direccion]

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: $respuestaEmpresa[telefono]
					
					<br>
					$respuestaEmpresa[email]

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:300px">Equipo: $respuestaVenta[detalle]</td>
			<td style="border: 1px solid #666; background-color:white; width:240px">Nro Serie: $respuestaVenta[nrofc]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
			<td style="border: 1px solid #666; background-color:#D8D8D8; width:540px; text-align:center">Observaciones</td>		

		</tr>

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center">$respuestaVenta[observaciones]</td>
		

		</tr>

	</table>
	
	<br>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
			<td style="border: 1px solid #666; background-color:#D8D8D8; width:540px; text-align:center">Nota</td>		

		</tr>

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center">$respuestaEmpresa[detalle1]</td>
		

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>
	

EOF;


$pdf->writeHTML($bloque3, false, false, false, false, '');

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);
$totale= count($respuestaProducto);
$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloqueB = <<<EOF
	
	
	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloqueB, false, false, false, false, '');

}

// ---------------------------------------------------------
$bloque4 = <<<EOF

<table style=" margin-top: 210px;">
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:300px">Equipo: $respuestaVenta[detalle]</td>
			<td style="border: 1px solid #666; background-color:white; width:240px">Nro Serie: $respuestaVenta[nrofc]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
			<td style="border: 1px solid #666; background-color:#D8D8D8; width:540px; text-align:center">Observaciones</td>		

		</tr>

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center">$respuestaVenta[observaciones]</td>
		

		</tr>

	</table>
	
	<br>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
			<td style="border: 1px solid #666; background-color:#D8D8D8; width:540px; text-align:center">Nota</td>		

		</tr>

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center">$respuestaEmpresa[detalle2]</td>
		

		</tr>

		

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td ></td>

			<td ></td>

		</tr>
		
		<tr>
		
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>

		<tr>
		
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td>Firma</td>

			

		</tr>

		
		

		


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');




// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>