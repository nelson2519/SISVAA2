<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$u = new personaClass();
$id = $_GET['idDocumento'];

if (!isset($_GET["idDocumento"]) or !is_numeric($_GET["idDocumento"])) {
	echo $id;
	die("Error 404");
}

$datos = $u->personaDatosId($_GET["idDocumento"]);

if (sizeof($datos)<1) {
	die("Error 404");
}

$u->eliminarDatos($_GET["idDocumento"]);

$url = BASE_URL.'/html/personaData.php';
header("location: $url?m=3");
?>