<?php
	class mcom{
	//Método de Insertar/Actualizar usuarios
		public function comiu($idcom, $idusu, $idinc, $descom/*, $feccom*/){
			$resultado = null;
			$model = new conexion();
			$conexion = $model->get_conexion();
			$sql = "CALL comiu(:idcom, :idusu, :idinc, :descom, NOW())";
			//echo "<br><br><br><br>".$idcom."-".$idusu."-".$idinc."-".$descom."-".NOW()."<br><br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->bindParam(':idcom',$idcom);
			$result->bindParam(':idusu',$idusu);
			$result->bindParam(':idinc',$idinc);
			$result->bindParam(':descom',$descom);
			//$result->bindParam(':feccom',$feccom);

			if(!$result)
				echo "<script>alert('ERROR AL INSERTAR/ACTUALIZAR');</script>";
			else
				$result->execute();
		}

	//Método de mostrar todos los comentarios
		public function selcome($filtro, $rvalini, $rvalfin){
			$resultado = null;
			$model = new conexion();
			$conexion = $model->get_conexion();
			$sql = "SELECT c.idcom, u.nomusu, u.apeusu, i.textinc, c.descom, c.feccom, v.nomval, c.idusu FROM comentario AS c INNER JOIN usuario AS u ON c.idusu=u.idusu INNER JOIN incidente AS i ON c.idinc=i.idinc INNER JOIN valor AS v ON i.tipo=v.codval";

			if($filtro){
				$filtro2 = "%".$filtro."%";
				$sql .= " WHERE u.nomusu LIKE :filtro2 OR u.apeusu LIKE :filtro2 OR i.textinc LIKE :filtro2 OR c.feccom=:filtro";
			}

			$sql .= " ORDER BY c.idcom LIMIT $rvalini, $rvalfin;";
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
			$sql = "SELECT COUNT(c.idcom) AS Npe FROM comentario AS c INNER JOIN usuario AS u ON c.idusu=u.idusu INNER JOIN incidente AS i ON c.idinc=i.idinc";

			if($filtro){
				$sql .= " WHERE u.nomusu LIKE '%$filtro%' OR u.apeusu LIKE '%$filtro%' OR i.textinc LIKE '%$filtro%' OR c.feccom='$filtro'";
			}
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";

			return $sql;
		}

	//Método de mostrar un solo usuario
		public function selcome1($idcom){
			$resultado = null;
			$model = new conexion();
			$conexion = $model->get_conexion();
			$sql = "SELECT u.idusu, c.idcom, u.nomusu, u.apeusu, i.idinc, i.textinc, c.descom, c.feccom, v.nomval, v.codval FROM comentario AS c INNER JOIN usuario AS u ON c.idusu=u.idusu INNER JOIN incidente AS i ON c.idinc=i.idinc INNER JOIN valor AS v ON i.tipo=v.codval WHERE c.idcom=:idcom";
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->bindParam(':idcom',$idcom);
			$result->execute();

			while($f=$result->fetch()){
				$resultado[]=$f;
			}

			return $resultado;
		}

	//Método de eliminar usuarios
		public function comdel($idcom){
			$resultado = null;
			$model = new conexion();
			$conexion = $model->get_conexion();
			$sql = "CALL comdel(:idcom)";
			//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->bindParam(':idcom',$idcom);
			
			if(!$result)
				echo "<script>alert('ERROR AL ELIMINAR');</script>";
			else
				$result->execute();
		}

	//Metodo para mostrar los Incidentes
		public function selinc(){
			$resultado = null;
			$model = new conexion();
			$conexion = $model->get_conexion();
			$sql = "SELECT i.textinc, i.idinc, v.codval, v.nomval FROM valor AS v INNER JOIN incidente AS i ON i.tipo=v.codval";
			//echo "<br><br><br><br>".$sql."<br>";

			$result = $conexion->prepare($sql);
			//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$result->execute();

			while($f=$result->fetch()){
				$resultado[]=$f;
			}

			return $resultado;
		}

	//Metodo para mostrar los Usuarios
		public function selusu(){
			$resultado = null;
			$model = new conexion();
			$conexion = $model->get_conexion();
			$sql = "SELECT idusu, nomusu, apeusu FROM usuario";
			//echo "<br><br><br><br>".$sql."<br>";

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