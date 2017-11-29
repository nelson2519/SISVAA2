<?php 
session_start(); 
require_once 'class.user.php'; 
$user = new USER(); 
 
if($user->is_logged_in()!="") 
{  
	$user->redirect('home.php'); 
} 
 
if(isset($_POST['btn-submit'])) 
	{  
		$email = $_POST['txtemail'];    

		$stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");  
		$stmt->execute(array(":email"=>$email));  
		$row = $stmt->fetch(PDO::FETCH_ASSOC);   
		if($stmt->rowCount() == 1)  
			{   
				$id = base64_encode($row['userID']);   
				$code = md5(uniqid(rand()));      
				$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");   
				$stmt->execute(array(":token"=>$code,"email"=>$email));      

				$message= "        

					Hello , $email        
					<br /><br />        
					We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,        
					<br /><br />       
					Haga clic en siguiente vínculo para restablecer su contraseña 
					<br /><br />        
					<a href='http://localhost:8080/Login/resetpass.php?id=$id&code=$code'>Haga clic aquí para restablecer la contraseña</a>                  
					<br /><br />        
					Gracias";   
$subject = "Password Reset";      

$user->send_mail($email,$message,$subject);      

$msg = "<div class='alert alert-success'>      

	<button class='close' data-dismiss='alert'>&times;</button>           

	Hemos enviado un correo electrónico a $email, Por favor, haga clic en el enlace de restablecimiento de contraseña en el correo electrónico para generar una nueva contraseña. </div>";  
	}  
	else  
		{   
		$msg = "<div class='alert alert-danger'>      
			<button class='close' data-dismiss='alert'>&times;</button>     
			<strong>Sorry!</strong>  este correo electrónico no se ha encontrado.</div>";  
	} 
} 
?> 
 
<!DOCTYPE html> 
<html>   
<head>     
<title>se te olvido tu Contraseña</title>     
<!-- Bootstrap -->     
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">     
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">     
<link href="assets/styles.css" rel="stylesheet" media="screen">      
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->     
<!--[if lt IE 9]>       
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>     
<![endif]-->   
</head>   
<body id="login">     
<div class="container"> 
 
      <form class="form-signin" method="post">         
      <h2 class="form-signin-heading">Se te Olvido tu Contraseña!</h2><hr />                   

      	<?php    
      		if(isset($msg))    
      			{     
      				echo $msg;    
      			}    
      			else    
      			{     
      	?>                

      	<div class='alert alert-info'>         
      	Por favor, introduzca su dirección de correo electrónico. Recibirá un enlace por correo electrónico para crear una nueva contraseña.</div>                   
      	<?php    
      	}    
      	?>                  

      	<input type="email" class="input-block-level" placeholder="Ingrese Email" name="txtemail" required /> 
      <hr />        
      <button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generar Nueva Contraseña</button>  </form> 
 
    </div> <!-- /container -->     

    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>     
    <script src="bootstrap/js/bootstrap.min.js"></script>   
    </body> 
    </html> 