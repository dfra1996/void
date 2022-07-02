<?php require_once("model/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>VOID</title>
<body>
	<header>
		<?php 
			$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
			$idprofile = isset($_SESSION["idprofile"]) ? $_SESSION["idprofile"]:NULL;
			if(!$idprofile){
				echo "id de perfil vacio";
			}
			include ("view/cabe.php");
		?>			
	</header>
	<!-- Section Menu Interno -->
	<section>
		<?php
			$idprofile = isset($_SESSION["idprofile"]) ? $_SESSION["idprofile"]:NULL;
			include("view/vmen.php");
		?>		
	</section>

	<!-- Contenido -->
	<section><?php 
		moscon($idprofile,$pg);
	?></section>
	<footer>
		<?php include ("view/pie.php"); ?>
	</footer>
</body>
</html>