<?php 
require_once "../../../controladores/cotizacion.controlador.php";
require_once "../../../modelos/cotizacion.modelo.php";

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

$itemCoti = "codigo";
$valorCoti = $this->codigo;

$respuestaCotizacion = ControladorCotizacion::ctrMostrarCotizacion($itemCoti,$valorCoti);

$fecha = substr($respuestaCotizacion["fecha"],0,-8);
$productos = json_decode($respuestaCotizacion["productos"],true);
$total = number_format($respuestaCotizacion["total"]);

//Traemos la informacion del cliente
$itemCliente = "id";
$valorCliente = $respuestaCotizacion["id_client"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);

//Traemos la informacion del vendedor

$itemVendedor = "id";
$valorVendedor = $respuestaCotizacion["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor,$valorVendedor);




// ------------------------------------------------------------------------------------
require_once('tcpdf_include.php');

//Tipo de pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//Acepte mas de una hoja
$pdf -> startPageGroup();

// Agrega otra pagina
$pdf->AddPage();
// ----------------------------------------------------------------------------------
$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:180px"><img src="images/logo_reporte2.png"></td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">

				<br>
				AV. San bartolo, Carretera Nacional Acapulco-Zihuatanejo

				</div>

			</td>


			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">

				<br>
				Telefono: (742)-113-3332

				<br>
				Arq. Migual Cipriano Rosas

				</div>

			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br>N° $valorCoti</td>
		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque1,false,false,false,false,'');
// ---------------------------------------------------------------------------------------
$bloque2 = <<<EOF
	<table>
		<tr>
			<td style="width:540px;"><img src="images/back.jpg"></td>
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
			
			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre] </td>

		</tr>

		<tr>
			<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>
	
	</table>

EOF;

$pdf -> writeHTML($bloque2,false,false,false,false,'');
// ----------------------------------------------------------------------------------
$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>

			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit</td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;


$pdf -> writeHTML($bloque3,false,false,false,false,'');

// ----------------------------------------------------------------------------------

foreach ($productos as $key => $item) {
$itemProducto = "id";
$valorProducto = $item["id"];
$orden = "id";


$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto,$valorProducto,$orden);

$precioUnitario = number_format($respuestaProducto["precio_venta"],2);
$precioTotal = number_format($item["total"],2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px">

		<tr>	

			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$
				$precioUnitario
			</td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$
				$precioTotal
			</td>

		</tr>

	</table>

EOF;

$pdf -> writeHTML($bloque4,false,false,false,false,'');

}
// ----------------------------------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		


		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>

EOF;
$pdf -> writeHTML($bloque5,false,false,false,false,'');
// ----------------------------------------------------------------------------------
// Salida del Archivoo
$pdf -> Output('recibo.php');
}
}

//-----------------------------------------------------------------------------------------
$recibo = new imprimirRecibo();
$recibo -> codigo = $_GET["codigo"];
$recibo -> traerImpresionRecibo();


 ?>