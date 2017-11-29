<?php

include("../Class/config.php");
include("../Class/personaClass.php");

$u = new tipdocumentClass();
$id = $_GET['idTipDocumento'];

if (!isset($_GET["idTipDocumento"])) {
	die("Error 404");

}

$datos = $u->TipDocumentDatosId($_GET["idTipDocumento"]);

if (sizeof($datos)<1) {
	die("Error 404");

}

$u->eliminarDatos($_GET["idTipDocumento"]);

$url = BASE_URL.'/html/registrotipodocument.php';
header("location: $url");
?>