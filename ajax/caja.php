<?php 
require_once "../controladores/entrada.controlador.php";
require_once "../modelos/entrada.modelo.php";

if(isset($_POST["numero"])){

	$numero = $_POST["numero"];
	$fecha = $_POST["fecha"];
	$tabla = "caja";

	$respuesta = ModeloEntrada::mdlInsrtarCaja($tabla,$numero,$fecha);

}




 ?>