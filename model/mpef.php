<?php
class mpef{
	//Mostrar datos
	public function selpef($filtro, $rvalini, $rvalfin){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT f.pefid, f.pefnom, f.pagprin, p.pagnom, p.icono FROM perfil AS f INNER JOIN pagina AS p ON f.pagprin=p.pagid";
		if($filtro){
			$filtro = "%".$filtro."%";
			$sql .= " WHERE f.pefnom LIKE :filtro;";
		}
		$sql .= " ORDER BY f.pefid LIMIT $rvalini, $rvalfin";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($filtro){
			$result->bindParam(':filtro',$filtro);
		}
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//Contar datos
	public function sqlcount($filtro){
		$sql = "SELECT count(f.pefid) AS Npe FROM perfil AS f INNER JOIN pagina AS p ON f.pagprin=p.pagid";
		if($filtro)
			$sql .= " WHERE f.pefnom LIKE '%$filtro%';";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		return $sql;
	}
	//Mostrar un registro
	public function selpef1($pefid){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT f.pefid, f.pefnom, f.pagprin, p.pagnom, p.icono FROM perfil AS f INNER JOIN pagina AS p ON f.pagprin=p.pagid";
		$sql .= " WHERE f.pefid=:pefid";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':pefid',$pefid);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//Actualizar o Insertar
	public function updpef($pefid, $pefnom, $pagprin){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL pefiu(:pefid, :pefnom, :pagprin);";
		//echo "<br><br><br><br>".$sql."<br>'".$pefid."'-'".$pefnom."'-'".$pagprin."'<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':pefid',$pefid);
		$result->bindParam(':pefnom',$pefnom);
		$result->bindParam(':pagprin',$pagprin);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
	//Eliminar
	public function delpef($pefid){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL pefdel(:pefid);";
		//echo "<br><br><br><br>".$sql."<br>".$pefid."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':pefid',$pefid);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}

//------------------------ PAG x PER ----------------------------------
	public function selpg(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT pagid, pagnom, pagarc FROM pagina ORDER BY pagord";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	public function selpxp($pefid,$pagid){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT pagid, pefid FROM pagper WHERE pefid=:pefid AND pagid=:pagid";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':pefid',$pefid);
		$result->bindParam(':pagid',$pagid);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function delpxp($pefid){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "DELETE FROM pagper WHERE pefid=:pefid;";
		//echo "<br><br><br><br>".$sql."<br>".$pefid."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':pefid',$pefid);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}

	public function inspxp($pagid, $pefid){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "INSERT INTO pagper VALUES (:pagid, :pefid);";
		//echo "<br><br><br><br>".$sql."<br>'".$pagid."','".$pefid."'<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':pagid',$pagid);
		$result->bindParam(':pefid',$pefid);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
}
?>