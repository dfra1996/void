<?php
require_once 'model/conexion.php';
require_once 'model/musu.php';
require_once 'model/mpagina.php';

$pg = 201;
$arc = "index.php";
$musu = new musu();

$idusu = isset($_POST['idusu']) ? $_POST['idusu']:NULL;
if(!$idusu){
	$idusu = isset($_GET['idusu']) ? $_GET['idusu']:NULL;
}

$nomusu = isset($_POST['nombre']) ? $_POST['nombre']:NULL;
$apeusu = isset($_POST['apellido']) ? $_POST['apellido']:NULL;
$pefid = isset($_POST['pefid']) ? $_POST['pefid']:3;
$dirusu = isset($_POST['direccion']) ? $_POST['direccion']:NULL;
$telusu = isset($_POST['telefono']) ? $_POST['telefono']:NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
$emausu = isset($_POST['correo']) ? $_POST['correo']:NULL;
$pasusu = isset($_POST['password2']) ? $_POST['password2']:NULL;
$genero = isset($_POST['genero']) ? $_POST['genero']:NULL;
$imgus = isset($_POST['imgus']) ? $_POST['imgus']:NULL;

$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL;
if(!$filtro){
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
}

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera){
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;
}
echo "<br><br>".$idusu."-".$nomusu."-".$apeusu."-".$pefid."-".$dirusu."-".$telusu."-".$codubi."-".$emausu."-".$pasusu."-".$genero."-".$imgus."-".$filtro."<br><br>";

