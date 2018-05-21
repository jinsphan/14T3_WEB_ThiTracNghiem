<?php 

class subject_relationship_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }

    public function create($datas) {
        return $this->createRecord($datas);
    }

    public function findParentSubject($datas) {
        return $this->readRecord($datas);
    }

    public function findChildSubject($fields, $options) {
        return $this->readAllRecords($fields, $options);
    }

    public function update($conditions, $datas) {
        return $this->updateRecord($conditions, $datas);
    }

    public function del($conditions) {
        return $this->delRecord($conditions);
    }
}

?>