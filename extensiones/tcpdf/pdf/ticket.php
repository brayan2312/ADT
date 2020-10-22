<?php 
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class imprimirRecibo{

public $codigo;

public function traerImpresionRecibo(){

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta,$valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"],true);
$total = number_format($respuestaVenta["total"],2);
$descuento = number_format($respuestaVenta["descuento"],2);
$cambioT = number_format($respuestaVenta["cambio"],2);
$efectivoT = number_format($respuestaVenta["efectivo"],2);

$Recibi = number_format($respuestaVenta["recibi"],2);
$Resta = number_format($respuestaVenta["resta"],2);


//Traemos la informacion del cliente
$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);

//Traemos la informacion del vendedor

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor,$valorVendedor);



// ------------------------------------------------------------------------------------
require_once('tcpdf_include.php');

//Tipo de pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');
//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9.5px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>

				<br><br>
				Acabados y Decorativos Tecpan

				<br>
				Av San Bartolo N° 27 Col. Centro

				<br>
				Cel: 742-113-3332

				<br>

				RFC: CIRM709291Q7

				<br>
				Cajero: $respuestaVendedor[nombre]

				<br>
				TICKET N°.$valorVenta


				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');
// ---------------------------------------------------------


foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque2 = <<<EOF

<table style="font-size:9.5px;">

	<tr>
	
		<td style="width:160px; text-align:left">
		$item[descripcion] 
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:right">
		$ $valorUnitario Und * $item[cantidad]  = $ $precioTotal
	
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:right">
		Descuento -$ $item[descuento] 

		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------
if($efectivoT != "0.00"){
$bloque3 = <<<EOF

<table style="font-size:9.5px; text-align:right">

	

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 DESCUENTO: 
		</td>

		<td style="width:80px;">
			$ $descuento
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 EFECTIVO: 
		</td>

		<td style="width:80px;">
			$ $efectivoT
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 CAMBIO: 
		</td>

		<td style="width:80px;">
			$ $cambioT
		</td>

	</tr>


	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Muchas gracias por su compra
			Fecha: $fecha
		</td>

	</tr>

	

</table>

EOF;
}else{

	$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 DESCUENTO: 
		</td>

		<td style="width:80px;">
			$ $descuento
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 RECIBI: 
		</td>

		<td style="width:80px;">
			$ $Recibi
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 RESTA: 
		</td>

		<td style="width:80px;">
			$ $Resta
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Muchas gracias por su compra
			<br>
			Fecha: $fecha
		</td>

	</tr>
	
	

</table>

EOF;
}
$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

// ----------------------------------------------------------------------------------
// Salida del Archivoo
$pdf -> Output('ticket.pdf');
}
}

//-----------------------------------------------------------------------------------------
$recibo = new imprimirRecibo();
$recibo -> codigo = $_GET["codigo"];
$recibo -> traerImpresionRecibo();


 ?>