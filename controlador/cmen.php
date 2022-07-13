<?php
require_once('model/conexion.php');
require_once('model/mmen.php');

function mosmen($pagmen, $pefid){	
	$mmen = new mmen();
	$result = $mmen->selmen($pagmen, $pefid);
	$pm = strtolower($pagmen);
	$iduser = isset($_SESSION["iduser"]) ? $_SESSION["iduser"]:NULL;
	// Llamado Datos Usuario
	$dt = $mmen->selus($iduser);
	/*if(!$pefid){
		echo "id de perfil vacio";
	}*/
	// Validar que trae la variable
	//var_dump ($dt[0]['imgus']);

	// Asignar 0 a valor Null para que no salgan errores
	//if($dt[0]['imgus']==NULL) $dt[0]['imgus'] = 0;
	$txt = '';
	
	if($result){
		$txt .='<div class="wrapper">';
			/* TODO SIDE BAR LEFT INI*/
			$txt .='<div class="leftside-menu">';
				/*TODO LOGO*/
				$txt .='<a href="home.php" class="logo text-center logo-light">';
					$txt .='<span class="logo-lg">';
						$txt .='<img src="assets/images/logo.png" alt="" height="16">';
					$txt .='</span>';
					$txt .='<span class="logo-sm">';
						$txt .='<img src="assets/images/logo_sm.png" alt="" height="16">';
					$txt .='</span>';
				$txt .='</a>';
				/*TODO LOGO FIN*/
				$txt .='<div class="h-100" id="leftside-menu-container" data-simplebar="">';
		
					$txt .='<ul class="side-nav">';
						foreach ($result as $f) {
							if($f['pagarc']=="#Espacio"){
								$txt .='<li class="side-nav-title side-nav-item">'.$f['pagnom'].'</li>';
							}else{								
								$txt .='<li class="side-nav-item">';
									$txt .='<a href="'.$pm.'.php?pg='.$f['pagid'].'" class="side-nav-link">';
										$txt .='<i class="'.$f['icono'].'"></i>';
									$txt .='<span>'.$f["pagnom"].'</span>';
									$txt .='</a>';
								$txt .='</li>';
							}
						}							                     
						$txt .='</ul>';
						
				$txt .='</div>';
				$txt .='<div class="content-page">';
					$txt .='<div class="content">';
						$txt .='<div class="navbar-custom">';

							$txt .= '<ul class="list-unstyled topbar-menu float-end mb-0">';         
							$txt .= '<li class="dropdown notification-list">';
								$txt .= '<a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">';
									$txt .= '<span class="account-user-avatar">'; 
										$txt .= '<img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">';
									$txt .= '</span>';
									$txt .= '<span>';
										$txt .= '<span class="account-user-name">'.$_SESSION["name"].'</span>';
										$txt .= '<span class="account-position">Founder</span>';
									$txt .= '</span>';
								$txt .= '</a>';
								$txt .= '<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">';

									$txt .= '<div class=" dropdown-header noti-title">';
										$txt .= '<h6 class="text-overflow m-0">Hola!</h6>';
									$txt .= '</div>';

									$txt .= '<a href="javascript:void(0);" class="dropdown-item notify-item">';
									$txt .= '<i class="mdi mdi-account-circle me-1"></i>';
										$txt .= '<span>My Account</span>';
									$txt .= '</a>';

									$txt .= '<a href="javascript:void(0);" class="dropdown-item notify-item">';
										$txt .= '<i class="mdi mdi-account-edit me-1"></i>';
										$txt .= '<span>Settings</span>';
									$txt .= '</a>';
								$txt .= '</div>';
							$txt .= '</li>';
							$txt .= '</ul>';
							$txt .= '<button class="button-menu-mobile open-left">';
								$txt .= '<i class="mdi mdi-menu"></i>';
							$txt .= '</button>';
				
						$txt .='</div>';
					$txt .='</div>';
				$txt .='</div>';
			$txt .='</div>';
			/* TODO SIDE BAR LEFT END*/
		$txt .='</div>';
		
		$txt .= '<div class="container">';
			$txt .= '<ul id="gn-menu" class="gn-menu-main">';
				$txt .= '<li class="gn-trigger">';
					$txt .= '<a class="gn-icon gn-icon-menu"><span>Menú</span></a>';
					$txt .= '<nav class="gn-menu-wrapper">';
					$txt .= '<div class="gn-scroller">';
					$txt .= '<ul class="gn-menu">';

					// Foto Menu
					/*$txt .= '<li>';
						$txt .= '<img src="'.$dt[0]['imgus'].'" class="img-pef" alt="No se encuentra la imagen">';
					$txt .= '</li>';*/

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
					$txt .= '<strong><big>Bienvenido, '.$_SESSION["name"].'</big></strong>';
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
			if(!$pg) $pg = 	$datpgpf[0]['pagprin'];
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