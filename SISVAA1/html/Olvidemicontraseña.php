<?php

	include("../Class/config.php");
	include("../Class/loginClass.php");
	include("../Class/encrypt.php");

	$encrypt = new encrypt();
	$loginClass = new loginClass();

	$errorMsgLogin = '';
	
if (!empty($_POST['restablecerpwd'])){

	$tipo_documento = $_POST['tipo_documento'];
	$idDocumento = $_POST['idDocumento'];

	$consul = $loginClass-> restablecerpwd($tipo_documento,$idDocumento);

	if ($consul) {
		$para = $consul->correo;
		$idDocumento = $consul->idDocumento;
		$data = $encrypt->encriptado($idDocumento);
		$asunto = 'Restablecer Contrasena SISVAA';
		$mensaje = ' Estimado usuario: 

					
						Usted ha solicitado el restablecimiento de su contraseña en SOFIA PLUS.
						
						Para ingresar una nueva contraseña haga clic en el siguiente enlace:
						
						http://localhost/sisvaa/html/cambiarContrasena.php?ps='.$data.'
						*******************NO RESPONDER - Mensaje Generado Automáticamente*******************
						
						Este correo es únicamente informativo y es de uso exclusivo del 
						destinatario(a), puede contener información privilegiada y/o 
						confidencial. Si no es usted el destinatario(a) deberá borrarlo 
						inmediatamente. Queda notificado que el mal uso, divulgación no 
						autorizada, alteración y/o  modificación malintencionada sobre este 
						mensaje y sus anexos quedan estrictamente prohibidos y pueden ser 
						legalmente sancionados. -El SENA  no asume ninguna responsabilidad por 
						estas circunstancias';
		//$mensaje = wordwrap($mensaje, 70, "\r\n");

		$cabecera = 'MIME-Version'."\r\n";
		$cabecera .= 'Content_type: text/html; charset=iso-8859-1'. "\r\n";

		$cabecera .= 'To:'.$para."\r\n";
		//$cabecera .= 'From: Recordatorio<cesarcifuenteshlf@gmail.com>'."\r\n";


		if (mail($para, $asunto, $mensaje, $cabecera)) {
		 	$errorMsgLogin = 'Se envio con éxito';
		 }else{
		 	$errorMsgLogin = 'No se envio con éxito';
		 }
		

	}else{
		$errorMsgLogin = 'Los datos son incorrectos';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>¿Olvide mi contraseña</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/SISVAA/CSS/style.css">
	<link rel="stylesheet" href="/SISVAA/CSS/bootstrap.css">
</head>
<body>
<div class="well" style="margin: 10px">
	<div style="width: 100%; text-align: center;">
		<label>
			<h4>Seleccione y escriba el tipo y número de su documento de identidad</h4> 
		</label> 
	</div>
		
	
	<tr><td>
	<form method="post">
		<h5 align="center">Tipo de Documento: </h5>
		<select class="form-control" name="tipo_documento" required="true">
			<option value="">Seleccione</option>
		    <option value="CC">Cédula de Ciudadanía</option>
		    <option value="TI">Tarjeta de Identidad</option>
		    <option value="CE">Cédula de Extranjería</option>
		    <option value="DNI">Documento Nacional de Identificación</option>
		</select>
		<h5 align="center">Número de Documento: </h5>
		<input class="form-control" type="text" name="idDocumento" autocomplete="off" required="true"><br><br>
		<div style="text-align: center;">
			<input class="botoningreso" type="submit" name="restablecerpwd" value="Restablecer contraseña">
		</div>
	</form>
	</td></tr>
</table>
</div>
<div>
	<?php echo $errorMsgLogin; ?>
</div>
</body>
</html>