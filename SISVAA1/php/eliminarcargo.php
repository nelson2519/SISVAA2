<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$u = new cargoClass();
$id = $_GET['idcargo'];

if (!isset($_GET["idcargo"]) or !is_numeric($_GET["idcargo"])) {
	die("Error 404");
}

$datos = $u->cargoDatosId($_GET["idcargo"]);

if (sizeof($datos)<1) {
	die("Error 404");
}

$u->eliminarDatos($_GET["idcargo"]);

$url = BASE_URL.'/html/registrocargo.php';
header("location: $url");
?>