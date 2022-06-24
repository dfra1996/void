<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>VOID</title>
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