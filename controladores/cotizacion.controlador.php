<?php 

class ControladorCotizacion{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarCotizacion($item, $valor){

		$tabla = "catizaciones";

		$respuesta = ModeloCotizacion::mdlMostrarCotizacion($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearCotizacion(){

		if(isset($_POST["listaProductos"])){
			$listaProductos = json_decode($_POST["listaProductos"], true);

			
			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/
			if($listaProductos == null || $listaProductos == []){
				var_dump($listaProductos);

				echo'<script>

						localStorage.removeItem("rango");

						swal({
							  type: "error",
							  title: "Debes agregar por lo menos un producto",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "crear-cotizacion";

										}
									})

					</script>';

			}else{

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "catizaciones";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   // "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   // "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);

			$respuesta = ModeloCotizacion::mdlIngresarCotizacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

						localStorage.removeItem("rango");

						swal({
							  type: "success",
							  title: "La Cotización ha sido guardada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "cotizaciones";

										}
									})

					</script>';

				}
			}
		}	

		}

	static public function ctrEditarCotizacion(){
		// 

		if(isset($_POST["editarVenta"])){

			$listaProductos = $_POST["listaProductos"];
			

			/*=============================================
			GUARDAR CAMBIOS DE LA COTIZACIÓN
			=============================================*/	
			$tabla = "catizaciones";


			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   // "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   // "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);
			// "metodo_pago"=>$_POST["listaMetodoPago"]


			$respuesta = ModeloCotizacion::mdlEditarCotizacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					localStorage.removeItem("rango");

					swal({
						  type: "success",
						  title: "La Cotización ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
									if (result.value) {

									window.location = "cotizaciones";

									}
						})

				</script>';

				
				
			}

		}

	}
	static public function ctrEliminarCotizacion(){

		if(isset($_GET["idCotizacion"])){

			$tabla = "catizaciones";
			

			$item = "id";
			$valor = $_GET["idCotizacion"];

			$respuesta = ModeloCotizacion::mdlEliminarCotizacion($tabla, $_GET["idCotizacion"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La cotizacion ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "cotizaciones";

								}
							})

				</script>';

			}	
	}

	}

}