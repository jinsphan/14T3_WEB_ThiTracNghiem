<?php 

class subject_relationship_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }

    public function findParentSubject($datas) {
        return $this->readRecord($datas);
    }

    public function findChildSubject($fields, $options) {
        return $this->readAllRecords($fields, $options);
    }  
}

?>