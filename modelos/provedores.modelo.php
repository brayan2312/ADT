<?php 
require_once "conexion.php";


class ProvedoresModelo{

	static public function mdlMostrarProveedores($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :id");

			$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

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


	static public function mdlIngresarProvedor($tabla,$datos){

		

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre,empresa,telefono,email) VALUES (:nombre,:empresa,:telefono,:email)");

		$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt -> bindParam(":empresa",$datos["empresa"],PDO::PARAM_STR);
		$stmt -> bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt -> bindParam(":email",$datos["email"],PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		}

		$stmt -> close();
		$stmt = null;
	}

	
	static public function mdlEditarProvedor($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, empresa= :empresa, telefono = :telefono, email= :email WHERE id = :id");

		$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt -> bindParam(":empresa",$datos["empresa"],PDO::PARAM_STR);
		$stmt -> bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt -> bindParam(":email",$datos["email"],PDO::PARAM_STR);
		$stmt -> bindParam(":id",$datos["id"],PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		}

		$stmt -> close();
		$stmt = null;
	}

	static public function mdlEliminarProvedor($tabla,$valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");

		$stmt -> bindParam(":id",$valor,PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		}

		$stmt -> close();
		$stmt = null;


	}

}