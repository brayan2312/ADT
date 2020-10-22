<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxTotal{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idVenta;

	public function ajaxEditarTotal(){

		$item = "id";
		$valor = $this->idVenta;

		$respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idVenta"])){

	$venta = new AjaxTotal();
	$venta -> idVenta = $_POST["idVenta"];
	$venta -> ajaxEditarTotal();
}
