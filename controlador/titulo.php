<?php
function tit($ti,$ic,$arc,$pg,$alto,$tipo=1){
    $txt = '';
    if($tipo==1)
        $tx = 'Nuevo';
    else
        $tx = 'Nueva';
    $txt .= '<div>';
        $txt .= '<h2>'.$ti.'</h2>';
        $txt .= '<button id="mos" class="btn btn-dark" onclick="ocultar(1,\''.$alto.'\');" title="'.$tx.' '.$ti.'">';
            $txt .= '<i class="'.$ic.'"></i>';
            //$txt .= 'Nuevo';
        $txt .= '</button>';
        $txt .= '<a href="'.$arc.'?pg='.$pg.'" id="ocu">';
            $txt .= '<input type="button" id="ocu" class="btn-close" title="Cerrar">';
        $txt .= '</a>';
    $txt .= '</div>';
    return $txt;
}

function sbtit($ti,$ic,$arc,$pg,$alto,$cdvl,$tipo=1){
    $txt = '';
    $txt .= '<div>';
        $txt .= '<h2>'.$ti.'</h2>';
        /*$txt .= '<button id="mos'.$cdvl.'" class="btn btn-dark mos" onclick="ocudt(1,\''.$alto.'\',\''.$cdvl.'\');" title="'.$ti.'">';
            $txt .= '<i class="'.$ic.'"></i>';
        $txt .= '</button>';*/
        $txt .= '<button id="ocu'.$cdvl.'" class="btn-close ocu" onclick="ocudt(2,\'0px\',\''.$cdvl.'\');" title="Cerrar">';
            //$txt .= '<i class="'.$ic.'"></i>';
        $txt .= '</button>';
    $txt .= '</div>';
    return $txt;
}
?>