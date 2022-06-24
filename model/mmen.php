<?php
class mmen{
	public function selmen($pagmen, $pefid){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT g.pagid, g.pagnom, g.pagarc, g.pagmos, g.pagord, g.pagmen, e.pefid, g.icono FROM pagina AS g INNER JOIN pagper AS e ON g.pagid=e.pagid WHERE g.pagmen='$pagmen' AND e.pefid='$pefid' AND g.pagmos=1 ORDER BY g.pagord";
		$result = $conexion->prepare($sql);

		$result->execute();

		while($f=$result->fetch()){
			$resultado[] = $f;
		}
		return $resultado;
	}

	public function selpgact($pagid, $pefid){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT a.pagid, a.pagnom, a.pagarc, a.pagmos, a.pagord, a.pagmen, a.icono FROM pagina AS a INNER JOIN pagper AS e ON a.pagid=e.pagid WHERE a.pagid=:pagid AND e.pefid=:pefid";
		$result = $conexion->prepare($sql);
		$result->bindParam(":pagid",$pagid);
		$result->bindParam(":pefid",$pefid);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[] = $f;
		}
		return $resultado;
	}

	public function selpgpf($pefid){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT pefid, pefid , pagprin FROM perfil WHERE pefid=:pefid";
		$result = $conexion->prepare($sql);
		$result->bindParam(":pefid",$pefid);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[] = $f;
		}
		return $resultado;
	}

	public function selus($iduser){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT u.iduser, u.name, u.lastname, p.pefid , u.address, u.phone, d.nomubi, u.email , u.imgus FROM usuario AS u INNER JOIN perfil AS p ON u.idprofile =p.pefid INNER JOIN ubicacion AS d ON u.codubi=d.codubi WHERE u.iduser=:iduser";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(":iduser",$iduser);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[] = $f;
		}
		return $resultado;
	}
}
?>