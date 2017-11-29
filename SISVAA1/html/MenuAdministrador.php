<?php

include("../Class/Config.php"); 

$genero = BASE_URL. "/html/registrogenero.php";
$Tipodocumento = BASE_URL. "/html/registrotipodocument.php";
$cargo = BASE_URL. "/html/registrocargo.php";
$Profesion = BASE_URL. "/html/registroprofesion.php";
$rol = BASE_URL. "/html/registrorol.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Menú Administrador</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/SISVAA/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="/SISVAA/CSS/bootstrap.css">
	<style>
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd; 
}

div.panel {
    padding: 0 18px;
    display: none;
    background-color: white;
    border: 2px solid #eee;
}
</style>
</head>
<body>

<h1>Menú</h1>

<button class="accordion">Usuario</button>
<div class="panel">
	<button class="accordion">Tablas</button>
	<div class="panel">
		<div>
			<a href="<?php echo $genero ?>" target="cont"><h5>Género</h5></a>
			<a href="<?php echo $Tipodocumento ?>" target="cont"><h5>Tipo Documento</h5></a>
			<a href="<?php echo $cargo ?>" target="cont"><h5>Cargo</h5></a>
			<a href="<?php echo $Profesion ?>" target="cont"><h5>Profesión</h5></a>
			<a href="<?php echo $rol ?>" target="cont"><h5>Rol</h5></a>
		</div>
	</div>
	<form>
		<button class="accordion1" type="submit" formaction="<?php echo BASE_URL; ?>/html/personaData.php" formtarget="cont">Usuarios</button>	
	</form>
	
</div>

<button class="accordion">Ambiente</button>
<div class="panel">
  <button class="accordion">Tablas</button>
	<div class="panel">
		<div>
			<a href=""><h5>Regional</h5></a>
			<a href=""><h5>Centro de Formación</h5></a>
			<a href=""><h5>Sede</h5></a>
		</div>
	</div>
	<button class="accordion">Ambiente</button>
</div>

<button class="accordion">Ficha</button>
<div class="panel">
  <button class="accordion">Tablas</button>
	<div class="panel">
		<div>
			<a href=""><h5>Programa</h5></a>
			<a href=""><h5>Jornada</h5></a>
		</div>
	</div>
	<button class="accordion">Ficha</button>
</div>

<button class="accordion">Lista de Chequeo</button>
<div class="panel">
  <button class="accordion">Tablas</button>
	<div class="panel">
		<div>
			<a href=""><h5>Factores de Verificación</h5></a>
		</div>
	</div>
	<button class="accordion">Lista</button>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    }
}
</script>

</body>
</html>