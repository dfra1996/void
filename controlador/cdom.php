<?php
require_once 'model/conexion.php';
require_once 'model/mdom.php';


$pg = 309;
$arc = "home.php";
$mdom = new mdom();

$iddom = isset($_POST['iddom']) ? $_POST['iddom']:NULL;
if(!$iddom)
	$iddom = isset($_GET['iddom']) ? $_GET['iddom']:NULL;
$nomdom = isset($_POST['nomdom']) ? $_POST['nomdom']:NULL;
$pardom = isset($_POST['pardom']) ? $_POST['pardom']:NULL;
$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL;
if(!$filtro)
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

//echo "<br><br><br>".$iddom."-".$nomdom."-".$pardom."-".$filtro."-".$opera."<br><br>";
//Insertar
if($opera=="InsAct"){
	if($nomdom){
		$mdom->domver($iddom, $nomdom, $pardom);
		echo "<script>alert('Datos insertados y/o actualizados existosamente');</script>";
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$iddom = "";
}

//Eliminar
if($opera=="Eliminar"){
	if($iddom){
		$mdom->deldom($iddom);
		echo "<script>alert('Datos eliminados existosamente');</script>";
	}
	$iddom = "";
}

//Edición cargar ventana oculta
if($iddom){
	$GLOBALS['nu'] = 1;
	$GLOBALS['alto'] = "254px";
}
//Paginación parte 1
$bo = "";
$nreg = 50;
$pa = new mpagina();
$preg = $pa->mpagin($nreg);
$conp = $mdom->sqlcount($filtro);

//Insertar datos
function insdatos($iddom,$pg,$arc){
	$mdom = new mdom();
	$dtdom = NULL;
	if($iddom) $dtdom = $mdom->seldom1($iddom);
	$txt = '';
	$txt .= '<div class="conte">';
		$txt .= tit("Dominio","fas fa-thermometer-full ico3",$arc,$pg,"192px");
		$txt .= '<div id="inser">';
			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				if($iddom and $dtdom){
					$txt .= '<label>Id</label>';
					$txt .= '<input type="text" name="iddom" readonly value="'.$iddom.'" class="form-control" />';
				}
				$txt .= '<label>Dominio</label>';
				$txt .= '<input type="text" name="nomdom" maxlength="70" class="form-control"';
					if($iddom and $dtdom) $txt .= ' value="'.$dtdom[0]['nomdom'].'"';
				$txt .= ' required />';
				$txt .= '<label>Parametro</label>';
				$txt .= '<input type="text" name="pardom" maxlength="50" class="form-control"';
					if($iddom and $dtdom) $txt .= ' value="'.$dtdom[0]['pardom'].'"';
				$txt .= ' />';

				$txt .= '<input type="hidden" name="opera" value="InsAct">';
				$txt .= '<div class="cen">';
					$txt .= '<input type="submit" class="btn btn-secondary" value="';
					if($iddom and $dtdom)
						$txt .= 'Actualizar';
					else
						$txt .= 'Registrar';
					$txt .= '">';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';

	echo $txt;
}


//Mostrar datos
function mosdatos($conp,$nreg,$pg,$arc,$filtro,$bo){
	$mdom = new mdom();
	$pa = new mpagina($nreg);

	$txt = '';

	$txt .= '<div align="center">';
		//Filtro de busqueda
		$txt .= '<div class="filt">';
			$txt .= '<form name="frmfil" method="POST" action="'.$arc.'">';
				$txt .= '<input type="text" name="filtro" value="'.$filtro.'" class="form-control" placeholder="Buscar Dominio" onChange="this.form.submit();" />';
				$txt .= '<input type="hidden" name="pg" value="'.$pg.'" />';
			$txt .= '</form>';
		$txt .= '</div>';
		//Paginacion parte 2
		$txt .= '<div class="filt">';
			$bo = '<input type="hidden" name="filtro" value="'.$filtro.'" />';
			$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
			$result = $mdom->seldom($filtro, $pa->rvalini(), $pa->rvalfin());
		$txt .= '</div>';
	$txt .= '</div>';

	$txt .= '<div class="contdat">';
	if($result){
		$txt .= '<table class="table table-hover">';
			$txt .= '<tr>';
				$txt .= '<th class="dark">Dominio</th>';
				$txt .= '<th class="dark"></th>';
			$txt .= '</tr>';
			foreach ($result as $dt) {
				$txt .= '<tr>';
					$txt .= '<td class="succes">';
						$txt .= '<big><strong>';
							$txt .= $dt['iddom'].'. '.$dt['nomdom'];
						$txt .= '</strong></big><br>';
						$txt .= '<small>';
							$txt .= '<strong>Parametros: </strong>'.$dt['pardom'];
						$txt .= '</small>';
					$txt .= '</td>';
					$txt .= '<td class="succes">';
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Eliminar&iddom='.$dt['iddom'].'" onclick="return eliminar();">';
						$txt .= '<i class="fas fa-trash-alt fa-2x "></i>';
						$txt .= '</a>';
						$txt .= '<br><br>';
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&iddom='.$dt['iddom'].'">';
							$txt .= '<i class="fas fa-edit fa-2x "></i>';
						$txt .= '</a>';
					$txt .= '</td>';
				$txt .= '</tr>';
			}
		$txt .= '</table>';
	}else{
		$txt .= '<h4>No existen datos para mostrar</h4>';
	}
	$txt .= '</div>';
	echo $txt;
}
?>