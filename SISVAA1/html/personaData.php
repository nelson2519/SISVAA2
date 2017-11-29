<?php

include("../Class/config.php");
include("../class/personaclass.php");

$usuario = new personaClass();
$u = $usuario->personaDatos();

?>
<!DOCTYPE html>
<html>
<head>
	<title>  Listado Usuarios </title>
	<meta charset="utf-8">
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
<div class="container1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php

			if (isset($_GET["m"])) {
				switch (isset($_GET["m"])) {
					case '1':
						?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							El registro se ha ingresado exitósamente
						</div>
					<?php
						break;
					case '2':
					?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							El registro se ha actualizado exitósamente
						</div>
					<?php
						break;
					case '3':
					?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
							 El registro ha sido eliminado exitósamente
						</div>
					<?php
						break;
				}
			}
			?>
			<h3>Lista de Usuarios</h3>
		</div>
		<div class="panel-body" class="thperson">
			<p>
				<a href="registro.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar 
				</a>
			</p>
			<table class="table table-bordered">
				<thead style= "text-align: center">
					<tr class="info" >
						<th>Tipo Doc</th>
						<th>Documento</th>
						<th>Primer Nombre</th>
						<th>Segundo Nombre</th>
						<th>Primer Apellido</th>
						<th>Segundo Apellido</th>
						<!--<th>Sexo</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Correo</th>-->
						<!--<th>Profesion</th>-->
						<th>Rol</th>
						<!--<th>Cargo</th>-->
						<!--<th>Contraseña</th>-->
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($u as $dato) {
						?>
						<tr>
							<td><?php echo $dato->tipo_documento ?></td>
							<td><?php echo $dato->idDocumento ?></td>
							<td><?php echo $dato->nombre ?></td>
							<td><?php echo $dato->nombre1 ?></td>
							<td><?php echo $dato->apellido ?></td>
							<td><?php echo $dato->apellido1 ?></td>
							<!--<td><?php echo $dato->genero ?></td>
							<td><?php echo $dato->direccion ?></td>
							<td><?php echo $dato->telefono ?></td>
							<td><?php echo $dato->correo ?></td>-->
							<!--<td><?php echo $dato->profesion ?></td>-->
							<td><?php echo $dato->rol ?></td>
							<!--<td><?php echo $dato->cargo ?></td>-->
							<!--<td><?php echo $dato->contrasena ?></td>-->
							<td><?php echo $dato->estado ?></td>
							<td>
								<a href="editarpersona.php?idDocumento=<?php echo $dato->idDocumento ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>

								<a href="javascript:void(0);" onclick="eliminar('/sisvaa/php/eliminarpersona.php?idDocumento=<?php echo $dato->idDocumento ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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
</div>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/funciones.js"></script>
</body>
</html>