<?php 
class ControladorEntrada{

	static public function ctrMostrarEntrada($item, $valor){

		$tabla = "entrada";

		$respuesta = ModeloEntrada::mdlMostrarEntrada($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctringresarEntrada(){

		if(isset($_POST["nuevaEntrada"])){

			if(preg_match('/^[0-9.]+$/', $_POST["nuevaEntrada"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["razonEntrada"])){

				$tabla = "entrada";
				$datos =  array("monto" => $_POST["nuevaEntrada"],
								"razon" => $_POST["razonEntrada"]);

				$respuesta = ModeloEntrada::mdlIngresarEntrada($tabla,$datos);

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

	static public function ctrEditarEntrada(){

		if(isset($_POST["EditarEntrada"])){

			if(preg_match('/^[0-9.]+$/', $_POST["EditarEntrada"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarRazon"])){
			   	
				$id = $_POST["idE"];
				$tabla = "entrada";
				$datos =  array("monto" => $_POST["EditarEntrada"],
								"razon" => $_POST["EditarRazon"],
								"id" => $id);

				$respuesta = ModeloEntrada::mdlEditarEntrada($tabla,$datos);

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

	static public function ctrEliminarEntrada(){

		if(isset($_GET["idEntrada"])){

			$id = $_GET["idEntrada"];

			$tabla = "entrada";

			$respuesta = ModeloEntrada::mdlEliminarEntrada($tabla,$_GET["idEntrada"]);

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

	static public function ctrMostrarCajero(){

		$tabla = "caja";

		$respuesta = ModeloEntrada::mdlMostrarCaja($tabla);

		return $respuesta;

	}


	static public function ctrMostrarDinero($fecha){

		$tabla = "caja";

		$respuesta = ModeloEntrada::mdlMostrarDinero($tabla,$fecha);

		return $respuesta;

	}
}

