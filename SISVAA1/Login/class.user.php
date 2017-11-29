
 <?php 
 
require_once 'dbconfig.php'; 
 
class USER {  
 
 	private $conn;   

 	public function __construct()  
 	{   
 		$database = new Database();   
 		$db = $database->dbConnection();   
 		$this->conn = $db;     
 	}    

 	public function runQuery($sql)  
 	{   
 		$stmt = $this->conn->prepare($sql);  
 		 return $stmt;  
 	}    

 	public function lasdID()  
 	{   
 		$stmt = $this->conn->lastInsertId();   
 		return $stmt;  
 	}    

 	public function register($unombre,$unombre1,$uapellido,$uapellido1,$ugenero,$udirección,$utelefono,$email,$uprofesion,$rol,$cargo,$upass)  
 	{   
 		try   
 		{           

 			$password = md5($upass);    
 			$stmt = $this->conn->prepare("INSERT INTO persona(nombre,nombre1,apellido,apellido1, genero,dirección,telefono,correo,profesion,rol,cargo,contrasena) VALUES(:user_nombre, :user_nombre1, :user_apellido, user_apellido1, :user_genero, :user_direccion, :user_telefono, :user_correo, :user_profesion, : user_rol, :user_cargo, : active_code)");   
 			$stmt->bindparam(":user_nombre",$unombre);  
 			$stmt->bindparam(":user_nombre1",$unombre1);
 			$stmt->bindparam(":user_genero",$ugenero);
 			$stmt->bindparam(":user_direccion",$udirección);
 			$stmt->bindparam(":user_telefono",$utelefono);
 			$stmt->bindparam(":user_correo",$email);
 			$stmt->bindparam(":user_profesion",$profesion);
 			$stmt->bindparam(":user_rol",$urol);
 			$stmt->bindparam(":user_cargo",$user_cargo);
 			$stmt->bindparam(":user_genero",$ugenero);

  
 			$stmt->bindparam(":user_pass",$password);    
 			$stmt->bindparam(":active_code",$code);    
 			$stmt->execute();     
 			return $stmt;   
 		}   
 		catch(PDOException $ex)   
 			{    
 				echo $ex->getMessage();   
 			}  
 		}    

 		public function login($email,$upass)  
 		{   
 			try   
 			{    
 				$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");   
 				 $stmt->execute(array(":email_id"=>$email));    
 				 $userRow=$stmt->fetch(PDO::FETCH_ASSOC);     
			   if
			   	($stmt->rowCount() == 1)    
			   {     
			   		if($userRow['userStatus']=="Y")     
			   		{      
			   			if($userRow['userPass']==md5($upass))      
			   				{       
			   					$_SESSION['userSession'] = $userRow['userID']; 
			   					return true;      
			   				}      
			   				else      
			   				{       
			   					header("Location: index.php?error");       
			   					exit;      
			   				}     
			   			}     
			   			else     
			   			{      
			   				header("Location: index.php?inactive");      
			   				exit;     
			   			}     
			   		}    
			   		else    
			   		{     
			   			header("Location: index.php?error");     
			   			exit;    
			   		}     
			   	}   
			   	catch(PDOException $ex)   
			   	{    
			   		echo $ex->getMessage();   
			   	}  
			}      

			public function is_logged_in()  
			{   
			   	if(isset($_SESSION['userSession']))   
			   	{    
			   		return true;   
			   	}  
			}    

			public function redirect($url)  
			{   
				header("Location: $url");  
			}   

		public function logout()  
		{   
			session_destroy();   
			$_SESSION['userSession'] = false;  
		}    

		function send_mail($email,$message,$subject)  
		{         
			require_once('mailer/class.phpmailer.php'); 
 
$mail = new PHPMailer(); 
$mail->IsSMTP(); 
$mail->Mailer = "smtp"; 
$mail->Host = "mail.smtp2go.com"; 
$mail->Port = "2525"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'SSL'; 
$mail->Username = "compubinsas@gmail.com"; 
$mail->Password = "wc85nUQ8N1tF"; 
$mail->MsgHTML($message); 
$mail->From = "compubinsas@gmail.com"; 
$mail->FromName = "Activacion"; 
$mail->AddAddress($email); 
$mail->AddReplyTo("edutorpe@gmail.com", "gracias"); 
$mail->Subject = $subject; 
$mail->Body = ($message); 
$mail->WordWrap = 50; 
 
if(!$mail->Send())  
{ 
echo 'Message was not sent.'; 
echo 'Mailer error: ' . $mail->ErrorInfo; 
exit; 
} 
else 
{ 
echo 'Message has been sent.'; 
} 
}    
} 