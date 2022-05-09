<?php
	require_once 'model/conexion.php';
	require_once 'model/musu.php';
	require_once 'model/mpagina.php';

$pg = 305;
$arc = "home.php";
$musu = new musu();

$idusu = isset($_POST['idusu']) ? $_POST['idusu']:NULL;
if(!$idusu){
	$idusu = isset($_GET['idusu']) ? $_GET['idusu']:NULL;
}

$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu']:NULL;
$apeusu = isset($_POST['apeusu']) ? $_POST['apeusu']:NULL;
$pefid = isset($_POST['pefid']) ? $_POST['pefid']:3;
$dirusu = isset($_POST['dirusu']) ? $_POST['dirusu']:NULL;
$telusu = isset($_POST['telusu']) ? $_POST['telusu']:NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
$emausu = isset($_POST['emausu']) ? $_POST['emausu']:NULL;
$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu']:NULL;
$sexo = isset($_POST['sexo']) ? $_POST['sexo']:NULL;
$imgus = isset($_GET['imgus']) ? $_GET['imgus']:"image/indefinido.jpg";
$actusu = isset($_GET['actusu']) ? $_GET['actusu']:1;

$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL;
if(!$filtro){
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
}

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera){
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;
}
//echo "<br><br>".$idusu."-".$nomusu."-".$apeusu."-".$pefid."-".$dirusu."-".$telusu."-".$codubi."-".$emausu."-".$pasusu."-".$sexo."-".$imgus."-".$filtro."<br><br>";

//Insertar o Actualizar
	if($opera=="InsAct"){
		if($nomusu && $apeusu && $pefid && $emausu){
			$musu->usuiu($idusu, $nomusu, $apeusu, $pefid, $dirusu, $telusu, $codubi, $emausu, $pasusu, $sexo, $imgus, $actusu);
				echo "<script>alert('Datos insertados y/o actualizados exitosamente');</script>";
			$idusu = NULL;
		}else{
			echo "<script>alert('Faltan llenar algunos campos');</script>";
		}
	}

//Eliminar
	if($opera=="Elim"){
		if($idusu){
			$musu->usudel($idusu);
				echo "<script>alert('Datos eliminados exitosamente');</script>";
		}
	}
if($opera=="ActuOK"){
	if($idusu && $actusu)
		$musu->actusu($idusu,$actusu);
	$idusu = "";
}

if($idusu){
	$GLOBALS['nu'] = 1;
	$GLOBALS['alto'] = "750px";
}


//Paginacion parte 1
$bo = "";
$nreg = 17;
$pa = new mpagina();
$preg = $pa->mpagin($nreg);
$conp = $musu->sqlcount($filtro);

