<?php

include("Class/config.php");
include("class/loginClass.php");
include("Class/encrypt.php");


$personaClass = new loginClass();
$encrypt = new encrypt();

$errorMsgLogin = '';

/* formulario login*/
if (!empty($_POST['loginSubmitAdmin'])) {
  $tipo_documento = $_POST['tipo_documento'];
  $idDocumento = $_POST['idDocumento'];
  $contrasena = $_POST['password'];
  $rol = 'Administrador';
  
    $hash_contrasena = $encrypt->encriptado($contrasena);
    $consul = $personaClass->personalogin($tipo_documento, $idDocumento, $hash_contrasena, $rol);

    if ($consul) {

      $url = BASE_URL.'/html/menu.php';
      header("Location: $url");

    }else{
      $errorMsgLogin = "Datos incorrectos";
    }
}

if (!empty($_POST['loginSubmitInst'])) {
  $tipo_documento = $_POST['tipo_documento'];
  $idDocumento = $_POST['idDocumento'];
  $contrasena = $_POST['password'];
  $rol = 'Instructor';
  
    $hash_contrasena = $encrypt->encriptado($contrasena);
    $consul = $personaClass->personalogin($tipo_documento, $idDocumento, $hash_contrasena, $rol);

    if ($consul) {
      
      $url = BASE_URL.'/php/menu.php';
      header("Location: $url");

    }else{
      $errorMsgLogin = "Datos incorrectos";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Inicio SISVAA</title>
<meta charset="utf-8">
<link rel="stylesheet" href="/SISVAA/CSS/style.css">
 <link rel="stylesheet" href="/SISVAA/CSS/bootstrap.min.css">
<style>

button.accordion {
    background-color: #5eb319;
    color: #fff;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    border: none;
    text-align: center;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #469C00; 
}

div.panel {
    padding: 8px;
    display: none;
    background-color: white;
}
</style>
</head>
<body background="../SISVAA/css/Imagenes/sena.JPG">
<table class="ingresotab">
<tr><td>
<div>
    <h3>  Sistema de Verificación Ambientes de Aprendizaje  </h3>
    <h2>SISVAA</h2>
</div>

<button class="accordion" name="butonadmin">Administrador</button>
<div class="panel" >
  <div class="menu2" style="overflow: auto;">
    <form action="" method="post">
        <div class="well" style="margin-top: 10px">
        <h3>Ingreso <small>Usuarios Registrados</small></h3>
        <h4>Tipo de Documento</h4>
        <select class="form-control" name="tipo_documento" required="true">
          <option value="">Seleccione</option>
          <option value="CC">Cédula de Ciudadanía</option>
          <option value="TI">Tarjeta de Identidad</option>
          <option value="CE">Cédula de Extranjería</option>
          <option value="DNI">Documento Nacional de Identificación</option>
        </select>
        
        <div class="form-group">
          <h4>Número de Documento: </h4>
          <input type="text" class="form-control" id="usuario" placeholder="Ingrese usuario" name="idDocumento" autocomplete="off" required="true">
        </div>
        <div class="form-group">
          <h4>Contraseña: </h4>
          <input type="password" class="form-control" placeholder="Ingrese contraseña" name="password" autocomplete="off" required="true">
        </div>
        <div class="form-group" align="center">
          <a href="login/fpass.php">¿Olvide mi contraseña?</a><br>
          <!--<a href="">¿Su usuario está bloqueado?</a>-->
        </div>
        <div align="center ">
          <input type="submit" name="loginSubmitAdmin" >
        </div>
        </div>
      </form>
  </div>
</div>
<button class="accordion">Intructor</button>
<div class="panel">
  <div class="menu2" style="overflow: auto;">
      <form action="" method="post">
        <div class="well" style="margin-top: 10px">
        <h3>Ingreso <small>Usuarios Registrados</small></h3>
        <h4>Tipo de Documento</h4>
        <select class="form-control" name="tipo_documento">
          <option value="">Seleccione</option>
          <option value="CC">Cédula de Ciudadanía</option>
          <option value="TI">Tarjeta de Identidad</option>
          <option value="CE">Cédula de Extranjería</option>
          <option value="DNI">Documento Nacional de Identificación</option>
        </select>
       
        <div class="form-group">
          <h4>Número de Documento: </h4>
          <input type="text" class="form-control" id="usuario" placeholder="Ingrese usuario" name="idDocumento" autocomplete="off" required="true">
        </div>
        <div class="form-group">
          <h4>Contraseña: </h4>
          <input type="password" class="form-control" placeholder="Ingrese contraseña" name="password" autocomplete="off" required="true">
        </div>
        <div class="form-group" align="center">
          <a href="login/fpass.php">¿Olvide mi contraseña?</a><br>
          <!--<a href="">¿Su usuario está bloqueado?</a>-->
        </div>
        <div align="center ">
          <input type="submit" name="loginSubmitInst" >
        </div>
         </div> 
      </form>
  </div>
</div>
</td></tr>
</table>
<center>
<h2 style="background-color:tomato"><div class="errorMsg" >
  <?php echo $errorMsgLogin; ?>
</div></h2>
</center>
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
