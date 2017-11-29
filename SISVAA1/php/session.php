<?php
if (!empty($_SESSION['idDocumento'])) {
	$session_id = $_SESSION['idDocumento'];
	include('../Class/loginClass.php');
	$personaClass = new loginClass();
}
if (empty($session_id)) {
	$url= BASE_URL.'/autentificacion.php';
	header("Location:$url");
}
?>