<?php

class ControladorProductos{



	/*=============================================
	MOSTRAR PRODUCTOS 1
	=============================================*/

	static public function MostrarProductos($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mostrarProduc($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor,$orden){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor,$orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){


				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
							   "id_proveedor" => $_POST["nuevaProveedor"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"]);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){


				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "id_proveedor" => $_POST["editarProveedor"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"]);

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			$datos = $_GET["idProducto"];


			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}		
		}


	}

	static public function crtSumarVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlSumarVentas($tabla);

		return $respuesta;
	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearPrestamo(){

		if(isset($_POST["prestarRazon"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["prestarRazon"]) &&
			   preg_match('/^[0-9]+$/', $_POST["cantidadActual"])){


				$tabla = "prestamo";
				$stock = $_POST["nuevoStock"];
				$idd = $_POST["idProducto1"];
				$tabla2 = "productos";

				$datos = array("codigo" => $_POST["prestarCodigo"],
							   "id" => $_POST["idProducto1"],
							   "producto" => $_POST["prestarProducto"],
							   "categoria" => $_POST["pretarCategoria"],
							   "proveedor" => $_POST["pretarProveedor"],
							   "precio" => $_POST["prestarPrecio"],
							   "cantidad" => $_POST["prestarCantida"],
							   "razon" => $_POST["prestarRazon"]);

				$respuesta = ModeloProductos::mdlIngresarPrestamo($tabla, $datos);

				if($respuesta == "ok"){

				$respuesta2 = ModeloProductos::mdlEditarStock($tabla2, $stock,$idd);


					echo'<script>

						swal({
							  type: "success",
							  title: "El prestamo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "prestamo";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
							if (result.value) {

							window.location = "prestamo";

							}
						})

			  	</script>';
			}
		}

	}

	static public function ctrMostrarPrestamo($item, $valor){

		$tabla = "prestamo";
		$orden = "id";

		$respuesta = ModeloProductos::mdlMostrarPrestamos($tabla, $item, $valor,$orden);

		return $respuesta;
	
	}

	/*=============================================
	BORRAR PRESTAMO
	=============================================*/
	static public function ctrEliminarPrestamo(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			$id = $_GET["id"];
			$id_producto = $_GET["idProducto"];
			$cantidad = $_GET["cantidad"];

			$tabla2 = "prestamo";

			$respuesta = ModeloProductos::mdlEliminarPrestamo($tabla2, $id);

			$stock = ModeloProductos::mdlMostrarProductos($tabla, "id",$id_producto ,$orden);
			$actu = $stock["stock"];

			$nuevo = $actu + $cantidad;
			

			if($respuesta == "ok"){

				$actualizar  = ModeloProductos::mdlEditarStock($tabla, $nuevo,$id_producto);

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}		
		}


	}


}