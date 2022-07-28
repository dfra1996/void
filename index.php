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
</head>
<body>
	
	<header>
	<?php 
		$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
		$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"]:NULL;
		include ("view/cabe.php");
		?>			
	</header>
	<!-- Contenido -->
	<section>
		<?php 
			if($pg=="200" OR !$pg)
				include ("view/vini.php");
			/*elseif($pg=="201")
		 		include ("view/vreg.php"); 
			elseif($pg=="105")
		 		include ("view/vmail.php");
			elseif($pg=="110")
		 		include ("view/vcc.php");*/?>
	</section>
	<footer>
		<?php include ("view/pie.php"); ?>
	</footer>
</body>
</html>