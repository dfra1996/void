<?php
function errorauth(){
	$error = isset($_GET['error']) ? $_GET['error']:NULL;
	if($error=="ok"){
		$txt = '<div>';
			$txt .= 'Datos incorrectos.';
		$txt .= '</div>';
		echo $txt;
	}
}
?>