//Formulario Insercion de datos
	function insdatos($idusu,$pg,$arc){
		$musu = new musu();
		$dtdto = $musu->seldep();		
		$dtpef = $musu->selpef();
		$gene = $musu->selgen();
		$dtusu = NULL;
		$perfil = isset($_SESSION["pefid"]) ? $_SESSION["pefid"]:NULL;

		if($idusu) $dtusu = $musu->selusu1($idusu);

		$txt = '';
		$txt .= '<div class="conte">';
			if ($pg==201) {
				$txt .= '<h2>Registro de Usuario</h2>';
			}elseif($pg=="314"){
				$txt .= '<h2>Actualizar mis datos</h2>';
			}else{
				$txt .= tit("Nuevo usuario","far fa-plus-square ico3",$arc,$pg,"700px",2);
				$txt .= '<div id="inser">';	
				
			}
			
			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';

			if($idusu && $dtusu){
				$txt .= '<label>Id del Usuario</label>';
				$txt .= '<input type="number" name="idusu" readonly value="'.$idusu.'" class="form-control" />';
			}

			$txt .= '<label>Nombre del Usuario</label>';
			$txt .= '<input type="text" name="nomusu" maxlength="50" class="form-control" onkeypress="return sololet(event);"';
				if($idusu && $dtusu) $txt .= ' value="'.$dtusu[0]['nomusu'].'"';
				$txt .= ' required />';

			$txt .= '<label>Apellido del Usuario</label>';
			$txt .= '<input type="text" name="apeusu" maxlength="50" class="form-control" onkeypress="return sololet(event);"';
				if($idusu && $dtusu) $txt .= ' value="'.$dtusu[0]['apeusu'].'"';
				$txt .= ' required />';

//Perfil
			if($perfil==1){
				$txt .= '<label>Perfil del Usuario</label>';
				$txt .= '<select name="pefid" class="form-control" required>';
					if($dtpef){
						foreach ($dtpef as $f) {
							$txt .= '<option value="'.$f['pefid'].'"';
							if ($idusu && $dtusu && $f['pefid']==$dtusu[0]['pefid']) $txt .= " selected ";
							$txt .= '>'.$f['pefnom'].'</option>';
						}
					}
				$txt .= '</select>';
			}

			$txt .= '<label>Direccion del Usuario</label>';
			$txt .= '<input type="text" name="dirusu" maxlength="100" class="form-control"';
				if($idusu && $dtusu) $txt .= ' value="'.$dtusu[0]['dirusu'].'"';
				$txt .= '/>';

			$txt .= '<label>Telefono del Usuario</label>';
			$txt .= '<input type="number" name="telusu" maxlength="10" class="form-control"onkeypress="return solonum(event);" ';
				if($idusu && $dtusu) $txt .= ' value="'.$dtusu[0]['telusu'].'"';
				$txt .= '/>';

//Ubicacion
			$txt .= '<label>Departamento</label>';
			$txt .= '<select name="depto" class="form-control"onChange="javascript:recCiudad(this.value);">';
				$txt .= '<option value="0">Seleccione el Departamento</option>';
				if($dtdto){
					foreach ($dtdto as $f) {
						$txt .= '<option value="'.$f['codubi'].'">'.$f['nomubi'].'</option>';
							
					}
				}
			$txt .= '</select>';

				$txt .= '<label>Municipio</label>';
				$txt .= '<div id="reloadMun">';
					$txt .= '<select name="codubi" class="form-control" required disabled>';
						$txt .= '<option value=0>Seleccione Departamento</option>';
					if($dtusu){
						$txt .= '<option value="'.$f['codubi'].'" selected >'.$dtusu[0]['nomubi'].'</option>';
					}
					$txt .= '</select>';
				$txt .= '</div>';
			
			$txt .= '<label>E-mail del Usuario</label>';
			$txt .= '<input type="email" name="emausu" maxlength="100" class="form-control"';
				if($idusu && $dtusu) $txt .= ' value="'.$dtusu[0]['emausu'].'"';
				$txt .= ' required />';

			$txt .= '<label>Contraseña del Usuario</label>';
			$txt .= '<input type="password" name="pasusu" class="form-control"';
			if ($arc=="home.php") 
				$txt .= '>';
			else
				$txt .=' required>';

			$txt .= '<label>Genero del Usuario</label>';
			$txt .= '<select name="sexo" class="form-control" required>';
					//$txt .= '<option value="0">Seleccione sexo</option>';
					if($gene){
						foreach ($gene as $f) {
							$txt .= '<option value="'.$f['codval'].'"';
								if ($gene && $idusu && $f['codval']==$dtusu[0]['sexo']) $txt .= " selected ";							
							$txt .= '>'.$f['nomval'].'</option>';
						}
					}	
					$txt .= '</select>';	

			/*$txt .= '<label>Imagen del Usuario</label>';
			$txt .= '<input type="text" name="imgus" maxlength="120" class="form-control"';
				if($idusu && $dtusu) $txt .= ' value="'.$dtusu[0]['imgus'].'"';
				$txt .= '/>';*/

			$txt .= '<input type="hidden" name="opera" value="InsAct">';
				$txt .= '<div class="cen">';
					$txt .= '<input type="submit" class="btn btn-primary" value="';
					if($idusu && $dtusu)
						$txt .= 'Actualizar';
					else
						$txt .= 'Registrar';
					$txt .= '">';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
		$txt .= '<br><br><br>';
		echo $txt;
	}

