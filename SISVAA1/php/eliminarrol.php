<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$u = new rolClass();
$id = $_GET['idrol'];

if (!isset($_GET["idrol"]) or !is_numeric($_GET["idrol"])) {
	die("Error 404");
}

$datos = $u->rolDatosId($_GET["idrol"]);

if (sizeof($datos)<1) {
	die("Error 404");
}

$u->eliminarDatos($_GET["idrol"]);

$url = BASE_URL.'/html/registrorol.php';
header("location: $url");
?>