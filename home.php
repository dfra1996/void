<?php require_once("model/seguridad.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>VOID</title>
<body>
	<header>
		<?php 
			$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
			$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"]:NULL;
			include ("view/cabe.php");
		?>			
	</header>
	<!-- Section Menu Interno -->
	<section>
		<?php
			$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"]:NULL;
			include("view/vmen.php");
			require_once 'controlador/titulo.php';
		?>		
	</section>

	<!-- Contenido -->
	<section><?php 
		moscon($pefid,$pg);
	?></section>
	<footer>
		<?php include ("view/pie.php"); ?>
	</footer>
</body>
</html>