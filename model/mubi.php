<?php
class mubi{
	public function selubi($filtro, $rvalini, $rvalfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT u.codubi, u.nomubi AS Nom, u.depubi AS Dep, d.nomubi AS nDp FROM ubicacion AS u INNER JOIN ubicacion AS d ON u.depubi=d.codubi";
		if($filtro){
			$filtro2 = "%".$filtro."%";
			$sql .= " WHERE u.depubi=:filtro OR u.nomubi LIKE :filtro2";
		}
		$sql .= " ORDER BY u.nomubi LIMIT $rvalini, $rvalfin;";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($filtro){
			$result->bindParam(':filtro',$filtro);
			$result->bindParam(':filtro2',$filtro2);
		}
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selubi1($codubi){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT u.codubi, u.nomubi AS Nom, u.depubi AS Dep, d.nomubi AS nDp FROM ubicacion AS u INNER JOIN ubicacion AS d ON u.depubi=d.codubi WHERE u.codubi=:codubi";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':codubi',$codubi);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function sqlcount($filtro){
		$sql = "SELECT COUNT(u.codubi) AS Npe FROM ubicacion AS u INNER JOIN ubicacion AS d ON u.depubi=d.codubi";
		if($filtro){
			$sql .= " WHERE u.depubi='$filtro' OR u.nomubi LIKE '%$filtro%';";
		}
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		return $sql;
	}

	public function ubiiu($codubi, $nomubi, $depubi){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL ubiiu(:codubi, :nomubi, :depubi)";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':codubi',$codubi);
		$result->bindParam(':nomubi',$nomubi);
		$result->bindParam(':depubi',$depubi);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}

	public function ubidel($codubi){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL ubidel(:codubi)";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':codubi',$codubi);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if(!$result)
			echo "<script>alert('ERROR AL ELIMINAR');</script>";
		else
			$result->execute();
	}

	public function selubi2(){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT codubi, nomubi, depubi FROM ubicacion WHERE depubi=0 ORDER BY nomubi;";
		//echo "<br><br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
}
?>