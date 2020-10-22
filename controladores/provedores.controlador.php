<?php 
class ProvedoresControlador{

	static public  function ctrMostrarProvedores($item,$valor){

		$tabla = "proveedores";

		$respuesta = ProvedoresModelo::mdlMostrarProveedores($tabla,$item,$valor);

		return $respuesta;

	}


	static public function ctrCrearProvedor(){


		if(isset($_POST["nuevoProveedor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProveedor"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ., ]+$/', $_POST["nuevoEmpresa"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])){

				$tabla = "proveedores";

				$datos = array("nombre"=>$_POST["nuevoProveedor"],
					           "empresa"=>$_POST["nuevoEmpresa"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "email"=>$_POST["nuevoEmail"]);

			   	$respuesta = ProvedoresModelo::mdlIngresarProvedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El provedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "provedores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El provedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "provedores";

							}
						})

			  	</script>';
			}

		}
	}

	static public function ctrEditarProvedor(){


		if(isset($_POST["EditarProveedor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarProveedor"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ., ]+$/', $_POST["EditarEmpresa"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["EditarTelefono"]) && 
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["EditarEmail"])){

				$tabla = "proveedores";

				$datos = array("nombre"=>$_POST["EditarProveedor"],
					           "empresa"=>$_POST["EditarEmpresa"],
					           "telefono"=>$_POST["EditarTelefono"],
					           "email"=>$_POST["EditarEmail"],
					       		"id" =>$_POST["idPro"]);

			   	$respuesta = ProvedoresModelo::mdlEditarProvedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El provedor ha sido actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "provedores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El provedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "provedores";

							}
						})

			  	</script>';
			}

		}
	}

	static public function ctrEliminarProvedor(){

		if(isset($_GET["idProveedor"])){

			$id = $_GET["idProveedor"];
			$tabla = "proveedores";

			$respuesta = ProvedoresModelo::mdlEliminarProvedor($tabla,$id);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El proveedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "provedores";

								}
							})

				</script>';

			}	

		}
	}
}

