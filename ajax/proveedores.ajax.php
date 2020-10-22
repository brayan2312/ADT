<?php

require_once "../controladores/provedores.controlador.php";
require_once "../modelos/provedores.modelo.php";

class AjaxProvedores{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idProveedorr;

	public function ajaxEditarProveedor(){

		$item = "id";
		$valor = $this->idProveedorr;

		$respuesta = ProvedoresControlador::ctrMostrarProvedores($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idProveedor"])){

	$proveedor = new AjaxProvedores();
	$proveedor -> idProveedorr = $_POST["idProveedor"];
	$proveedor -> ajaxEditarProveedor();

}