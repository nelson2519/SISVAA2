<?php

include("../Class/config.php");
include("../Class/loginClass.php");
include("../Class/encrypt.php");

$loginClass = new loginClass();
$encrypt = new encrypt();

if (isset($_GET['ps'])) {
	$data = $_GET['ps'];
	
	$idDocumento = $encrypt->desencriptar($data);
	
	$count = $loginClass->confirmaid($idDocumento);
			
	if ($count) {
		$n=1;
		$url = '/autentificacion.php';
	}else {
		echo 'Error en la informacion 1';
	}	
}else if (isset($_GET['pd'])) {
	$data = $_GET['pd'];
	$url = $_GET['url'];

	$count = $loginClass->confirmaid($data);
			
	if ($count) {
		$n=1;
		
	}else {
		echo 'Error en la informacion 2';
	}	
}else {
	$n=2;
}



if (!empty($_POST['restablecerpwd'])) {
	$cont = $_POST['contrasena'];
	$cont1 = $_POST['contrasena1'];

	if ($cont == $cont1) {
		$contrasena = $encrypt->encriptado($cont);
		
		$restablecer = $loginClass->cambioContrasena($data, $contrasena);
		if ($restablecer) {
			$url = BASE_URL.$url;
      		header("Location: $url");
		}else {
			$n=2;
		}
		
	}else {
	echo 'La Contraseña no coincide, intente nuevamente';
	$n=1;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>..::Restablecer contraseña::..</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/SISVAA/CSS/style.css">
	<link rel="stylesheet" href="/SISVAA/CSS/bootstrap.css">
</head>
<body>
<div class="well" style="margin: 10px">
	<div style="width: 100%; text-align: center;">
		<?php
			switch ($n) {
				case '1':
					?>
					<div>
						<form method="post">
							<h5 align="center">Nueva contraseña: </h5>
							<input class="form-control" type="password" name="contrasena" required="true"><br><br>
							<h5 align="center">Confirme contraseña: </h5>
							<input class="form-control" type="password" name="contrasena1" required="true"><br><br>
							<div style="text-align: center;">
								<input class="botoningreso" type="submit" name="restablecerpwd" value="Restablecer contraseña">
							</div>
						</form>
					</div>
					<?php
					break;
				case '2':
				?>
					<div>
						<form method="post">
							<h5>Hay un problema para restablecer la contraseña</h5>
							<h5>por favor comuniquese con el administrador</h5>
							<div style="text-align: center;">
								<input class="botoningreso" type="submit" name="errorrestablecer" value="Volver al inicio">
							</div>
						</form>
					</div>
					<?php
					break;
			}
		?>
	</div>
</div>
</body>
</html>