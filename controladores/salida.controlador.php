<?php 
class ControladorSalida{

	static public function ctrMostrarSalida($item, $valor){

		$tabla = "salida";

		$respuesta = ModeloSalida::mdlMostrarSalida($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctringresarSalida(){

		if(isset($_POST["nuevaSalida"])){

			if(preg_match('/^[0-9.]+$/', $_POST["nuevaSalida"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["razonDeLadalida"])){

				$tabla = "salida";
				$datos =  array("monto" => $_POST["nuevaSalida"],
								"razon" => $_POST["razonDeLadalida"]);

				$respuesta = ModeloSalida::mdlIngresarSalida($tabla,$datos);

				if($respuesta ==  "ok"){
					echo '<script>

					swal({

						type: "success",
						title: "¡Los datos han sido guardados correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "salida";

						}

					});
				

					</script>';
				}

		   	}else{
		   		echo '<script>

					swal({

						type: "error",
						title: "¡Los campos no pueden ir vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "salida";

						}

					});
				

				</script>';
		   	}

		}
	}

	static public function ctrEditarSalida(){

		if(isset($_POST["EditarSalida"])){

			if(preg_match('/^[0-9.]+$/', $_POST["EditarSalida"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarRazonSalida"])){

				$id = $_POST["idS"];
				$tabla = "salida";
			$datos =  array("monto" => $_POST["EditarSalida"],
							"razon" => $_POST["EditarRazonSalida"],
							"id" => $id);

				$respuesta = ModeloSalida::mdlEditarSalida($tabla,$datos);

				if($respuesta ==  "ok"){
					echo '<script>

					swal({

						type: "success",
						title: "¡Los datos han sido guardados correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "salida";

						}

					});
				

					</script>';
				}

		   	}else{
		   		echo '<script>

					swal({

						type: "error",
						title: "¡Los campos no pueden ir vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "salida";

						}

					});
				

				</script>';
		   	}

		}
	}

	static public function ctrEliminarSalida(){

		if(isset($_GET["idSalida"])){

			$id = $_GET["idSalida"];

			$tabla = "salida";

			$respuesta = ModeloSalida::mdlEliminarSalida($tabla,$_GET["idSalida"]);

			if($respuesta == "ok"){
				echo'<script>

				swal({
					  type: "success",
					  title: "Los datos han sido borrados correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "salida";

								}
							})

				</script>';
			}
			

		}
	}
}

