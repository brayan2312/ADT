<?php

require_once "../controladores/entrada.controlador.php";
require_once "../modelos/entrada.modelo.php";

class AjaxEntrada{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idEntrada;

	public function ajaxEditarEntrada(){

		$item = "id";
		$valor = $this->idEntrada;

	$respuesta = ControladorEntrada::ctrMostrarEntrada($item,$valor);
	
		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR ENTRADA
=============================================*/	

if(isset($_POST["idEntrada"])){

	$entrada = new AjaxEntrada();
	$entrada -> idEntrada = $_POST["idEntrada"];
	$entrada -> ajaxEditarEntrada();

}