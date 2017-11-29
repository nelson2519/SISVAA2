<?php


/**
* 
*/
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





?>