//Insertar
	if($opera=="InsAct"){
		if($nomusu){
			$musu->usuiu($idusu, $nomusu, $apeusu, $pefid, $dirusu, $telusu, $codubi, $emausu, $pasusu, $genero, $imgus);
				echo "<script>alert('Te has registrado exitosamente');</script>";
			$idusu = NULL;
		}else{
			echo "<script>alert('Faltan llenar algunos campos');</script>";
		}
	}
	function insdatos($idusu,$pg,$arc){
		$musu = new musu();
		$dtdto = $musu->seldep();		
		$dtpef = $musu->selpef();
		$gene = $musu->selgen();
		$dtusu = NULL;	
		if($idusu) $dtusu = $musu->selusu1($idusu);
		
	

		
		$txt = '';
		$txt .= '<form  class="formulario" id="formulario"  name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				if($idusu && $dtusu){
				$txt .= '<label>Id del Usuario</label>';
				$txt .= '<input type="number" name="idusu" readonly value="'.$idusu.'" class="form-control" required />';
			}
				$txt .= '<!-- Grupo: Nombre -->';
			$txt .= '<div class="formulario__grupo" id="grupo__nombre">';
				$txt .= '<label for="nombre" class="formulario__label">Nombre</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Carlos">';
					$txt .= '<i class="formulario__validacion-estado fas fa-times-circle"></i>';
				$txt .= '</div>';
				$txt .= '<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>';
			$txt .= '</div>';
				$txt .= '<!-- Grupo: Apellido -->';
			$txt .= '<div class="formulario__grupo" id="grupo__apellido">';
				$txt .= '<label for="apellido" class="formulario__label">Apellido</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<input type="text" class="formulario__input" name="apellido" id="apellido" placeholder="Rodriguez">';
					$txt .= '<i class="formulario__validacion-estado fas fa-times-circle"></i>';
				$txt .= '</div>';
				$txt .= '<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>';
			$txt .= '</div>';
			$txt .= '<!-- Grupo: direccion -->';
			$txt .= '<div class="formulario__grupo" id="grupo__direccion">';
				$txt .= '<label for="direccion" class="formulario__label">Direccion</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<input type="text" class="formulario__input" name="direccion" id="direccion" placeholder="Calle 27 d sur # 27 c 51">';
					$txt .= '<i class="formulario__validacion-estado fas fa-times-circle"></i>';
				$txt .= '</div>';
				$txt .= '<p class="formulario__input-error">El campo no debe superar 60 caracteres, no debe incluir caracteres especiales</p>';
			$txt .= '</div>';
			$txt .= '<!-- Grupo: Teléfono -->';
			$txt .= '<div class="formulario__grupo" id="grupo__telefono">';
				$txt .= '<label for="telefono" class="formulario__label">Teléfono</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<input type="text" class="formulario__input" name="telefono" id="telefono" placeholder="4491234567">';
					$txt .= '<i class="formulario__validacion-estado fas fa-times-circle"></i>';
				$txt .= '</div>';
				$txt .= '<p class="formulario__input-error">El telefono solo puede contener numeros y el maximo son 14 dígitos.</p>';
			$txt .= '</div>';	

			$txt .= '<!-- Grupo: Departamento -->';
			$txt .= '<div class="formulario__grupo">';
				$txt .= '<label class="formulario__label">Departamento</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<select name="depto" class="formulario__input" required onChange="javascript:recCiudad(this.value);">';
					//$txt .= '<option value="0">Seleccione Departamento</option>';
					if($dtdto){
						foreach ($dtdto as $f) {
							$txt .= '<option value="'.$f['codubi'].'">'.$f['nomubi'].'</option>';
						}
					}
					$txt .= '</select>';					
				$txt .= '</div>';
			$txt .= '</div>';
			$txt .= '<!-- Grupo: Municipio -->';
			$txt .= '<div class="formulario__grupo">';
				$txt .= '<label class="formulario__label">Municipio</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<div id="reloadMun">';
					$txt .= '<select name="codubi" class="formulario__input" required>';
						//$txt .= '<option value="0">Seleccione Departamento</option>';
					if($dtusu){
						$txt .= '<option value="'.$f['codubi'].'" selected >'.$dtusu[0]['nomubi'].'</option>';
					}
					$txt .= '</select>';
					$txt .= '</div>';		
				$txt .= '</div>';
			$txt .= '</div>';
			$txt .= '<!-- Grupo: Contraseña -->';
			$txt .= '<div class="formulario__grupo" id="grupo__password">';
				$txt .= '<label for="password" class="formulario__label">Contraseña</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<input type="password" class="formulario__input" name="password" id="password">';
					$txt .= '<i class="formulario__validacion-estado fas fa-times-circle"></i>';
				$txt .= '</div>';
				$txt .= '<p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>';
			$txt .= '</div>';

			$txt .= '<!-- Grupo: Contraseña 2 -->';
			$txt .= '<div class="formulario__grupo" id="grupo__password2">';
				$txt .= '<label for="password2" class="formulario__label">Repetir Contraseña</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<input type="password" class="formulario__input" name="password2" id="password2">';
					$txt .= '<i class="formulario__validacion-estado fas fa-times-circle"></i>';
				$txt .= '</div>';
				$txt .= '<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>';
			$txt .= '</div>';

			$txt .= '<!-- Grupo: Genero -->';
			$txt .= '<div class="formulario__grupo">';
				$txt .= '<label class="formulario__label">Genero</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<select name="tipo" class="form-control" required>';
					$txt .= '<option value="0">Seleccione Genero</option>';
					if($gene){
						foreach ($gene as $f) {
							$txt .= '<option value="'.$f['codval'].'"';
								if ($idusu && $gene && $dtusu && $f['codval']==$gene[0]['codval']) $txt .= " selected ";
							$txt .= '>'.$f['nomval'].'</option>';
						}
					}	
					$txt .= '</select>';					
				$txt .= '</div>';
			$txt .= '</div>';
			$txt .= '<!-- Grupo: Correo Electronico -->';
			$txt .= '<div class="formulario__grupo" id="grupo__correo">';
				$txt .= '<label for="correo" class="formulario__label">Correo Electrónico</label>';
				$txt .= '<div class="formulario__grupo-input">';
					$txt .= '<input type="email" class="formulario__input" name="correo" id="correo" placeholder="correo@correo.com">';
					$txt .= '<i class="formulario__validacion-estado fas fa-times-circle"></i>';
				$txt .= '</div>';
				$txt .= '<p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>';
			$txt .= '</div>';


			$txt .= '<input type="hidden" name="opera" value="InsAct">';
				$txt .= '<div class="cen">';
					$txt .= '<input type="submit" class="btn btn-primary" value="';
					if($idusu && $dtusu)
						$txt .= 'Actualizar';
					else
						$txt .= 'Registrar';
					$txt .= '">';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';


		echo $txt;			
	}
?>