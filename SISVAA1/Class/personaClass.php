<?php


/**
* 
*/
class personaClass
{
	/* Registro de ususarios*/
	public function personaRegistro($tipo_documento, $idDocumento, $nombre, $nombre1, $apellido, $apellido1, $genero, $direccion, $telefono, $correo, $profesion, $rol, $cargo, $contrasena, $estado){
		try{
			$db = getDB();
			$st = $db->prepare("SELECT idDocumento FROM persona WHERE idDocumento=:idDocumento");
			$st->bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
			$st->execute();
			$count = $st->rowCount();

			if ($count<1) {
				$stmt = $db->prepare("INSERT INTO persona Values (:tipo_documento, :idDocumento, :nombre, :nombre1, :apellido, :apellido1, :genero, :direccion, :telefono, :correo, :profesion, :rol, :cargo, :contrasena, :estado)");
				$stmt->bindParam("tipo_documento", $tipo_documento, PDO::PARAM_STR);
				$stmt->bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
				$stmt->bindParam("nombre", $nombre, PDO::PARAM_STR);
				$stmt->bindParam("nombre1", $nombre1, PDO::PARAM_STR);
				$stmt->bindParam("apellido", $apellido, PDO::PARAM_STR);
				$stmt->bindParam("apellido1", $apellido1, PDO::PARAM_STR);
				$stmt->bindParam("genero", $genero, PDO::PARAM_STR);
				$stmt->bindParam("direccion", $direccion, PDO::PARAM_STR);
				$stmt->bindParam("telefono", $telefono, PDO::PARAM_STR);
				$stmt->bindParam("correo", $correo, PDO::PARAM_STR);
				$stmt->bindParam("profesion", $profesion, PDO::PARAM_STR);
				$stmt->bindParam("rol", $rol, PDO::PARAM_STR);
				$stmt->bindParam("cargo", $cargo, PDO::PARAM_STR);
				$hash_contrasena = md5($contrasena);
				$stmt->bindParam("contrasena", $hash_contrasena, PDO::PARAM_STR);
				$stmt->bindParam("estado", $estado, PDO::PARAM_STR);
				$stmt->execute();
				$id = $db->lastInsertId();// ultimo id insertado
				$db = null;
				$_SESSION['idDocumento']=$id;
				return true;
			}else{
				$db = null;
				return false;
			}
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	/**/
	public function personaDatos(){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT p.`tipo_documento`, p.`idDocumento`, p.`nombre`, p.`nombre1`, p.`apellido`, p.`apellido1`, r.`rol`, p.`estado` FROM persona AS p INNER JOIN rol AS r ON p.`rol`=r.`idrol`");
			$stmt->execute();

			$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function personaDatosId($idDocumento){
		$db = getDB();
		$stmt = $db->prepare("SELECT * FROM persona WHERE idDocumento=:idDocumento");
		$stmt-> bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
		$stmt-> execute();

		$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
	}

	public function modificasDatos($tipo_documento, $idDocumento, $nombre, $nombre1, $apellido, $apellido1, $genero, $direccion, $telefono, $correo, $profesion, $rol, $cargo, $estado){
		
		try {
			$db = getDB();
			$stmt = $db->prepare("UPDATE persona SET tipo_documento =:tipo_documento, nombre=:nombre, nombre1=:nombre1, apellido=:apellido, apellido1=:apellido1, genero=:genero, direccion=:direccion, telefono=:telefono, correo=:correo, profesion=:profesion, rol=:rol, cargo=:cargo, estado=:estado  WHERE idDocumento=:idDocumento");
			$stmt->bindParam("tipo_documento", $tipo_documento, PDO::PARAM_STR);
			$stmt->bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
			$stmt->bindParam("nombre", $nombre, PDO::PARAM_STR);
			$stmt->bindParam("nombre1", $nombre1, PDO::PARAM_STR);
			$stmt->bindParam("apellido", $apellido, PDO::PARAM_STR);
			$stmt->bindParam("apellido1", $apellido1, PDO::PARAM_STR);
			$stmt->bindParam("genero", $genero, PDO::PARAM_STR);
			$stmt->bindParam("direccion", $direccion, PDO::PARAM_STR);
			$stmt->bindParam("telefono", $telefono, PDO::PARAM_STR);
			$stmt->bindParam("correo", $correo, PDO::PARAM_STR);
			$stmt->bindParam("profesion", $profesion, PDO::PARAM_STR);
			$stmt->bindParam("rol", $rol, PDO::PARAM_STR);
			$stmt->bindParam("cargo", $cargo, PDO::PARAM_STR);
			$stmt->bindParam("estado", $estado, PDO::PARAM_STR);
			$stmt->execute();
			$uid = $db->lastInsertId();// ultimo id insertado
			$db = null;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}		
	}

	public function eliminarDatos($idDocumento){
		try {
			$db = getDB();
			$stmt = $db->prepare("DELETE FROM persona WHERE idDocumento=:idDocumento");
			$stmt-> bindParam("idDocumento", $idDocumento, PDO::PARAM_STR);
			$stmt->execute();
			$id = $db->lastInsertId();
			$db = null;
		} catch (Exception $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
		
	}
}


class cargoClass
{
	
	public function cargoRegistro($idcargo){
		try{
			$db = getDB();			
			$stmt = $db->prepare("INSERT INTO cargo Values ('', :idcargo)");
			$stmt->bindParam("idcargo", $idcargo, PDO::PARAM_STR);
			$stmt->execute();
			$db = null;
			return true;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	/**/
	public function cargoDatos(){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT * FROM cargo");
			$stmt->execute();

			$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function cargoDatosId($idcargo){
		$db = getDB();
		$stmt = $db->prepare("SELECT * FROM cargo WHERE idcargo=:idcargo");
		$stmt-> bindParam("idcargo", $idcargo, PDO::PARAM_STR);
		$stmt-> execute();

		$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
	}

	public function eliminarDatos($idcargo){
		try {
			$db = getDB();
			$stmt = $db->prepare("DELETE FROM cargo WHERE idcargo=:idcargo");
			$stmt-> bindParam("idcargo", $idcargo, PDO::PARAM_STR);
			$stmt->execute();
			$id = $db->lastInsertId();
			$db = null;
		} catch (Exception $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
		
	}
}

class generoClass
{
	
	public function generoRegistro($genero){
		try{
			$db = getDB();			
			$stmt = $db->prepare("INSERT INTO genero Values ('', :genero)");
			$stmt->bindParam("genero", $genero, PDO::PARAM_STR);
			$stmt->execute();
			$db = null;
			return true;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	/**/
	public function generoDatos(){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT * FROM genero");
			$stmt->execute();

			$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function generoDatosId($idGenero){
		$db = getDB();
		$stmt = $db->prepare("SELECT * FROM genero WHERE idGenero=:idGenero");
		$stmt-> bindParam("idGenero", $idGenero, PDO::PARAM_STR);
		$stmt-> execute();

		$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
	}

	public function eliminarDatos($idGenero){
		try {
			$db = getDB();
			$stmt = $db->prepare("DELETE FROM genero WHERE idGenero=:idGenero");
			$stmt-> bindParam("idGenero", $idGenero, PDO::PARAM_STR);
			$stmt->execute();
			$id = $db->lastInsertId();
			$db = null;
		} catch (Exception $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
		
	}
}

class profesionClass
{
	
	public function profesionRegistro($idprofesion){
		try{
			$db = getDB();			
			$stmt = $db->prepare("INSERT INTO profesion Values ('', :idprofesion)");
			$stmt->bindParam("idprofesion", $idprofesion, PDO::PARAM_STR);
			$stmt->execute();
			$db = null;
			return true;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	/**/
	public function profesionDatos(){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT * FROM profesion");
			$stmt->execute();

			$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function profesionDatosId($idprofesion){
		$db = getDB();
		$stmt = $db->prepare("SELECT * FROM profesion WHERE idprofesion=:idprofesion");
		$stmt-> bindParam("idprofesion", $idprofesion, PDO::PARAM_STR);
		$stmt-> execute();

		$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
	}

	public function eliminarDatos($idprofesion){
		try {
			$db = getDB();
			$stmt = $db->prepare("DELETE FROM profesion WHERE idprofesion=:idprofesion");
			$stmt-> bindParam("idprofesion", $idprofesion, PDO::PARAM_STR);
			$stmt->execute();
			$id = $db->lastInsertId();
			$db = null;
		} catch (Exception $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
		
	}
}

class rolClass
{
	
	public function rolRegistro($idrol){
		try{
			$db = getDB();			
			$stmt = $db->prepare("INSERT INTO rol Values ('', :idrol)");
			$stmt->bindParam("idrol", $idrol, PDO::PARAM_STR);
			$stmt->execute();
			$db = null;
			return true;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	/**/
	public function rolDatos(){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT * FROM rol");
			$stmt->execute();

			$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function rolDatosId($idrol){
		$db = getDB();
		$stmt = $db->prepare("SELECT * FROM rol WHERE idrol=:idrol");
		$stmt-> bindParam("idrol", $idrol, PDO::PARAM_STR);
		$stmt-> execute();

		$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
	}

	public function eliminarDatos($idrol){
		try {
			$db = getDB();
			$stmt = $db->prepare("DELETE FROM rol WHERE idrol=:idrol");
			$stmt-> bindParam("idrol", $idrol, PDO::PARAM_STR);
			$stmt->execute();
			$id = $db->lastInsertId();
			$db = null;
		} catch (Exception $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
		
	}
}

class tipdocumentClass
{
	
	public function tipdocumentRegistro($idtdocument, $tdocument){
		try{
			$db = getDB();			
			$stmt = $db->prepare("INSERT INTO tipdocument Values (:idtdocument, :tdocument)");
			$stmt->bindParam("idtdocument", $idtdocument, PDO::PARAM_STR);
			$stmt->bindParam("tdocument", $tdocument, PDO::PARAM_STR);
			$stmt->execute();
			$db = null;
			return true;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	/**/
	public function tipdocumentDatos(){
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT * FROM tipdocument");
			$stmt->execute();

			$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
		}
		catch(PDOException $e){
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	}

	public function TipDocumentDatosId($idTipDocumento){
		$db = getDB();
		$stmt = $db->prepare("SELECT * FROM tipdocument WHERE idTipDocumento=:idTipDocumento");
		$stmt-> bindParam("idTipDocumento", $idTipDocumento, PDO::PARAM_STR);
		$stmt-> execute();

		$arreglo = array();

			while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
				$arreglo[] = $reg;
			}

			return $arreglo;
	}

	public function eliminarDatos($idTipDocumento){
		try {
			$db = getDB();
			$stmt = $db->prepare("DELETE FROM tipdocument WHERE idTipDocumento=:idTipDocumento");
			$stmt-> bindParam("idTipDocumento", $idTipDocumento, PDO::PARAM_STR);
			$stmt->execute();
			$id = $db->lastInsertId();
			$db = null;
		} catch (Exception $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		}
		
	}
}





?>