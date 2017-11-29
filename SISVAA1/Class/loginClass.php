<?php


/**
* Contiene los metodos que se van a usar
*/
class loginClass
{
	/*Autentificacion*/
	public function personalogin($tipo_documento, $idDocumento, $contrasena, $rol)
	{
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT p.`tipo_documento`, p.`idDocumento`, p.`contrasena`, r.`rol` FROM persona AS p INNER JOIN rol AS r ON p.`rol`= r.`idrol` WHERE p.`tipo_documento`=:tipo_documento AND p.`idDocumento`=:idDocumento AND p.`contrasena`=:hash_contrasena AND r.`rol`=:rol");
			$stmt->bindParam("tipo_documento", $tipo_documento, PDO::PARAM_STR);
			$stmt->bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
			$hash_contrasena= md5($contrasena);
			$stmt->bindParam("hash_contrasena", $hash_contrasena, PDO::PARAM_STR);
			$stmt->bindParam("rol", $rol, PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			$db = null;
			
			if ($count) {
				$_SESSION['idDocumento']=$data->idDocumento; // evalua la session
				return true;
			}else {
				return false;
			}
		}
		catch(PDOException $e){
				echo '{"error:"{"text:"'.$e->getMessage().'}}';
		}
	}

		
	/* users details*/
	public function personaDetalle($session_id){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT p.`idDocumento`, p.`nombre`, p.`nombre1`, p.`apellido`, p.`apellido1`, r.`rol` FROM persona AS p INNER JOIN rol AS r ON p.`rol`=r.`idrol` WHERE p.`idDocumento`=:idDocumento");
			$stmt->bindParam("idDocumento", $session_id, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function restablecerpwd($tipo_documento,$idDocumento){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT tipo_documento, idDocumento, correo FROM persona WHERE tipo_documento=:tipo_documento and idDocumento=:idDocumento");
			$stmt-> bindParam("tipo_documento", $tipo_documento, PDO::PARAM_STR);
			$stmt-> bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
			$stmt-> execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			return $data;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function confirmaid($idDocumento){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT idDocumento FROM persona WHERE idDocumento=:idDocumento");
			$stmt-> bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
			$stmt-> execute();
			$count = $stmt->rowCount();
			return $count;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function cambioContrasena($idDocumento, $contrasena){
		try {
			$db = getDB();
			$stmt = $db->prepare("UPDATE persona SET contrasena=:contrasena  WHERE idDocumento=:idDocumento");
			$stmt->bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
			$hash_contrasena= md5($contrasena);
			$stmt->bindParam("contrasena", $hash_contrasena, PDO::PARAM_STR);
			$stmt->execute();
			$db = null;
			return true;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}
}
?>