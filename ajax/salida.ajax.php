<?php

require_once "../controladores/salida.controlador .php";
require_once "../modelos/salida.modelo.php";

class AjaxSalida{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idSalida;

	public function ajaxEditarSalida(){

		$item = "id";
		$valor = $this->idSalida;

	$respuesta = ControladorSalida::ctrMostrarSalida($item,$valor);
	
		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR ENTRADA
=============================================*/	

if(isset($_POST["idSalida"])){

	$salida = new AjaxSalida();
	$salida -> idSalida = $_POST["idSalida"];
	$salida -> ajaxEditarSalida();

}