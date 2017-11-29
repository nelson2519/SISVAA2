<?php 
session_start(); 
require_once 'class.user.php'; 
 
$reg_user = new USER(); 
 
if($reg_user->is_logged_in()!="") 
{  
	$reg_user->redirect('home.php'); 
} 
 
 
if(isset($_POST['btn-signup'])) 
{  
	$uname = trim($_POST['txtuname']);  
	$email = trim($_POST['txtemail']);  
	$upass = trim($_POST['txtpass']);  
	$code = md5(uniqid(rand()));    

	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");  
	$stmt->execute(array(":email_id"=>$email));  
	$row = $stmt->fetch(PDO::FETCH_ASSOC);    if($stmt->rowCount() > 0)  
	{  
		$msg = "<div class='alert alert-error'> 
    			 <button class='close' data-dismiss='alert'>&times;</button>      
    				 <strong>Sorry !</strong> Este Email ya se Encuentra Registrado, Por Favor Intente Otro      
    				 </div>";  

    }  
    else  
    {   
    	if($reg_user->register($uname,$email,$upass,$code))   
    	{      
    		$id = $reg_user->lasdID();      
    		$key = base64_encode($id);    
    		$id = $key;        
    		$message = "Hello $uname,       
    					<br /><br />       
    					Welcome <br/>       
    					Para completar su registro, haga clic en el enlace siguiente<br/>       
    					<br /><br />      
    					<a href='http://localhost:8080/Login/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>       
    					<br /><br />       
    					Thanks,";           
    					
    					$subject = "Confirm Registration";           
    									   
    					$reg_user->send_mail($email,$message,$subject);     
    					$msg = 
    						"<div class='alert alert-success'>       
    						<button class='close' data-dismiss='alert'>&times;</button>       
    						<strong>Success!</strong> Hemos enviado un correo electrónico a $email. Haga clic en el enlace de confirmación en el correo electrónico para crear su cuenta.</div>";   
    		}   
    		else   
    		{    
    			echo "sorry , Query could no execute...";   
    		}   
    	} 
   	} 
?> 
<!DOCTYPE html> 
<html>   
<head>     
<title>Registrate</title>     
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

  	if(isset($msg)) echo $msg;  ?>       
 		<form class="form-signin" method="post">         
  		<h2 class="form-signin-heading">Registrate</h2><hr />         
  		<input type="text" class="input-block-level" placeholder="Nombre de Usuario" name="txtuname" required />    
 		<input type="email" class="input-block-level" placeholder="Ingrese Email" name="txtemail" required />       
  		<input type="password" class="input-block-level" placeholder="Password" name="txtpass" required /> <hr />   
		<button class="btn btn-large btn-primary" type="submit" name="btn-signup">Registrate</button>         
		<a href="index.php" style="float:right;" class="btn btn-large">Atras</a>       
		</form> 
</div> 
<!-- /container -->     
   <script src="vendors/jquery-1.9.1.min.js"></script>     
<script src="bootstrap/js/bootstrap.min.js"></script>   
</body> 
</html> 
 
 