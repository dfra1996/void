<?php
require_once 'model/conexion.php';
require_once 'model/mpef.php';
require_once 'model/mpagina.php';

$pg = 303;
$arc = "home.php";
$mpef = new mpef();

$pefid = isset($_POST['pefid']) ? $_POST['pefid']:NULL;
if(!$pefid)
	$pefid = isset($_GET['pefid']) ? $_GET['pefid']:NULL;
$pefnom = isset($_POST['pefnom']) ? $_POST['pefnom']:NULL;
$pagprin = isset($_POST['pagprin']) ? $_POST['pagprin']:NULL;
$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL;
if(!$filtro)
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

$pagi[] = isset($_POST['pagi']) ? $_POST['pagi']:NULL;

//echo "<br><br><br>".$pefid."-".$pefnom."-".$pagprin."-".$filtro."-".$opera."<br><br>";
//Insertar
if($opera=="InsAct"){
	if($pefnom && $pagprin){
		$mpef->updpef($pefid, $pefnom, $pagprin);
		echo "<script>alert('Datos insertados exitosamente');</script>";
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$pefid = "";
}

//Insertar PxP
if($opera=="Inspxp"){
	if($pefid){
		$mpef->delpxp($pefid);
		if($pagi and $pagi[0]){
			for ($i=0;$i<count($pagi[0]);$i++) {			
				$mpef->inspxp($pagi[0][$i], $pefid);
			}
		}
	}
	$pefid = "";
}

//Eliminar
if($opera=="Eliminar"){
	if($pefid){
		$mpef->delpef($pefid);
		echo "<script>alert('Datos eliminados exitosamente');</script>";
	}
	$pefid = "";
}

//Edición cargar ventana oculta
if($pefid){
	$GLOBALS['nu'] = 1;
	$GLOBALS['alto'] = "254px";
}

//Paginacion parte 1
$bo = "";
$nreg = 50;
$pa = new mpagina();
$preg = $pa->mpagin($nreg);
$conp = $mpef->sqlcount($filtro);

//Insertar datos
function insdatos($pefid,$pg,$arc){
	$mpef = new mpef();
	$dtpef = NULL;
	$dtpg = $mpef->selpg();
	if($pefid) $dtpef = $mpef->selpef1($pefid);
	$txt = '';
	//require_once 'controlador/titulo.php';
	$txt .= '<div class="conte">';
		//$txt .= tit("Perfil","fas fa-plus ico3",$arc,$pg,"192px");
		$txt .= tit("Perfil","fas fa-users ico3",$arc,$pg,"192px");
		$txt .= '<div id="inser">';
			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				if($pefid AND $dtpef){
					$txt .= '<label>Id</label>';
					$txt .= '<input type="text" name="pefid" readonly value="'.$pefid.'" class="form-control" />';
				}
				$txt .= '<label>Perfil</label>';
				$txt .= '<input type="text" name="pefnom" maxlength="50" class="form-control"';
					if($pefid AND $dtpef) $txt .= ' value="'.$dtpef[0]['pefnom'].'"';
				$txt .= ' required />';
				$txt .= '<label>Pagina Inicial</label>';
				if ($dtpg){
					$txt .= '<select name ="pagprin" class="form-control">';
					foreach ($dtpg as $dpg) {
						$txt .= '<option value="'.$dpg['pagid'].'"';
							if ($pefid AND $dtpef AND $dtpef[0]['pagprin']==$dpg['pagid']) $txt .= " selected ";
						$txt .= '>'; 
							$txt .= $dpg['pagnom']; 
						$txt .= '</option>';
					}
					$txt .= '</select>';
				}

				$txt .= '<input type="hidden" name="opera" value="InsAct">';
				$txt .= '<div class="cen">';
					$txt .= '<input type="submit" class="btn btn-secondary" value="';
					if($pefid AND $dtpef)
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
	$mpef = new mpef();
	$pa = new mpagina($nreg);

	$txt = '';

	$txt .= '<div align="center">';
		//Filtro de busqueda
		$txt .= '<div class="filt">';
			$txt .= '<form name="frmfil" method="POST" action="'.$arc.'">';
				$txt .= '<input type="text" name="filtro" value="'.$filtro.'" class="form-control" placeholder="Buscar Perfil" onChange="this.form.submit();" />';
				$txt .= '<input type="hidden" name="pg" value="'.$pg.'" />';
			$txt .= '</form>';
		$txt .= '</div>';
		//Paginacion parte 2
		$txt .= '<div class="filt">';
			$bo = '<input type="hidden" name="filtro" value="'.$filtro.'" />';
			$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
			$result = $mpef->selpef($filtro, $pa->rvalini(), $pa->rvalfin());
		$txt .= '</div>';
	$txt .= '</div>';

	$txt .= '<div class="contdat">';
	if($result){
		$txt .= '<table class="table table-hover">';
			$txt .= '<tr>';
				$txt .= '<th class="success">Perfil</th>';
							
				$txt .= '<th class="success">Páginas</th>';
			$txt .= '</tr>';
			foreach ($result as $dt) {
				$txt .= '<tr>';
					$txt .= '<td class="active">';
						$txt .= '<big><strong>';
							$txt .= $dt['pefid'].'. '.$dt['pefnom'];
						$txt .= '</strong></big><br>';
						$txt .= '<small>';
							$txt .= '<strong>Pag. Inicial: </strong>';
							$txt .= $dt['pagprin'].' - '.$dt['pagnom'].'&nbsp;&nbsp;';
							$txt .= '<i class="'.$dt['icono'].'" style="text-shadow: 0px 0px 4px #000;"></i> ';
						$txt .= '</small>';
					$txt .= '</td>';	

					$espacio = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
															
					$txt .= '<td class="warning">';
						$txt .= '<button data-bs-toggle="modal" data-bs-target="#myModal'.$dt['pefid'].'" title="Mostrar Páginas">';
							$txt .= '<i class="fas fa-eye fa-2x ic2"></i>';
						$txt .= '</button> ';
						$txt .= modal($dt['pefid'], $dt['pefnom'], $pg);
						$txt .= $espacio;
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Eliminar&pefid='.$dt['pefid'].'" onclick="return eliminar();">';
						$txt .= '<i class="fas fa-trash-alt fa-2x ic2"></i>';
						$txt .= '</a>';
						$txt .= ' ';
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&pefid='.$dt['pefid'].'">';
							$txt .= '<i class="fas fa-edit fa-2x ic2"></i>';
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

function modal($pefid, $pefnom, $pg){
	$txt = '';
	$mpef = new mpef();
	$dtpg = $mpef->selpg();

	$txt .= '<div class="modal" id="myModal'.$pefid.'" tabindex="-1" role="dialog">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h3 class="modal-title">Páginas</h3>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
				$txt .= '</div>';
				$txt .= '<form name="frmpxp" action="home.php?pg='.$pg.'" method="POST">';
					$txt .= '<div class="modal-body">';
						$txt .= '<h5>Perfil: '.$pefnom.'</h5>';
						if($dtpg){
							foreach ($dtpg as $dpg) {
								$dtpxp = $mpef->selpxp($pefid,$dpg['pagid']);
								$txt .= '<div class="dpag';
								if($dpg['pagarc']=="#Espacio") $txt .= " dti";
								$txt .= '">';
									$txt .= '<input type="checkbox" name="pagi[]" value="'.$dpg['pagid'].'" ';
									if($dtpxp) $txt .= ' checked ';
									$txt .= '>';
									$txt .= "&nbsp;&nbsp;&nbsp;".$dpg['pagnom'];
								$txt .= '</div>';
							}
						}
						$txt .= '<input type="hidden" name="opera" value="Inspxp">';
						$txt .= '<input type="hidden" name="pefid" value="'.$pefid.'">';
					$txt .= '</div>';

					$txt .= '<div class="modal-footer">';
						$txt .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
	        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
					$txt .= '</div>';
				$txt .= '</form>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';

	return $txt;
}
?>