<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$u = new generoClass();
$id = $_GET['idGenero'];

if (!isset($_GET["idGenero"]) or !is_numeric($_GET["idGenero"])) {
	die("Error 404");
}

$datos = $u->generoDatosId($_GET["idGenero"]);

if (sizeof($datos)<1) {
	die("Error 404");
}

$u->eliminarDatos($_GET["idGenero"]);

$url = BASE_URL.'/html/registrogenero.php';
header("location: $url");
?>