//Mostrar datos


	function mosdatos($conp,$nreg,$pg,$arc,$filtro,$bo){
		$musu = new musu();
		$pa = new mpagina($nreg);
		
		$txt = '';
		$txt .= '<div align="center">';
			$txt .= '<table><tr>';

//Filtro de busqueda
				$txt .= '<td>';
					$txt .= '<form name="frmfil" method="POST" action="'.$arc.'">';
						$txt .= '<input type="text" name="filtro" value="'.$filtro.'" class="form-control" placeholder="Busqueda" onChange="this.form.submit();" />';
						$txt .= '<input type="hidden" name="pg" value="'.$pg.'" />';
					$txt .= '</form>';
				$txt .= '</td>';

//Paginación parte 2
				$txt .= '<td>';
					$bo = '<input type="hidden" name="filtro" value="'.$filtro.'" />';
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					$result = $musu->selusu($filtro, $pa->rvalini(), $pa->rvalfin());
				$txt .= '</td>';
			$txt .= '</tr></table>';
		$txt .= '</div>';

		if($result){
			$txt .= '<table class="table table-hover">';
				$txt .= '<tr>';
					$txt .= '<th class="success" width="100px">Imagen</th>';
					$txt .= '<th class="success">Usuarios</th>';
					$txt .= '<th class="success"></th>';
					$txt .= '<th class="success"></th>';
				$txt .= '</tr>';

				foreach ($result as $dt) {
					$txt .= '<tr>';
							$txt .= '<td class="active" width="100px">';
							if($dt['imgus']) $txt .= '<img src="'.$dt['imgus'].'" width="100px">';
						$txt .= '</td>';
						$txt .= '<td class="active">';
							$txt .= '<big><strong>';
								$txt .= $dt['idusu'].' - '.$dt['nomusu'].' '.$dt['apeusu'];
							$txt .= '</strong></big><br>';
							$txt .= '<small>';
								$txt .= '<strong>Direccion: </strong>';
								$txt .= $dt['dirusu']." / ".$dt['nomubi'].'<br>';
								$txt .= '<strong>Telefono: </strong>';
								$txt .= $dt['telusu'].'<br>';
								$txt .= '<strong>E-mail: </strong>';
								$txt .= $dt['emausu'].'<br>';
								$txt .= '<strong>Perfil: </strong>';
								$txt .= $dt['pefnom'].'<br>';						
								$txt .= '<strong>Sexo: </strong>';
								$txt .= $dt['nomval'].'<br>';
								$txt .= '<strong>Imagen: </strong>';
								$txt .= $dt['imgus'].'<br>';
							$txt .= '</small>';
						$txt .= '</td>';

						// <i class="far fa-file-pdf"></i>
						// <i class="fas fa-print"></i>
						$txt .= '<td colspan="4">';
							$txt .= '<a href="vusupdf.php" "tarjet="blank">';
								$txt .= '<i class="fas fa-print fa-2x"></i>';
							$txt .= '</a>';
							$txt .= '<a href="vusupdf.php" "tarjet="blank">';						
								$txt .= '<button>';
									$txt .= '<i class="far fa-file-pdf fa-2x"></i>';
								$txt .= '</button>';
							$txt .= '</a>';
						$txt .= '</td>';
						$txt .= '<td class="active">';


							$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Elim&idusu='.$dt['idusu'].'" onclick="return eliminar();">';
								$txt .= '<i class="fas fa-trash-alt fa-2x"></i>';
							$txt .= '</a>';
							$txt .= '<br><br>';
							$txt .= '<a href="'.$arc.'?pg='.$pg.'&idusu='.$dt['idusu'].'">';
								$txt .= '<i class="fas fa-edit fa-2x"></i>';
							$txt .= '</a>';
							$txt .= '<br><br>';
							if($dt['actusu']==1){
								$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=ActuOK&actusu=2&idusu='.$dt['idusu'].'">';
									$txt .= '<i class="fas fa-user fa-2x"></i>';
								$txt .= '</a>';
							}else{
								$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=ActuOK&actusu=1&idusu='.$dt['idusu'].'">';
								$txt .= '<i class="fas fa-user-slash fa-2x"></i></i>';
								$txt .= '</a>';
							}

						$txt .= '</td>';
					$txt .= '</tr>';
				}
			$txt .= '</table>';
		}else{
			$txt .= '<h3>No existen datos para mostrar</h3>';
		}
		$txt .= '<br><br><br><br><br><br>';

		echo $txt;
	}
?>