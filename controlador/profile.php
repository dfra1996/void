<?php
require_once 'model/conexion.php';
require_once 'model/Profile.php';

$pg = 1001;
$arc = "home.php";
$Profile = new Profile();

$pefid = isset($_POST['pefid']) ? $_POST['pefid']:NULL;
if(!$pefid)
	$pefid = isset($_GET['pefid']) ? $_GET['pefid']:NULL;

$pefnom = isset($_POST['pefnom']) ? $_POST['pefnom']:NULL;
$pagprin = isset($_POST['pagprin']) ? $_POST['pagprin']:NULL;

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;
echo "<br>Opera: ".$opera;
echo "<br>pefnom: ".$pefnom;
echo "<br>pagprin: ".$pagprin;

if($opera=="insert"){
    if($pefnom && $pagprin){
        $Profile->insert($pefid, $pefnom, $pagprin);
        echo "<script>alert('Datos insertados exitosamente');</script>";
        echo '<script>window.location="home.php?pg='.$pg.'";</script>';
    }else{
        echo "<script>alert('Falta llenar algunos campos');</script>";
    }
    $pefid = "";
}



function update($pg, $arc){
    $txt = "";
    $txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
        $txt .= "<input type='text' name='pefnom' placeholder='Nombre de perfil'>";
        $txt .= "<input type='text' name='pagprin' placeholder='Pagina de inicio'>";
        $txt .= "<input type='submit' value='Guardar'>";
        $txt .= '<input type="hidden" name="opera" value="insert">';
    $txt .= "</form>";
    
    echo $txt;

}
function read(){
    $Profile = new Profile();
	$result = $Profile->list();
    $txt = "";
    if($result){
        foreach ($result as $dt) {
            $txt .= $dt['pefnom'];
        }  
    echo $txt;      
    }

}

?>