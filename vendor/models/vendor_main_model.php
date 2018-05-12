<?php
class vendor_main_model {
	protected $con;
	protected $table;
	public function __construct(){
		$this->con =  mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		if(mysqli_connect_error()) {
			echo "Failed to connect to MySQL". mysqli_connect_error();exit();
		}
		if(!$this->table)	$this->setTableName();
	}
	
	protected function setTableName($table=null){
		if($table) {
			$this->table=$table;
		} else {
			$cln = get_class($this);
			$clnf = str_split($cln, strrpos($cln, '_'))[0];
			if (strrpos($clnf,"y")) {
				if ((strrpos($clnf,"y") + 1) == strlen($clnf)) {
					$this->table = str_split($clnf, strrpos($clnf, 'y'))[0].'ies'; 
				} 
			} else {
				$this->table = $clnf.'s';
			}
		}
	}
	public function getTableName() {
		return $this->table;
	}
}
