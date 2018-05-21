<?php
class account_model extends vendor_crud_model
{

	public function __construct() {
		parent::__construct();
	}

	public function create($datas)
	{
		return $this->createRecord($datas);
	}

	public function readByID($datas) {
		return $this->readRecord($datas);
	}

	public function readAll() {
		return $this->readAllRecords();
	}

	public function updateByID($conditions, $datas) {
		return $this->updateRecord($conditions, $datas);
	}

	public function del($conditions) {
		return $this->delRecord($conditions);
	}

	
}
?>