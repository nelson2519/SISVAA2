<?php
include("../Class/config.php");
$session_uid = '';
$_SESSION['idDocumento'] = '';

if (empty($session_uid) && empty($_SESSION['idDocumento'])) {
	$url = BASE_URL.'/autentificacion.php';
	header("Location: $url");
	//echo "<script>window.location='$url'</script>";
}
?>