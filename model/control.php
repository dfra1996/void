<?php
	require_once('conexion.php');
	$usu = isset($_POST['usu']) ? $_POST['usu']:NULL;
	$con = isset($_POST['con']) ? $_POST['con']:NULL;
	
	if ($usu and $con) 
		validar($usu,$con);
	else
		echo '<script>window.location="../index.php?error=ok";</script>';
	
	function validar($usu,$con){
		$res = verdat($usu,$con);
		$res= isset($res) ? $res:NULL;
		if($res){
			session_start();
			$_SESSION["iduser"] = $res[0]["iduser"];
			$_SESSION["name"] = $res[0]["name"]." ".$res[0]["lastname"];
			$_SESSION["idprofile"] = $res[0]["idprofile"];
			$_SESSION["pefnom"] = $res[0]["pefnom"];
			$_SESSION["aut"] = "jY238Jn&5Hhass.??44aa@@fg(80";
			echo '<script>window.location="../home.php";</script>';
		}else
			echo '<script>window.location="../index.php?error=ok";</script>';
	}

	function verdat($usu,$con){
		$res = NULL;
		$pas = sha1(md5($con));
		
		$sql = "SELECT u.iduser, u.name, u.lastname, u.idprofile, u.address, u.phone, u.codubi, u.email, u.password, u.imgus, u.status, u.fecsolusu, u.clausu, p.pefnom FROM usuario AS u INNER JOIN ubicacion AS b ON u.codubi=b.codubi INNER JOIN perfil as p ON u.idprofile=p.pefid;
		WHERE u.email=:usu AND u.passsword=:con AND actusu=1";
		//echo "<br><br><br><br><br><br>".$sql."<br>'".$usu."','".$pas."'<br>";
		$model=new conexion();
		$conexion = $model->get_conexion();
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION). "<br><br>";
		$result->bindParam(':usu', $usu);
		$result->bindParam(':con', $pas);
		$result->execute();
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}
?>