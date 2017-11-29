<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$tip = new tipdocumentClass();

$tipdocument = $tip->tipdocumentDatos();

if (!empty($_POST["tipdocument"])) {
	$idnom = $_POST["idtdocument"];
	$nom = $_POST["tdocument"];
	
	$tipdocument = $tip->tipdocumentRegistro( $idnom, $nom);
	
	$url = BASE_URL. '/html/registrotipodocument.php';
	header("location: $url");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro Tipo Documento</title>
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
				<h1>Tabla Tipo Documento</h1>
			</div>
			<div class="container" style="width: 100%">
				<input type="text" name="idtdocument" placeholder="Identificador" class="form-control" required="true">
			</div>
			<div class="container" style="width: 100%">
				<input type="text" name="tdocument" placeholder="Tipo de Documento" class="form-control" required="true">
			</div>
			<div class="container container1" style="width: 100%">
				<input type="submit" name="tipdocument" value="Registrar" class="btn btn-primary">
			</div>			
		</form>
	</div>
	<div class="well container" style="width: 100%">
		<table class="table table-bordered" style="width: 100%">
			<thead>
				<tr>
				<th>Identicador</th>
				<th>Tipo de Documento</th>
				<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php

					foreach ($tipdocument as $key) {
					?>
					<tr>
					<td>
						<?php echo $key->idTipDocumento ?>
					</td>
					<td>
						<?php echo $key->tipdocument ?>
					</td>
					<td>
						<a href="javascript:void(0);" onclick="eliminar('/sisvaa/php/eliminarTipDocument.php?idTipDocumento=<?php echo $key->idTipDocumento ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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