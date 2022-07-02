<?php
require_once 'model/conexion.php';
require_once 'model/mprofile.php';

$pg = 1001;
$arc = "home.php";

function read(){
    $mprofile = new mprofile();
	$result = $mprofile->list();
    $txt = "";
    if($result){
        foreach ($result as $dt) {
            $txt .= $dt['pefnom'];
        }  
    echo $txt;      
    }

}

?>