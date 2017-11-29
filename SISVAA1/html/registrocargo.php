<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$tip = new cargoClass();

$cargo = $tip->cargoDatos();

if (!empty($_POST["recargo"])) {
	$idnom = $_POST["idcargo"];
		
	$cargo = $tip->cargoRegistro( $idnom);
	
	$url = BASE_URL. '/html/registrocargo.php';
	header("location: $url");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro Cargo</title>
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
				<h1>Tabla Cargo</h1>
			</div>
			<div class="container" style="width: 100%">
				<input type="text" name="idcargo" placeholder="Cargo" class="form-control" required="true">
			</div>
			<div class="container container1" style="width: 100%">
				<input type="submit" name="recargo" value="Registrar" class="btn btn-primary">
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
					Cargo
				</th>
				<th>
					Acción
				</th>
				</tr>
			</thead>
			<tbody>
				<?php

					foreach ($cargo as $key) {
					?>
					<tr>
					<td>
						<?php echo $key->idcargo ?>
					</td>
					<td>
						<?php echo $key->cargo ?>
					</td>
					<td>
						<a href="javascript:void(0);" onclick="eliminar('/sisvaa/php/eliminarcargo.php?idcargo=<?php echo $key->idcargo ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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