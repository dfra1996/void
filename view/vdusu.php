
<?php
	require_once 'controlador/cusu.php';
	$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu']:NULL;

	insdatos($idusu,"314",$arc);


?>