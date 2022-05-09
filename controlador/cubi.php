<?php
require_once 'model/conexion.php';
require_once 'model/mubi.php';
require_once 'model/mpagina.php';

$pg = 310;
$arc = "home.php";
$mubi = new mubi();

$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
if(!$codubi){
	$codubi = isset($_GET['codubi']) ? $_GET['codubi']:NULL;
}
$nomubi = isset($_POST['nomubi']) ? $_POST['nomubi']:NULL;
$depubi = isset($_POST['depubi']) ? $_POST['depubi']:NULL;

$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL;
if(!$filtro){
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
}

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera){
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;
}

//echo "<br><br>".$codubi."-".$nomubi."-".$depubi."-".$filtro."<br><br>";

//Insertar o Actualizar
if($opera=="InsAct"){
	if($codubi && $nomubi && $depubi){
		$mubi->ubiiu($codubi, $nomubi, $depubi);
		echo "<script>alert('Datos insertados y/o actualizados exitosamente');</script>";
		$codubi = NULL;
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
}

//Eliminar
if($opera=="Elim"){
	if($codubi){
		$mubi->ubidel($codubi);
		echo "<script>alert('Datos eliminados exitosamente');</script>";
	}
	$codubi = NULL;
}
//Edición cargar ventana oculta
if($codubi){
	$GLOBALS['nu'] = 1;
	$GLOBALS['alto'] = "254px";
}
//Paginacion
$bo = "";
$nreg = 50;
$pa = new mpagina();
$preg = $pa->mpagin($nreg);
$conp = $mubi->sqlcount($filtro);

function insdatos($codubi,$pg,$arc){
	$mubi = new mubi();
	$datdep = $mubi->selubi2();
	if($codubi) $dtubi = $mubi->selubi1($codubi);

	$txt = '';
	$txt .= '<div class="conte">';
		$txt .= tit("Ubicación","fas fa-map-marker-alt ico3",$arc,$pg,"254px",2);
		$txt .= '<div id="inser">';
			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				$txt .= '<label>Codigo</label>';
				$txt .= '<input type="number" name="codubi" value="'.$codubi.'" class="form-control" />';
				
				$txt .= '<label>Departamento o Municipio</label>';
				$txt .= '<input type="text" name="nomubi" maxlength="70" class="form-control"';
					if($codubi and $dtubi) $txt .= ' value="'.$dtubi[0]['Nom'].'"';
				$txt .= ' required />';
				$txt .= '<label>Departamento depende</label>';
				if($datdep){
					$txt .= '<select name="depubi" class="form-control">';
					foreach ($datdep as $ddp) {
						$txt .= '<option value="'.$ddp['codubi'].'" ';
						if($codubi && $dtubi && $dtubi[0]['Dep']==$ddp['codubi']) $txt .= ' selected ';
						$txt .= '>';
							$txt .= $ddp['codubi'].'   -   '.$ddp['nomubi'];
						$txt .= '</option>';
					}
					$txt .= '</select>';
				}
				$txt .= '<input type="hidden" name="opera" value="InsAct">';
				$txt .= '<div class="cen">';
					$txt .= '<input type="submit" class="btn btn-primary" value="';
					if($codubi and $dtubi)
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
	$mubi = new mubi();
	$pa = new mpagina($nreg);
	$datdep = $mubi->selubi2();
	$txt = '';

	$txt .= '<div align="center">';
		//Filtro de busqueda
		$txt .= '<div class="filt">';
			$txt .= '<form name="frmfil" method="POST" action="'.$arc.'">';
				$txt .= '<input type="text" name="filtro" value="'.$filtro.'" class="form-control" placeholder="Buscar Código o Municipio" onChange="this.form.submit();" />';
				$txt .= '<input type="hidden" name="pg" value="'.$pg.'" />';
			$txt .= '</form>';
		$txt .= '</div>';
		//Paginacion parte 2
		$txt .= '<div class="filt">';
			$bo = '<input type="hidden" name="filtro" value="'.$filtro.'" />';
			$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
			$result = $mubi->selubi($filtro, $pa->rvalini(), $pa->rvalfin());
		$txt .= '</div>';
	$txt .= '</div>';

	$txt .= '<div class="contdat">';
	if($result){
		$txt .= '<table class="table table-hover">';
			$txt .= '<tr>';
				$txt .= '<th class="dark">Ubicaciones</th>';
				$txt .= '<th class="dark"></th>';
			$txt .= '</tr>';
			foreach ($result as $dt) {
				$txt .= '<tr>';
					$txt .= '<td class="succes">';
						$txt .= '<big><strong>';
							$txt .= $dt['codubi'].' - '.$dt['Nom'];
						$txt .= '</strong></big><br>';
						$txt .= '<small>';
							$txt .= '<strong>Depto: </strong>';
							$txt .= $dt['nDp'].'<br>';
						$txt .= '</small>';
					$txt .= '</td>';
					$txt .= '<td class="succes">';
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Elim&codubi='.$dt['codubi'].'" onclick="return eliminar();">';
						$txt .= '<i class="fas fa-trash-alt fa-2x "></i>';
						$txt .= '</a>';
						$txt .= '<br><br>';
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&codubi='.$dt['codubi'].'">';
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