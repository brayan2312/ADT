<?php
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorVentas{

	static public function reImprimir(){

		if(isset($_GET["codig"])){

			$impresora = "epson20";

			$conector = new WindowsPrintConnector($impresora);

			$imprimir = new Printer($conector);

			$imprimir -> text("Hola Mundo"."\n");

			$imprimir -> cut();

			$imprimir -> close();
		}


	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrMostrarVentasPedidos($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentasPedidos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){


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

										window.location = "crear-venta";

										}
									})

					</script>';

			}else{
				
			

			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}//foreach-listarproductos

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			// date_default_timezone_set('America/Bogota');
            date_default_timezone_set("America/Mexico_City");


			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";
   

			$datos  = array();
			
			if(isset($_POST["efectivoo"])){

				    // $impresora = "epson-tm88";

				    // $conector = new WindowsPrintConnector($impresora);

				    // $printer = new Printer($conector);

				    // $printer -> setJustification(Printer::JUSTIFY_CENTER);

				    // // $printer -> text("Fecha".date("Y-m-d H:i:s")."\n");//Fecha de la factura

				    // // $printer -> feed(1); //Alimentamos el papel 1 vez*/

				    // $printer -> text("Acabados y Decorativos Tecpan"."\n");//Nombre de la empresa

				    // $printer -> text("Av San Bartolo N° 27 Col. Centro"."\n");//Dirección de la empresa

				    // $printer -> text("Cel: 742-113-3332"."\n");//Teléfono de la empresa

				    // $printer -> text("RFC: CIRM709291Q7"."\n");//Teléfono de la empresa
				    
				    // $printer -> text("Cajero: ".$_SESSION["nombre"]."\n");//Teléfono de la empresa

				    // $printer -> text("TICKET N.".$_POST["nuevaVenta"]."\n");//Número de factura

				    // $printer -> feed(1); //Alimentamos el papel 1 vez*/

				    // $tablaVendedor = "usuarios";
				    // $item = "id";
				    // $valor = $_POST["idVendedor"];

				    // $traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

				    // $printer -> text("Vendedor: ".$traerVendedor["nombre"]."\n");//Nombre del vendedor

				    // $printer -> feed(1); //Alimentamos el papel 1 vez*/

				    // foreach ($listaProductos as $key => $value) {

				    //   $printer->setJustification(Printer::JUSTIFY_LEFT);

				    //   $printer->text($value["descripcion"]."\n");//Nombre del producto

				    //   $printer->setJustification(Printer::JUSTIFY_RIGHT);

				    //   $sub = number_format($value["total"],2) + number_format($value["descuento"],2);

				    //   $printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".$sub."\n");

				    //   if($value["descuento"] > 0){

				    //    $printer->text("Descuento -$".number_format($value["descuento"],2)."\n");
				    //   }


				    // }

				    // $printer -> feed(1); //Alimentamos el papel 1 vez*/     

				    // $printer->text("--------------\n");

				    // if($_POST["totalDescuento"] > 0){

				    // $printer->text("DESCUENTO: $ ".number_format($_POST["totalDescuento"],2)."\n"); //ahora va el total
				    // }


				    // $printer->text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n"); //ahora va el total

				    // $printer->text("EFECTIVO: $ ".number_format($_POST["efectivoo"],2)."\n"); //ahora va el total

				    // $printer->text("CAMBIO: $ ".number_format($_POST["cambio"],2)."\n"); //ahora va el total

				    // $printer -> feed(1); //Alimentamos el papel 1 vez*/ 

				    // $printer -> setJustification(Printer::JUSTIFY_CENTER);

				    // $printer -> text("Fecha: ".date("Y-m-d H:i:s")."\n");//Fecha de la factura

				    // $printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página
				    
				    // $printer -> feed(1); //Alimentamos el papel 1 veces*/


				    // if($_POST["pendiente"] == 1){
				   	// 	 $direccion = $_POST["DireccionEntrega"];

				    // 	 $printer -> feed(1); //Alimentamos el papel 1 vez*/ 

				   	// 	 $printer -> setJustification(Printer::JUSTIFY_LEFT);

				    // 	$printer->text("Direción de entrega: ".$direccion); //Podemos poner también un pie de página

				    // }

				    // $printer -> feed(3); //Alimentamos el papel 3 veces*/

				    // $printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

				    // $printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder

				    // $printer -> close();

//mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm

				$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "total"=>$_POST["totalVenta"],
						   "descuento"=>$_POST["totalDescuento"],
						   "efectivo"=>$_POST["efectivoo"],
						   "cambio"=>$_POST["cambio"],
						   "pendiente" => $_POST["pendiente"],
						   "lugar" => $_POST["DireccionEntrega"]);

				$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
			}

			if(isset($_POST["Resta"])){

					 // $impresora = "epson-tm88";

			   //      $conector = new WindowsPrintConnector($impresora);

			   //      $printer = new Printer($conector);

			   //      $printer -> setJustification(Printer::JUSTIFY_CENTER);

			   //      // $printer -> text("Fecha".date("Y-m-d H:i:s")."\n");//Fecha de la factura

			   //      // $printer -> feed(1); //Alimentamos el papel 1 vez*/

			   //      $printer -> text("Acabados y Decorativos Tecpan"."\n");//Nombre de la empresa

			   //      $printer -> text("Av San Bartolo N° 27 Col. Centro"."\n");//Dirección de la empresa

			   //      $printer -> text("Cel: 742-113-3332"."\n");//Teléfono de la empresa

			   //      $printer -> text("RFC: CIRM709291Q7"."\n");//Teléfono de la empresa
			        
			   //      $printer -> text("Cajero: ".$_SESSION["nombre"]."\n");//Teléfono de la empresa

			   //      $printer -> text("TICKET N.".$_POST["nuevaVenta"]."\n");//Número de factura

			   //      $printer -> feed(1); //Alimentamos el papel 1 vez*/

			   //      $tablaVendedor = "usuarios";
			   //      $item = "id";
			   //      $valor = $_POST["idVendedor"];

			   //      $traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

			   //      $printer -> text("Vendedor: ".$traerVendedor["nombre"]."\n");//Nombre del vendedor

			   //      $printer -> feed(1); //Alimentamos el papel 1 vez*/

			   //      foreach ($listaProductos as $key => $value) {

			   //        $printer->setJustification(Printer::JUSTIFY_LEFT);

			   //        $printer->text($value["descripcion"]."\n");//Nombre del producto

			   //        $printer->setJustification(Printer::JUSTIFY_RIGHT);

			   //        $sub = number_format($value["total"],2) + number_format($value["descuento"],2);

			   //        $printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".$sub."\n");

			   //        if($value["descuento"] > 0){

			   //         $printer->text("Descuento -$".number_format($value["descuento"],2)."\n");
			   //        }


			   //      }

			   //      $printer -> feed(1); //Alimentamos el papel 1 vez*/     

			   //      $printer->text("--------------\n");

			   //      if($_POST["totalDescuento"] > 0){

			   //      $printer->text("DESCUENTO: $ ".number_format($_POST["totalDescuento"],2)."\n"); //ahora va el total
			   //      }


			   //      $printer->text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n"); //ahora va el total

			   //      $printer->text("ADELANTO: $ ".number_format($_POST["Adelanto"],2)."\n"); //ahora va el total

			   //      $printer->text("RESTA: $ ".number_format($_POST["Resta"],2)."\n"); //ahora va el total

			   //      $printer -> feed(1); //Alimentamos el papel 1 vez*/ 

			   //      $printer -> setJustification(Printer::JUSTIFY_CENTER);

			   //      $printer -> text("Fecha: ".date("Y-m-d H:i:s")."\n");//Fecha de la factura

			   //      $printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página

			   //      $printer -> feed(1); //Alimentamos el papel 1 veces*/


			   //      if($_POST["pendiente"] == 1){
			   //     		 $direccion = $_POST["DireccionEntrega"];

			   //      	 $printer -> feed(1); //Alimentamos el papel 1 vez*/ 

			   //     		 $printer -> setJustification(Printer::JUSTIFY_LEFT);

			   //      	$printer->text("Direción de entrega: ".$direccion); //Podemos poner también un pie de página

			   //      }

			   //      $printer -> feed(3); //Alimentamos el papel 3 veces*/

			   //      $printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

			   //      $printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder

			   //      $printer -> close();

//mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
				$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "total"=>$_POST["totalVenta"],
						   "descuento"=>$_POST["totalDescuento"],
						   "recibi"=>$_POST["Adelanto"],
						   "resta"=>$_POST["Resta"],
						   "pendiente" => $_POST["pendiente"],
						   "lugar" => $_POST["DireccionEntrega"]);

				$respuesta = ModeloVentas::mdlIngresarVenta2($tabla, $datos);
			}

			


			if($respuesta == "ok"){

				if($_POST["pendiente"] == 0){
				
					echo'<script>

						localStorage.removeItem("rango");

						swal({
							  type: "success",
							  title: "La venta ha sido guardada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "";

										}
									})

					</script>';


				}else{
					echo'<script>

						localStorage.removeItem("rango");

						swal({
							  type: "success",
							  title: "La venta ha sido guardada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "inicio";

										}
									})

					</script>';
				}///
			}//
			//
		 }	

		}

	}


	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2,$orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	
			if(isset($_POST["efectivoo"])){

				$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "total"=>$_POST["totalVenta"],
						   "descuento"=>$_POST["totalDescuento"],
						   "efectivo"=>$_POST["efectivoo"],
						   "cambio"=>$_POST["cambio"],
						   "pendiente" => $_POST["pendiente"],
						   "lugar"=>$_POST["DireccionEntrega"],
						   "recibi"=>"0.00",
						   "resta"=>"0.00");

				$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			}


			if(isset($_POST["Resta"])){

				$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "total"=>$_POST["totalVenta"],
						   "descuento"=>$_POST["totalDescuento"],
						   "recibi"=>$_POST["Adelanto"],
						   "resta"=>$_POST["Resta"],
						   "pendiente" => $_POST["pendiente"],
						   "lugar"=>$_POST["DireccionEntrega"],
						   "efectivo"=>"0.00",
						   "cambio"=>"0.00");

				$respuesta = ModeloVentas::mdlEditarVenta2($tabla, $datos);


			}

			

			if($respuesta == "ok"){

				if($_POST["pendienteEditar"] == 0){

					echo'<script>

					localStorage.removeItem("rango");

					swal({
						  type: "success",
						  title: "La venta ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
									if (result.value) {

									window.location = "ventas";

									}
								})

					</script>';


				}else{

					echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "inicio";

								}
							})

				</script>';

				}
				
			}

		}

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

	static public function controlFechasVentas($fechaI,$fechaF){

		$tabla = "ventas";

		$respuesta = ModeloVentas::modeloFechasVentas($tabla,$fechaI,$fechaF);

		return $respuesta;
	}

	static public function ctrEntregarPedido(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$valor = 0;

			$respuesta = ModeloVentas::mdlEntregarPedido($tabla, $_GET["idVenta"],$valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El pedido ha sido entregado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "inicio";

								}
							})

				</script>';

			}

		}
	}

	static public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){
			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::modeloFechasVentas($tabla,$_GET["fechaInicial"],$_GET["fechaFinal"]);

			}else{
				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);


			}

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

				<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>			
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

				foreach ($ventas as $row => $item) {
					$cliente = ControladorClientes::ctrMostrarClientes("id",$item["id_cliente"]);
					$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id",$item["id_vendedor"]);

					echo utf8_decode("<tr>

			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

					$productos =  json_decode($item["productos"],true);

					foreach ($productos as $key => $valueProductos) {

						echo utf8_decode($valueProductos["cantidad"]."<br>");
						
					}

					echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

			 		foreach ($productos as $key => $valueProductos) {
				 			
			 			echo utf8_decode($valueProductos["descripcion"]."<br>");
			 		
			 		}

			 		echo utf8_decode("</td>
						
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");

				}

			echo "</table>";

		}
	}

	static public function ctrSumaTotalVentas(){
		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;
	}

	static public function ctrActualizarAbonos(){
		
		if(isset($_POST["total"])){
			$tabla = "ventas";
			$resultado;

			if(isset($_POST["Editarefectivoo"])){

				$datos = array("codigo" => $_POST["EditarCodigo"],
							   "efectivo" => $_POST["Editarefectivoo"],
								"cambio" => $_POST["Editarcambio"],
								"recibi" => "0.00",
								"resta" => "0.00");
				$resultado = ModeloVentas::mdlEditarTotal($tabla, $datos);

			}

			if(isset($_POST["EditarAdelanto"])){
// -------------------------Paso 2-------------------------
				if($_POST["Editaresta"] == "0"){

					$datos = array("codigo" => $_POST["EditarCodigo"],
							   "efectivo" => $_POST["total"],
								"cambio" => "0.00",
								"recibi" => "0.00",
								"resta" => "0.00");
					$resultado = ModeloVentas::mdlEditarTotal($tabla, $datos);


				}else{

					$datos = array("codigo" => $_POST["EditarCodigo"],
							   "efectivo" => "0.00",
								"cambio" => "0.00",
								"recibi" => $_POST["EditarAdelanto"],
								"resta" => $_POST["Editaresta"]);
					$resultado = ModeloVentas::mdlEditarTotal($tabla, $datos);

				}
// ----------------------------------------------------------------------
				

			}


			if($resultado == "ok"){
				echo'<script>

					localStorage.removeItem("rango");

					swal({
						  type: "success",
						  title: "La venta ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
									if (result.value) {

									window.location = "ventas";

									}
								})

					</script>';
			}

		}
	}


	static public function ctrMostrarVentas_ticket($item, $valor){
		require_once "../modelos/ventas.modelo.php";
		require_once "../modelos/usuarios.modelo.php";
		$tabla = "ventas";


		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
		var_dump($respuesta);
		$id_vendedor = $respuesta["id_vendedor"];
		$efectivo = $respuesta["efectivo"];
		$respuesta2 = ModeloUsuarios::MdlMostrarUsuarios("usuarios", "id", $id_vendedor);
		var_dump($respuesta2);

		$Vendedor = $respuesta2["nombre"];
		$N_venta = $respuesta["codigo"];
		$listaProductos = json_decode($respuesta["productos"], true);
		var_dump($listaProductos);

		$descuentoT = $respuesta["descuento"];

		$TotalVenta = $respuesta["total"]; 
		$CambioT = $respuesta["cambio"];
		$Fecha = $respuesta["fecha"];
		$Pendiente = $respuesta["pendiente"];
		$Direccion = $respuesta["lugar"]; 

		$Adelanto = $respuesta["recibi"]; 
		$Resta = $respuesta["resta"]; 

		// $impresora = "epson-tm88";

		// $conector = new WindowsPrintConnector($impresora);

		// if($conector){
		// 	$imprimir = new Printer($conector);

		// $imprimir -> text("Hola Mundo"."\n");

		// $imprimir -> cut();

		// $imprimir -> close();
		// }

		



		// echo $TotalVenta."<br>";
		// echo $Adelanto."<br>";
		// echo $Resta."<br>";
		// echo $Fecha."<br>";
		// echo $Pendiente."<br>";
		// echo $Direccion."<br>";

		if($efectivo != "0.00"){
		


		//-----------------------------------------------------------------------------------------------------
		  		$impresora = "epson-tm88";

			    $conector = new WindowsPrintConnector($impresora);

			    $printer = new Printer($conector);

			    $printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text("Acabados y Decorativos Tecpan"."\n");//Nombre de la empresa

				$printer -> text("Av San Bartolo N° 27 Col. Centro"."\n");//Dirección de la empresa

				$printer -> text("Cel: 742-113-3332"."\n");//Teléfono de la empresa

				$printer -> text("RFC: CIRM709291Q7"."\n");//Teléfono de la empresa
				    
				$printer -> text("Cajero: ".$Vendedor."\n");//Teléfono de la empresa

				$printer -> text("TICKET N.".$N_venta."\n");//Número de factura

				$printer -> feed(1); //Alimentamos el papel 1 vez*/


				$printer -> text("Vendedor: ".$Vendedor."\n");//Nombre del vendedor

		        $printer -> feed(1); //Alimentamos el papel 1 vez*/
			
				foreach ($listaProductos as $key => $value) { //************************************************

					$printer->setJustification(Printer::JUSTIFY_LEFT);

					 $printer->text($value["descripcion"]."\n");//Nombre del producto

					 $printer->setJustification(Printer::JUSTIFY_RIGHT);

					 $sub = number_format($value["total"],2) + number_format($value["descuento"],2);

					 $printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".$sub."\n");

					  if($value["descuento"] > 0){

					    $printer->text("Descuento -$".number_format($value["descuento"],2)."\n");
					  }
				} //*************************************************************************************************


			$printer -> feed(1); //Alimentamos el papel 1 vez*/     

			$printer->text("--------------\n");

			if($descuentoT > 0){

				$printer->text("DESCUENTO: $ ".number_format($descuentoT,2)."\n"); //ahora va el total
			}

			 $printer->text("TOTAL: $ ".number_format($TotalVenta,2)."\n"); //ahora va el total

		     $printer->text("EFECTIVO: $ ".number_format($efectivo,2)."\n"); //ahora va el total

		     $printer->text("CAMBIO: $ ".number_format($CambioT,2)."\n"); //ahora va el total

		     $printer -> feed(1); //Alimentamos el papel 1 vez*/ 

			  $printer -> setJustification(Printer::JUSTIFY_CENTER);

			  $printer -> text("Fecha: ".$Fecha."\n");//Fecha de la factura

			  $printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página
				    
			  $printer -> feed(1); //Alimentamos el papel 1 veces*/

				if($Pendiente == 1){
					   

					$printer -> feed(1); //Alimentamos el papel 1 vez*/ 

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer->text("Direción de entrega: ".$Direccion); //Podemos poner también un pie de página

			    }

			 $printer -> feed(3); //Alimentamos el papel 3 veces*/

		     $printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

		     $printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder

			 $printer -> close();
		}
// ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
		if($efectivo == "0.00"){

		
    
			
			$impresora = "epson-tm88";

			$conector = new WindowsPrintConnector($impresora);

			$printer = new Printer($conector);

			$printer -> setJustification(Printer::JUSTIFY_CENTER);



			$printer -> text("Acabados y Decorativos Tecpan"."\n");//Nombre de la empresa

			$printer -> text("Av San Bartolo N° 27 Col. Centro"."\n");//Dirección de la empresa

			$printer -> text("Cel: 742-113-3332"."\n");//Teléfono de la empresa

			$printer -> text("RFC: CIRM709291Q7"."\n");//Teléfono de la empresa
			        
			$printer -> text("Cajero: ".$Vendedor."\n");//Teléfono de la empresa

			$printer -> text("TICKET N.".$N_venta."\n");//Número de factura

			$printer -> feed(1); //Alimentamos el papel 1 vez*/


			$printer -> text("Vendedor: ".$Vendedor."\n");//Nombre del vendedor

			$printer -> feed(1); //Alimentamos el papel 1 vez*/


			  foreach ($listaProductos as $key => $value) { //****************************************************


			        $printer->setJustification(Printer::JUSTIFY_LEFT);

			        $printer->text($value["descripcion"]."\n");//Nombre del producto

			        $printer->setJustification(Printer::JUSTIFY_RIGHT);

			        $sub = number_format($value["total"],2) + number_format($value["descuento"],2);

			        $printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".$sub."\n");

			        if($value["descuento"] > 0){

			           $printer->text("Descuento -$".number_format($value["descuento"],2)."\n");
			        }

			  } //**********************************************************************************************


			   $printer -> feed(1); //Alimentamos el papel 1 vez*/     

			   $printer->text("--------------\n");

		       if($descuentoT > 0){

		        $printer->text("DESCUENTO: $ ".number_format($descuentoT,2)."\n"); //ahora va el total

		       }



			  $printer->text("TOTAL: $ ".number_format($TotalVenta,2)."\n"); //ahora va el total

			  $printer->text("ADELANTO: $ ".number_format($Adelanto,2)."\n"); //ahora va el total

			  $printer->text("RESTA: $ ".number_format($Resta,2)."\n"); //ahora va el total

			  $printer -> feed(1); //Alimentamos el papel 1 vez*/ 

			  $printer -> setJustification(Printer::JUSTIFY_CENTER);

			  $printer -> text("Fecha: ".$Fecha."\n");//Fecha de la factura

			  $printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página

			  $printer -> feed(1); //Alimentamos el papel 1 veces*/

			   if($Pendiente == 1){

			       	
			        $printer -> feed(1); //Alimentamos el papel 1 vez*/ 

			        $printer -> setJustification(Printer::JUSTIFY_LEFT);

			        $printer->text("Direción de entrega: ".$Direccion); //Podemos poner también un pie de página

			    }


			   $printer -> feed(3); //Alimentamos el papel 3 veces*/

			   $printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

			   $printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder

			   $printer -> close();



		}


	}

	
}