<?php
class vendor_crud_model extends vendor_main_model {
	public function getAllRecords($fields='*', $options=null) {
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' where '.$options['conditions'];
		}
		$query = "SELECT ".$fields." FROM ".$this->table.$conditions;

		$result = mysqli_query($this->con,$query);

		return $result;
	}


	public function getRecord($id=null, $fields='*', $options=null) {
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' and '. $options['conditions'];
		}
		$query = "SELECT $fields FROM $this->table where id=$id".$conditions;
		$result = mysqli_query($this->con,$query);
		if($result) {
			$record = mysqli_fetch_assoc($result);
		} else $record=false;
		return $record;
	}
	
	public function delRecord($id=null, $conditions=null) {
		if($conditions)	$conditions = ' and '.$conditions;
		$query = "DELETE FROM $this->table WHERE id=$id".$conditions;
		mysqli_query($this->con,$query);
		return mysqli_affected_rows($this->con);
	}
	
	public function addRecord($datas) {
		// return $datas;
		$fields = $values = '';
		$i=0;
		foreach($datas as $k=>$v) {
			if($i) {
				$fields .=',';
				$values .=',';
			}
			$fields .= $k;
			$values .= "'".$v."'";
			$i++;
		}
		$query = "INSERT INTO $this->table($fields) VALUES ($values)";
		return mysqli_query($this->con,$query);

	}
	
	public function editRecord($id,$datas){
		$setDatas = '';
		$i=0;
		foreach($datas as $k=>$v) {
			if($i) {
				$setDatas .=',';
			}
			$setDatas .= $k."='".$v."'";
			$i++;
		}
        $query = "UPDATE $this->table SET $setDatas WHERE id='$id'";
		return mysqli_query($this->con,$query);
    }

    public static function convertToList($mysqliObject, $valueName) {
    	$arrReturn = [];
    	while($row = mysqli_fetch_array($mysqliObject)) {
    		$arrReturn[$row['id']] = $row[$valueName];
    	}
    	return $arrReturn;
    }
}
