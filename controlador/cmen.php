<?php
require_once('model/conexion.php');
require_once('model/mmen.php');

function mosmen($pagmen, $pefid){
	$mmen = new mmen();
	$result = $mmen->selmen($pagmen, $pefid);
	$pm = strtolower($pagmen);
	$idusu = isset($_SESSION["idusu"]) ? $_SESSION["idusu"]:NULL;

	// Llamado Datos Usuario
	$dt = $mmen->selus($idusu);

	// Validar que trae la variable
	//var_dump ($dt[0]['imgus']);

	// Asignar 0 a valor Null para que no salgan errores
	//if($dt[0]['imgus']==NULL) $dt[0]['imgus'] = 0;

	$txt = '';
	if($result){
		$txt .= '<div class="container">';
			$txt .= '<ul id="gn-menu" class="gn-menu-main">';
				$txt .= '<li class="gn-trigger">';
					$txt .= '<a class="gn-icon gn-icon-menu"><span>Menú</span></a>';
					$txt .= '<nav class="gn-menu-wrapper">';
					$txt .= '<div class="gn-scroller">';
					$txt .= '<ul class="gn-menu">';

					// Foto Menu
					$txt .= '<li>';
						$txt .= '<img src="'.$dt[0]['imgus'].'" class="img-pef" alt="No se encuentra la imagen">';
					$txt .= '</li>';

						foreach ($result as $f) {
							$txt .= '<li ';
							if($f['pagarc']=="#Espacio")
								$txt .= 'class="fonmtit"';
							$txt .= '>';
							if($f['pagarc']=="#Espacio"){
								$txt .= '<i class="'.$f['icono'].' ajico"></i>';
								$txt .= '<strong> '.$f['pagnom'].'</strong>';
							}else{
								$txt .= '<a href="'.$pm.'.php?pg='.$f['pagid'].'">';
									$txt .= '<i class="'.$f['icono'].' ajico"></i>';
									$txt .= ' <span>'.$f["pagnom"].'</span>';
								$txt .= '</a>';
							}
							$txt .= '</li>';
						}
					$txt .= '</ul>';
					$txt .= '</div>';
					$txt .= '</nav>';
				$txt .= '</li>';
				$txt .= '<li style="padding-left: 17px;padding-top: 6px;">';
					$txt .= '<strong><big>Bienvenido, '.$_SESSION["nomusu"].'</big></strong>';
				$txt .= '</li>';
				$txt .= '<li class="smen">';
					$txt .= '<a href="'.$pm.'.php?pg=1070">';
						$txt .= '<i class="fas fa-sign-out-alt fa-2x ico" style="vertical-align: middle;"></i>';
						$txt .= ' <span style="vertical-align: middle;">Salir</span>';
					$txt .= '</a>';
				$txt .= '</li>';
			$txt .= '</ul>';
		$txt .= '</div>';
		echo $txt;
	}

	function moscon($pefid,$pg){
		$mmen = new mmen();
		$datpgpf = $mmen->selpgpf($pefid);

		if($pefid)
			if(!$pg) $pg = $datpgpf[0]['pagprin'];
		else
			if(!$pg) $pg = 5555;

		$result = $mmen->selpgact($pg, $pefid);
		if($result){
			foreach ($result as $f) {
				require_once($f['pagarc']);
			}
		}else{
			$txt = "<div>";
				$txt .= "Usted no tiene permisos para ver esta página. Comuniquese con su administrador.";
			$txt .= "</div>";
			echo $txt;
		}
	}
}
?>