<?php
	class musu{
	//Método de Insertar/Actualizar usuarios
		public function usuiu($idusu, $nomusu, $apeusu, $pefid, $dirusu, $telusu, $codubi, $emausu, $pasusu, $sexo, $imgus,$actusu){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "CALL usuiu(:idusu, :nomusu, :apeusu, :pefid, :dirusu, :telusu, :codubi, :emausu, :pasusu, :sexo, :imgus, :actusu)";
			//echo "<br><br><br><br>".$sql."<br><br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->bindParam(':idusu',$idusu);
			$result->bindParam(':nomusu',$nomusu);
			$result->bindParam(':apeusu',$apeusu);
			$result->bindParam(':pefid',$pefid);
			$result->bindParam(':dirusu',$dirusu);
			$result->bindParam(':telusu',$telusu);
			$result->bindParam(':codubi',$codubi);
			$result->bindParam(':emausu',$emausu);
						
			if($pasusu){
				$pas = sha1(md5($pasusu));
				$result->bindParam(':pasusu',$pas);	
			}else{
				$result->bindParam(':pasusu',$pasusu);	
			}
			$result->bindParam(':pasusu',$pas);
			$result->bindParam(':sexo',$sexo);
			$result->bindParam(':imgus',$imgus);
			$result->bindParam(':actusu',$actusu);

			try {
			    $result->execute();
			    echo "<script>alert('Datos insertados existosamente');</script>";
			} catch (PDOException $e) {
		    if ($e->getCode() == '23000')
		    	echo "<script>alert('Error: El email ya se encuentra registrado')</script>";
		        //echo "Syntax Error: ".$e->getMessage();
		}

		



			if(!$result)
				echo "<script>alert('ERROR AL INSERTAR/ACTUALIZAR');</script>";
			else
				$result->execute();
		}

	//Método de mostrar todos los usuarios
		public function selusu($filtro, $rvalini, $rvalfin){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT u.idusu, u.nomusu, u.apeusu, p.pefnom, u.dirusu, u.telusu, d.nomubi, u.emausu, u.pasusu, u.sexo, u.imgus, u.actusu, v.nomval FROM usuario AS u INNER JOIN perfil AS p ON u.pefid=p.pefid INNER JOIN ubicacion AS d ON u.codubi=d.codubi INNER JOIN valor as v ON u.sexo=v.codval ";

			if($filtro){
				$filtro2 = "%".$filtro."%";
				$sql .= " WHERE u.nomusu LIKE :filtro2 OR u.apeusu LIKE :filtro2 OR p.pefnom LIKE :filtro2 OR u.dirusu LIKE :filtro2 OR u.telusu=:filtro OR d.nomubi LIKE :filtro2 OR u.emausu LIKE :filtro2 OR u.sexo LIKE :filtro2";
			}

			$sql .= " ORDER BY u.idusu LIMIT $rvalini, $rvalfin;";
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
	//Método para contar los registros de los usuarios
		public function sqlcount($filtro){
			$sql = "SELECT COUNT(u.idusu) AS Npe FROM usuario AS u INNER JOIN perfil AS p ON u.pefid=p.pefid INNER JOIN ubicacion AS d ON u.codubi=d.codubi";

			if($filtro){
				$sql .= " WHERE u.nomusu LIKE '%$filtro%' OR u.apeusu LIKE '%$filtro%' OR p.pefnom LIKE '%$filtro%' OR u.dirusu LIKE '%$filtro%' OR u.telusu='$filtro' OR d.nomubi LIKE '%$filtro%' OR u.emausu LIKE '%$filtro%' OR u.sexo LIKE '%$filtro%'";
			}
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";

			return $sql;
		}
		public function selusers(){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT u.idusu, u.nomusu, u.apeusu, p.pefnom, u.dirusu, u.telusu, d.nomubi, u.emausu, u.pasusu, u.sexo, u.imgus, u.actusu, v.nomval FROM usuario AS u INNER JOIN perfil AS p ON u.pefid=p.pefid INNER JOIN ubicacion AS d ON u.codubi=d.codubi INNER JOIN valor as v ON u.sexo=v.codval ";

			$sql .= " ORDER BY u.idusu";
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

			$result->execute();

			while($f=$result->fetch()){
				$resultado[]=$f;
			}

			return $resultado;
		}

	//Método de mostrar un solo usuario
		public function selusu1($idusu){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT u.idusu, u.nomusu, u.apeusu, p.pefid, p.pefnom, u.dirusu, u.telusu, d.codubi, d.nomubi, u.emausu, u.pasusu, u.sexo, u.imgus FROM usuario AS u INNER JOIN perfil AS p ON u.pefid=p.pefid INNER JOIN ubicacion AS d ON u.codubi=d.codubi WHERE u.idusu=:idusu";
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->bindParam(':idusu',$idusu);
			$result->execute();

			while($f=$result->fetch()){
				$resultado[]=$f;
			}

			return $resultado;
		}

	//Método de eliminar usuarios
		public function usudel($idusu){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "CALL usudel(:idusu)";
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->bindParam(':idusu',$idusu);
			
			if(!$result)
				echo "<script>alert('ERROR AL ELIMINAR');</script>";
			else
				$result->execute();
		}

	//Metodo para mostrar los Perfiles
		public function selpef(){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT pefid, pefnom FROM perfil ORDER BY pefnom";
			//echo "<br><br><br><br>".$sql."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->execute();

			while($f=$result->fetch()){
				$resultado[]=$f;
			}

			return $resultado;
		}

	//Metodo para mostrar las Ciudades
		public function selubi(){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT c.codubi, c.nomubi AS ciu, d.nomubi AS dep FROM ubicacion AS c INNER JOIN ubicacion AS d ON c.depubi=d.codubi ORDER BY c.nomubi";
			//echo "<br><br><br><br>".$sql."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->execute();

			while($f=$result->fetch()){
				$resultado[]=$f;
			}

			return $resultado;
		}
		public function seldep(){
			$resultado = NULL;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT codubi, nomubi FROM ubicacion WHERE depubi = 0";
			//echo "<br><br><br><br>".$sql."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->execute();

			while($f=$result->fetch()){
				$resultado[]=$f;
			}

			return $resultado;
		}
	// Funcion Mostrar los sexos Masculino Femenino
		public function selgen(){
			$resultado = null;
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT codval, iddom, nomval, parval FROM valor WHERE iddom=1";
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result->execute();
			while($f=$result->fetch()){
				$resultado[]=$f;
			}
			return $resultado;
		}
	// Funcion para habilitar o desabilitar un usuario 
		public function actusu($idusu,$actusu){
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "UPDATE usuario SET actusu=:actusu WHERE idusu=:idusu;";
			//echo "<br><br><br><br>".$sql."<br>'".$idusu."'";
			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result->bindParam(':idusu',$idusu);
			$result->bindParam(':actusu',$actusu);

			if(!$result)
				echo "<script>alert('ERROR AL REGISTRAR')</script>";
			else
				$result->execute();
		}
	}
?>