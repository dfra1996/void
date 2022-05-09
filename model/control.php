<?php
	require_once('conexion.php');
	$usu = isset($_POST['usu']) ? $_POST['usu']:NULL;
	$con = isset($_POST['con']) ? $_POST['con']:NULL;
	$empcc = isset($_POST['empcc']) ? $_POST['empcc']:NULL;
	if ($usu and $con) 
		validar($usu,$con,$empcc);
	else
		echo '<script>window.location="../index.php?error=ok";</script>';
	
	function validar($usu,$con,$empcc){
		$res = verdat($usu,$con);
		$res= isset($res) ? $res:NULL;
		if($res){
			session_start();
			$_SESSION["idusu"] = $res[0]["idusu"];
			$_SESSION["nomusu"] = $res[0]["nomusu"]." ".$res[0]["apeusu"];
			$_SESSION["pefid"] = $res[0]["pefid"];
			$_SESSION["pefnom"] = $res[0]["pefnom"];
			$_SESSION["aut"] = "jY238Jn&5Hhass.??44aa@@fg(80";
			echo '<script>window.location="../home.php";</script>';
		}else
			echo '<script>window.location="../index.php?error=ok";</script>';
	}

	function verdat($usu,$con){
		$res = NULL;
		$pas = sha1(md5($con));
		$sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.pefid, p.pefnom, u.dirusu, u.telusu, u.codubi, b.nomubi FROM usuario AS u INNER JOIN ubicacion AS b ON u.codubi=b.codubi INNER JOIN perfil as p ON u.pefid=p.pefid WHERE u.emausu=:usu AND u.pasusu=:con AND actusu=1";
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