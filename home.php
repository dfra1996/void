<?php require_once("model/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="SisteDVN Sistema de ventas, intentario y prestamos" name="description">
	<meta content="SisteDVN" name="Duvan Robayo">
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- third party css -->
	<link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
	<!-- third party css end -->

	<!-- App css -->
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
	<link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

	<title>SisteDVN</title>
<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

	<header>
		<?php 
			$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
			$idprofile = isset($_SESSION["idprofile"]) ? $_SESSION["idprofile"]:NULL;
			if(!$idprofile){
				echo "id de perfil vacio";
			}
			//include ("view/cabe.php");
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
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>

	<!-- third party js -->
	<script src="assets/js/vendor/apexcharts.min.js"></script>
	<script src="assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
	<!-- third party js ends -->

	<!-- demo app -->
	<script src="assets/js/pages/demo.dashboard.js"></script>
	<!-- end demo js-->
</body>
</html>