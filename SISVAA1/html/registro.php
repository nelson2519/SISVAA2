<?php
include("../Class/config.php");
include("../class/personaClass.php");

$personaClass = new personaClass();

$cargoClass = new cargoClass();
$datocargo = $cargoClass->cargoDatos();

$generoClass = new generoClass();
$datogenero = $generoClass->generoDatos();

$profesionClass = new profesionClass();
$datoprofesion = $profesionClass->profesionDatos();

$rolClass = new rolClass();
$datorol = $rolClass->rolDatos();

$tipdocumentClass = new tipdocumentClass();
$datotipdocument = $tipdocumentClass->tipdocumentDatos();

$errorMsgReg = '';

/* ACtion buton registro*/
if (!empty($_POST['crearRegistro'])) {

	$tipo_documento = $_POST['tipo_documento'];
	$idDocumento = $_POST['idDocumento'];
	$nombre = $_POST['nombre'];
	$nombre1 = $_POST['nombre1'];
	$apellido = $_POST['apellido'];
	$apellido1 = $_POST['apellido1'];
	$genero = $_POST['genero'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$profesion = $_POST['profesion'];
	$rol = $_POST['rol'];
	$cargo = $_POST['cargo'];
	$contrasena = $_POST['contrasena'];

	if (empty($_POST['estado'])) {
		$estado = 'Inactivo';
	}else{
		$estado = 'Activo';
	}

	/* verifica que esten todos los datos*/
	$idDocumento = $personaClass-> personaRegistro($tipo_documento, $idDocumento, $nombre, $nombre1, $apellido, $apellido1, $genero, $direccion, $telefono, $correo, $profesion, $rol, $cargo, $contrasena, $estado);
	if ($idDocumento) {
		$url =  BASE_URL.'/html/personaData.php';
		header("location: $url?m=1");

	}else {
		$errorMsgReg = "Usuario ya registrado";
	}
}

?>
<!DOCTYPE html>
<head>
	<title>Formulario Usuario</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/SISVAA/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
</head>
<body>
	<div style="padding-right: 50px">
		<div style="padding: 20px">
			<div class="well">
				
					<?php
					if (!empty($errorMsgReg)) {
						?>
						<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">x</button>
						<?php
						echo $errorMsgReg;
						?>
						</div>
						<?php
						}					
					?>
				
				<form method="post">
					<div align="center" style="border: 2px solid #eee; border-radius: 4px">
						<label><h3>Usuario</h3></label>
					</div>
					<div style="padding-top: 20px; width: 100%; ">
						<div>
						<TABLE class="tableperson">
							<TR>
							<TH class="thperson">
							<label>Tipo de Documento :  </label>   
							<select class="form-control" name="tipo_documento" required="true">
								<option value="">Seleccione</option>
						        <?php foreach ($datotipdocument as $key) { ?>
						        	<option value="<?php echo $key->idTipDocumento;  ?>"><?php echo $key->tipdocument;  ?></option>
						        	<?php
						        } ?>
							</select>
							</TH>
							<TH class="thperson">
							<label>Número de Documento :  </label>   
							<input class="form-control" type="text" name="idDocumento" required="true">
							</TH>
							</TR>
						</TABLE>
						</div>
						<div>
						<TABLE class="tableperson">
							<TR>
							<TH class="thperson">
							<label>Primer Nombre :  </label>   
							<input class="form-control" type="text" name="nombre" required="true">
							</TH>
							<TH class="thperson">
							<label>Segundo Nombre :  </label>   
							<input class="form-control" type="text" name="nombre1" >
							</TH>
							</TR>
						</TABLE>
						</div>
						<div>
						<TABLE class="tableperson">
							<TR>
							<TH class="thperson">
							<label>Primer Apellido :  </label>   
							<input class="form-control" type="text" name="apellido" required="true">
							</TH>
							<TH class="thperson">
							<label>Segundo Apellido :  </label>   
							<input class="form-control" type="text" name="apellido1" >
							</TH>
							</TR>
						</TABLE>
						</div>
						<div>
						<TABLE class="tableperson">
							<TR>
							<TH class="thperson">
							<label>Género :  </label>   
							<select class="form-control" name="genero" required="true">
								<option value="">Seleccione</option>
						        <?php foreach ($datogenero as $key) { ?>
						        	<option value="<?php echo $key->idGenero;  ?>"><?php echo $key->genero;  ?></option>
						        	<?php
						        } ?>
							</select>
							<label>Teléfono Fijo o Celular :  </label>   
							<input class="form-control" type="text" name="telefono" required="true">
							</TH>
							<TH class="thperson">
							<label>Dirección :  </label>   
							<input class="form-control" type="text" name="direccion" required="true">
							<label>Correo :  </label>   
							<input class="form-control" type="email" name="correo" required="true">
							</TH>
							</TR>
						</TABLE>
						</div>						
						<div>
						<TABLE class="tableperson">
							<TR>
							<TH class="thperson">
							<label>Profesión :  </label>   
							<select class="form-control" name="profesion" required="true">
								<option value="">Seleccione</option>
						        <?php foreach ($datoprofesion as $key) { ?>
						        	<option value="<?php echo $key->idprofesion;  ?>"><?php echo $key->profesión;  ?></option>
						        	<?php
						        } ?>
							</select>
							<label>Cargo :  </label>
							<select class="form-control" name="cargo" required="true">
								<option value="">Seleccione</option>
						        <?php foreach ($datocargo as $key) { ?>
						        	<option value="<?php echo $key->idcargo;  ?>"><?php echo $key->cargo;  ?></option>
						        	<?php
						        } ?>
							</select>
							</TH>
							<TH class="thperson">
							<label>Rol : </label>   
							<select class="form-control" name="rol" required="true">
								<option value="">Seleccione</option>
						        <?php foreach ($datorol as $key) { ?>
						        	<option value="<?php echo $key->idrol;  ?>"><?php echo $key->rol;  ?></option>
						        	<?php
						        } ?>
							</select>
							<label>Contraseña :  </label>
							<input class="form-control usuario" type="password" name="contrasena" required="true">
							</TH>
							</TR>
						</TABLE>
						</div>
						<div class="checkbox" align="center">
							<input type="checkbox" name="estado" value="1"> <label>  Activo </label>
						</div>
						<div class="well" align="center">
							<div class="btn-group">
								<input type="submit" class="btn btn-primary" name="crearRegistro" value="Crear">
								<input type="reset" class="btn btn-primary" value="Borrar">
								<input type="button" class="btn btn-primary" value="Salir" onclick="redirect('<?php echo BASE_URL;?>/html/personaData.php');">
							</div>
						</div>												
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/funciones.js"></script>
</body>
</html>