<?php 
require_once "conexion.php";


class ModeloEntrada{

	static public function mdlMostrarEntrada($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlIngresarEntrada($tabla,$datos){

		date_default_timezone_set("America/Mexico_City");
        $hoy = date("Y-m-d H:i:s");

		$stmt =  Conexion::conectar()->prepare("INSERT INTO entrada (monto,razon,fecha)VALUES(:monto,:razon,:fecha)");

		$stmt -> bindParam(":monto",$datos["monto"],PDO::PARAM_STR);
		$stmt -> bindParam(":razon",$datos["razon"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $hoy, PDO::PARAM_STR);

		if($stmt->execute()){
			 return "ok";

		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlEditarEntrada($tabla,$datos){

	$stmt =  Conexion::conectar()->prepare("UPDATE $tabla SET monto= :monto, razon= :razon WHERE id= :id");

		$stmt -> bindParam(":id",$datos["id"],PDO::PARAM_INT);
		$stmt -> bindParam(":monto",$datos["monto"],PDO::PARAM_STR);
		$stmt -> bindParam(":razon",$datos["razon"],PDO::PARAM_STR);
	

		if($stmt->execute()){
			 return "ok";

		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlEliminarEntrada($tabla,$datos){

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

	static public function mdlMostrarCaja($tabla){


			$stmt = Conexion::conectar()->prepare("SELECT fecha FROM $tabla ORDER by ID DESC LIMIT 1");

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlInsrtarCaja($tabla,$numero,$fecha){

		$stmt =  Conexion::conectar()->prepare("INSERT INTO $tabla (dinero,fecha)VALUES(:dinero,:fecha)");

		$stmt -> bindParam(":dinero",$numero,PDO::PARAM_STR);
		$stmt -> bindParam(":fecha",$fecha,PDO::PARAM_STR);


		if($stmt->execute()){
			 return "ok";

		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlMostrarDinero($tabla,$fecha){


		// $stmt = Conexion::conectar()->prepare("SELECT fecha FROM $tabla ORDER by ID DESC LIMIT 1");
		$stmt = Conexion::conectar()->prepare("SELECT dinero FROM $tabla WHERE fecha = :fecha");

		$stmt -> bindParam(":fecha",$fecha,PDO::PARAM_STR);



		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}

}


