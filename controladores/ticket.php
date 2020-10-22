<?php 

// require_once "../modelos/ventas.modelo.php";
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;	
// require_once "../../modelos/ventas.modelo.php";
// require_once "../../modelos/usuarios.modelo.php";
$impresora = "epson20";

$conector = new WindowsPrintConnector($impresora);

$imprimir = new Printer($conector);

$imprimir -> text("Hola Mundo"."\n");

$imprimir -> cut();

$imprimir -> close();

// echo'<script type="text/javascript">
   
	
// parent.window.close();
//   </script>';
?>