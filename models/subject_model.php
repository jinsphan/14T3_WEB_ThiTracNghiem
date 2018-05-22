<?php 

class subject_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }
    public function readAll($fields) {
        return $this->readAllRecords($fields);
    }
    public function readByID($datas) {
        return $this->readRecord($datas);
    }
}

?>