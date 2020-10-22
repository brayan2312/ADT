<?php 
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

if(isset($_POST["numero"])){

	$numero = $_POST["numero"];
	$id = $_POST["id"];
	$tabla = "productos";

	$respuesta = ModeloProductos::mdlEditarStock($tabla,$numero,$id);

}




 ?>