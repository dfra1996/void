<?php 
require_once 'model/conexion.php';
require_once 'model/mpag.php';
require_once 'model/mpagina.php';

$pg = 302;
$arc = "home.php";
$mpag = new mpag();

$pagid = isset($_POST['pagid']) ? $_POST['pagid']:NULL;
if(!$pagid)
	$pagid = isset($_GET['pagid']) ? $_GET['pagid']:NULL;
$pagnom = isset($_POST['pagnom']) ? $_POST['pagnom']:NULL;
$pagarc = isset($_POST['pagarc']) ? $_POST['pagarc']:NULL;
$pagmos = isset($_POST['pagmos']) ? $_POST['pagmos']:NULL;
if(!$pagmos)
	$pagmos = isset($_GET['pagmos']) ? $_GET['pagmos']:NULL;
$pagord = isset($_POST['pagord']) ? $_POST['pagord']:NULL;
$pagmen = isset($_POST['pagmen']) ? $_POST['pagmen']:NULL;
$icono = isset($_POST['icono']) ? $_POST['icono']:NULL;


$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL;
if(!$filtro)
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;


//Insertar o Actualizar
//echo "<br>".$opera."-".$pagid."-".$pagnom."-".$pagarc."-".$pagmos."-".$pagord."-".$pagmen."-".$icono."<br>";
if($opera=="InsAct"){
	if($pagnom && $pagarc && $pagmos && $pagord && $pagmen && $icono){
		$mpag->pagiu($pagid,$pagnom,$pagarc,$pagmos,$pagord,$pagmen,$icono);
		echo "<script>alert('Datos insertados y/o actualizados exitosamente');</script>";
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$pagid = "";
}
if($opera=="ActuOK"){
	if($pagid && $pagmos)
		$mpag->act($pagid,$pagmos);
	$pagid = "";
}

//Eliminar
if($opera=="Elim"){
	if($pagid){
		$mpag->pagdel($pagid);
		echo "<script>alert('Datos eliminados exitosamente');</script>";
	}
	$pagid = "";
}

if($pagid){
	$GLOBALS['nu'] = 1;
	$GLOBALS['alto'] = "502px";
}

//Paginacion
$bo = "";
$nreg = 30;
$pa = new mpagina();
$preg = $pa->mpagin($nreg);
$conp = $mpag->sqlcount($filtro);

function insdatos($pagid,$pg,$arc){
	$mpag = new mpag();
	$idpagper = $mpag->selpper();
	if($pagid) $dtpag = $mpag->selpag1($pagid);
	$txt = '';
	$txt .= '<div class="conte">';
		$txt .= tit("Página","fas fa-copy ico3",$arc,$pg,"502px",2);
		$txt .= '<div id="inser">';
			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				$txt .= '<label>Código</label>';
				$txt .= '<input type="number" name="pagid" class="form-control" ';
				if($pagid && $dtpag) $txt .= ' readonly value="'.$pagid.'"';
				$txt .=	'>';
				$txt .= '<label>Nombre</label>';
				$txt .= '<input type="text" name="pagnom" class="form-control"';
				if($pagid && $dtpag) $txt .= 'value="'.$dtpag[0]['pagnom'].'"';
				$txt .=	'>';

				$txt .= '<label>Archivo</label>';
				$txt .= '<input type="text" name="pagarc" class="form-control"';
				if($pagid && $dtpag) $txt .= 'value="'.$dtpag[0]['pagarc'].'"';
				$txt .=	'>';
				
				$txt .= '<label>Mostrar</label>';
				$txt .= '<select name="pagmos" class="form-control">';
					$txt .= '<option value="1"';
						if($pagid and $dtpag[0]['pagmos']==1){ $txt .= " selected "; }
					$txt .= '>Si</option>';
					$txt .= '<option value="2"';
						if($pagid and $dtpag[0]['pagmos']<>1){ $txt .= " selected "; }
					$txt .= '>No</option>';
				$txt .= '</select>';

				$txt .= '<label>Menu</label>';
				$txt .= '<select name="pagmen" class="form-control">';
					$txt .= '<option value="Home"';
						if($pagid and $dtpag[0]['pagmen']=="Home"){ $txt .= " selected "; }
					$txt .= '>Home</option>';
					$txt .= '<option value="Index"';
						if($pagid and $dtpag[0]['pagmen']=="Index"){ $txt .= " selected "; }
					$txt .= '>Index</option>';
				$txt .= '</select>';
				
				$txt .= '<label>Orden</label>';
				$txt .= '<input type="number" min="0" max="500" name="pagord" class="form-control"';
				if($pagid && $dtpag) $txt .= 'value="'.$dtpag[0]['pagord'].'"';
				$txt .=	'>';

				$txt .= '<label>Icono</label>';
				$txt .= '<input type="text" name="icono" class="form-control"';
				if($pagid && $dtpag) $txt .= 'value="'.$dtpag[0]['icono'].'"';
				$txt .=	'>';

				$txt .= '<input type="hidden" name="opera" value="InsAct">';
				$txt .= '<div class="cen">';
					$txt .= '<input type="submit" class="btn btn-secondary" value="';
					if($pagid AND $dtpag)
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

function mosdatos($conp,$nreg,$pg,$arc,$filtro,$bo){
	$mpag = new mpag();
	$pa = new mpagina($nreg);
	$txt = '';
	$txt .= '<div align="center">';
		//Filtro de busqueda
		$txt .= '<div class="filt">';
			$txt .= '<form name="frmfil" method="POST" action="'.$arc.'">';
				$txt .= '<input type="text" name="filtro" value="'.$filtro.'" class="form-control" placeholder="Buscar Página" onChange="this.form.submit();" />';
				$txt .= '<input type="hidden" name="pg" value="'.$pg.'" />';
			$txt .= '</form>';
		$txt .= '</div>';
		//Paginacion parte 2
		$txt .= '<div class="filt">';
			$bo = '<input type="hidden" name="filtro" value="'.$filtro.'">';
			$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
			$result = $mpag->selpag($filtro, $pa->rvalini(), $pa->rvalfin());
		$txt .= '</div>';
	$txt .= '</div>';

	$txt .= '<div class="contdat">';
	if($result){
		$txt .= '<table class="table table-hover">';
			$txt .= '<tr>';
				//$txt .= '<th class="success" align="center">Ico.</th>';
				$txt .= '<th class="success">Nombre</th>';
				$txt .= '<th class="success"></th>';
				$txt .= '<th class="success"></th>';
			$txt .= '</tr>';

			foreach ($result as $dt) {
				$txt .= '<tr>';
					/*$txt .= '<td class="active">';
						$txt .= '<i class="'.$dt['icono'].' " style="text-shadow: 0px 0px 4px #000;"></i>';
					$txt .= '</td>';*/
					$txt .= '<td class="active">';						
						$txt .= '<big><strong>';
							$txt.=$dt['pagid']."  ".$dt['pagnom'];
							$txt .= ' <i class="'.$dt['icono'].' " style="text-shadow: 0px 0px 4px #000;"></i><br>';
							$txt .= '</strong></big>';
						$txt.=$dt['pagarc'].'<br>';
						$txt.= '<small><small><strong>Menú:</strong> '. $dt['pagmen'];
						$txt.= '<br><strong>Icono:</strong> '.$dt['icono']."</small></small>";
					$txt .= '</td>';

					$txt .= '<td class="active" align="center">';
						if($dt['pagmos']==1){
							$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=ActuOK&pagmos=2&pagid='.$dt['pagid'].'">';
								$txt .= '<i class="fas fa-check-circle ico2"></i>';
							$txt .= '</a>';
						}else{
							$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=ActuOK&pagmos=1&pagid='.$dt['pagid'].'">';
								$txt .= '<i class="fas fa-times-circle ico1"></i>';
							$txt .= '</a>';
						}
						$txt.= "<br>".$dt['pagord'];
					$txt .= '</td>';
					$txt .= '<td class="active">';
						$txt.= '<a href="'.$arc.'?pg='.$pg.'&opera=Elim&pagid='.$dt['pagid'].'" onclick="return eliminar();">';
							$txt.= '<i class="fas fa-trash-alt fa-2x "></i>';
						$txt.= '</a>';
					$txt .= '<br><br>';
						$txt.= '<a href="'.$arc.'?pg='.$pg.'&pagid='.$dt['pagid'].'">';
							$txt.= '<i class="fas fa-edit fa-2x "></i>';
						$txt.= '</a>';
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