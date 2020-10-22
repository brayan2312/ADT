<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}
	// Mostrar Pedidos por entregar

	static public function mdlMostrarVentasPedidos($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pendiente = :valor");
		$stmt -> bindParam(":valor",$valor,PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		date_default_timezone_set("America/Mexico_City");
        $hoy = date("Y-m-d H:i:s");



		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos,total,descuento,efectivo,cambio,pendiente,lugar,fecha) VALUES (:codigo, :id_cliente, :id_vendedor, :productos,:total,:descuento,:efectivo,:cambio,:pendiente,:lugar,:fecha)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":efectivo", $datos["efectivo"], PDO::PARAM_STR);
		$stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":pendiente",$datos["pendiente"],PDO::PARAM_INT);
		$stmt->bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $hoy, PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA2
	=============================================*/

	static public function mdlIngresarVenta2($tabla, $datos){

		date_default_timezone_set("America/Mexico_City");
        $hoy = date("Y-m-d H:i:s");



		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos,total,descuento,recibi,resta,pendiente,lugar,fecha) VALUES (:codigo, :id_cliente, :id_vendedor, :productos,:total,:descuento,:recibi,:resta,:pendiente,:lugar,:fecha)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":recibi", $datos["recibi"], PDO::PARAM_STR);
		$stmt->bindParam(":resta", $datos["resta"], PDO::PARAM_STR);
		$stmt->bindParam(":pendiente",$datos["pendiente"],PDO::PARAM_INT);
		$stmt->bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $hoy, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos,total= :total,descuento=:descuento,efectivo=:efectivo,cambio=:cambio,recibi=:recibi,resta=:resta,pendiente=:pendiente,lugar=:lugar WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":efectivo", $datos["efectivo"], PDO::PARAM_STR);
		$stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":recibi", $datos["recibi"], PDO::PARAM_STR);
		$stmt->bindParam(":resta", $datos["resta"], PDO::PARAM_STR);
		$stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEditarVenta2($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos,total= :total,descuento=:descuento,recibi=:recibi,resta=:resta,efectivo=:efectivo,cambio=:cambio,pendiente=:pendiente,lugar=:lugar WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":recibi", $datos["recibi"], PDO::PARAM_STR);
		$stmt->bindParam(":resta", $datos["resta"], PDO::PARAM_STR);
		$stmt->bindParam(":efectivo", $datos["efectivo"], PDO::PARAM_STR);
		$stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	static public function modeloFechasVentas($tabla,$fechaI,$fechaF){

		if($fechaI == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else if($fechaI == $fechaF){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha LIKE '%$fechaF%'");

			$stmt -> bindParam(":fecha",$fechaF,PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{
			
			date_default_timezone_set('America/Mexico_City');

			$fechaActual = new DateTime();
			$fechaActual -> add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual -> format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaF);
			$fechaFinal2 -> add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2 -> format("Y-m-d");

			if($fechaActualMasUno == $fechaFinalMasUno){

				$stmt =  Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaI' AND '$fechaFinalMasUno'");

			}else{
				
				$stmt =  Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaI' AND '$fechaF'");
			
			}

			$stmt -> execute();

			return $stmt -> fetchAll();


			
		}

	}

	static public function mdlEntregarPedido($tabla,$id,$valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pendiente = :pendiente WHERE id = :id");

		$stmt -> bindParam(":pendiente",$valor,PDO::PARAM_INT);
		$stmt -> bindParam(":id",$id,PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlSumaTotalVentas($tabla){

		$stmt =  Conexion::conectar()->prepare("SELECT SUM(total) as Total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlEditarTotal($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  efectivo = :efectivo, cambio = :cambio, recibi = :recibi,resta= :resta WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":efectivo", $datos["efectivo"], PDO::PARAM_STR);
		$stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":recibi", $datos["recibi"], PDO::PARAM_STR);
		$stmt->bindParam(":resta", $datos["resta"], PDO::PARAM_STR);
		// $stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
		// $stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}