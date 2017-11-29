<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$tip = new profesionClass();

$profesion = $tip->profesionDatos();

if (!empty($_POST["reprofesion"])) {
	$idnom = $_POST["idprofesion"];
		
	$profesion = $tip->profesionRegistro( $idnom);
	
	$url = BASE_URL. '/html/registroprofesion.php';
	header("location: $url");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro Profesión</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/SISVAA/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
    <style>
    th, td, tr, h1, h2, h3, h4, h5{
    text-align: center
    </style>
</head>
<body>
	<div>
		
	</div>
<div class="well" style="width: 500px">
	<div style="width: 100%">
		<form method="post" style="width: 100%">
			<div class="container" style="width: 100%">
				<h1>Tabla Profesión</h1>
			</div>
			<div class="container" style="width: 100%">
				<input type="text" name="idprofesion" placeholder="Profesion" class="form-control" required="true">
			</div>
			<div class="container container1" style="width: 100%">
				<input type="submit" name="reprofesion" value="Registrar" class="btn btn-primary">
			</div>			
		</form>
	</div>
	<div class="well container" style="width: 100%">
		<table class="table table-bordered" style="width: 100%">
			<thead>
				<tr>
				<th>
					Identificador
				</th>
				<th>
					Profesión
				</th>
				<th>
					Acción
				</th>
				</tr>
			</thead>
			<tbody>
				<?php

					foreach ($profesion as $key) {
					?>
					<tr>
					<td>
						<?php echo $key->idprofesion ?>
					</td>
					<td>
						<?php echo $key->profesion ?>
					</td>
					<td>
						<a href="javascript:void(0);" onclick="eliminar('/sisvaa/php/eliminarprofesion.php?idprofesion=<?php echo $key->idprofesion ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
					</td>
					</tr>	
					<?php
					}
				?>
							
			</tbody>			
		</table>
	</div>
</div>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/funciones.js"></script>
</body>
</html>