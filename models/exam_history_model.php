<?php 

class exam_history_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }

    public function readByQuizIDAndAcc($data) {
        return $this->readRecord($data);
    }

    public function create($datas) {
        return $this->createRecord($datas);
    }

    public function updateScore($exam_history_id, $datas) {
        return $this->updateRecord($exam_history_id, $datas);
    }
}

?>