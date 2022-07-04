<?php
class Profile{
    public function list(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT f.pefid, f.pefnom, f.pagprin, p.pagnom, p.icono FROM perfil AS f INNER JOIN pagina AS p ON f.pagprin=p.pagid";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
    }
	public function insert($pefid, $pefnom, $pagprin){
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
}

?>