<?php
include('../class/config.php');
include('../php/session.php');

$persona = $personaClass->personaDetalle($session_id);

if ($persona->rol == "Administrador") {
	$url = BASE_URL.'/html/MenuAdministrador.php';
}elseif ($persona->rol == 'Instructor') {
	$url = BASE_URL.'/html/MenuInstructor.php';
}

$usuario = $persona ->nombre.' '. $persona ->nombre1.' '. $persona ->apellido.' '. $persona ->apellido1.' ';
?>


<!DOCTYPE HTML>
<html>
<head>
	<title>SISVAA</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/SISVAA/CSS/style.css">
	<link rel="stylesheet" href="/SISVAA/CSS/bootstrap.css">
	
</head>
<body>

	<div class="headsisvaa">
		<div>
			<table class="headtab">
				<tr class="headtr">
					<td width="70px">
						<img src="<?php echo BASE_URL; ?>/css/Imagenes/logoSena.png" width="60px">
					</td>
					<td width="200px" align="center">
					<div class="headdiv">
						<h4><?php echo $persona->rol; ?></h4>
					</div>					
					</td>
					<td width="100%" align="center">
						<h4><?php echo $usuario; ?></h4>
					</td>
					<td width="200px" align="center">
					<div width="200px">
						<a href="<?php echo BASE_URL; ?>/html/cambiarContrasena.php?pd=<?php echo $persona->idDocumento ?>&url=/css/Imagenes/logoSena.png" target="cont"><h4>Cambio de contraseña</h4></a>
					</div>
						
					</td>
					<td width="100px" align="center">
					<div class="headdiv">
						<a href="<?php echo BASE_URL; ?>/php/logout.php"><h4>Salir</h4></a>
					</div>					
					</td>
				</tr>
				<tr>
					<td colspan="4" align="left">
						<h6 class="headh6"><?php echo VERSION; ?></h6>
					</td>
				</tr>
			</table>
		</div>
		<div class="menu">
			<div class="menu1">
				<div class="menu2">
					<iframe class="menuadmin" src="<?php echo $url; ?>"></iframe>
				</div>				
			</div>				
		</div>
		<div class="contenido">
		<background-image: url("../css/Imagenes/clase.jpg");
		background-size: 100vw 100VH;>
			<div class="contenido1">
				<div class="contenido2">
					<iframe src="" name="cont" class="contenidoadmin"></iframe>
				</div>
			</div>			
		</div>	
	</div>
</body >
</html>