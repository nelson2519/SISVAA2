<?php 

session_start();
require_once 'class.user.php'; 
$user_login = new USER(); 
 
if($user_login->is_logged_in()!="") 
{  
	$user_login->redirect('home.php'); 
} 
 
if(isset($_POST['btn-login'])) 
{  
	$email = trim($_POST['txtemail']);  
	$upass = trim($_POST['txtupass']);    

	if($user_login->login($email,$upass))  
	{   
		$user_login->redirect('home.php');  
	} 
} 
?> 
 
<!DOCTYPE html> 
<html>   
<head>     
<title>Inicio de Sesion</title>     
<!-- Bootstrap -->     
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">     
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">     
<link href="assets/styles.css" rel="stylesheet" media="screen">      
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->    
<!--[if lt IE 9]>       
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>     
<![endif]-->     
<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>   
</head>   
<body id="login">     
<div class="container">   
		<?php  
	if(isset($_GET['inactive']))   
		{    
			?>             
			<div class='alert alert-error'>     
				<button class='close' data-dismiss='alert'>&times;</button>     
				<strong>Sorry!</strong>          Esta cuenta no está activada Vaya a su Bandeja de entrada y activarla.       
			</div>             
			<?php   
			}   
			?>         

			<form class="form-signin" method="post">         
			<?php         
			if(isset($_GET['error']))   
				{    
					?>             
			<div class='alert alert-success'>     
				<button class='close' data-dismiss='alert'>&times;</button>     
				<strong>¡Detalles erroneos!</strong>     
			</div>             
			<?php   
			}   
			?>         

			<h2 class="form-signin-heading">Iniciar Sesion</h2><hr />         
			<input type="email" class="input-block-level" placeholder="Ingresa Email" name="txtemail" required />   <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />     <hr />         
			<button class="btn btn-large btn-primary" type="submit" name="btn-login">iniciar Sesion</button>        <a href="signup.php" style="float:right;" class="btn btn-large">Registrate</a><hr />         
			<a href="fpass.php">¿Olvidaste la Contraseña? </a></form> 
</div> <!-- /container -->     
<script src="bootstrap/js/jquery-1.9.1.min.js"></script>     
<script src="bootstrap/js/bootstrap.min.js"></script>   
</body> 
</html> 