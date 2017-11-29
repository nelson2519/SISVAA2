<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$u = new profesionClass();
$id = $_GET['idprofesion'];

if (!isset($_GET["idprofesion"]) or !is_numeric($_GET["idprofesion"])) {
	die("Error 404");
}

$datos = $u->profesionDatosId($_GET["idprofesion"]);

if (sizeof($datos)<1) {
	die("Error 404");
}

$u->eliminarDatos($_GET["idprofesion"]);

$url = BASE_URL.'/html/registroprofesion.php';
header("location: $url");
?>