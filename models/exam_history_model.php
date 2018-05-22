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

    public function readAllByQuizAndAcc($account_id, $quiz_id) {
        $sql = "SELECT * FROM {$this->table} WHERE account_id = ? AND quiz_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $account_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $quiz_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllByAcc($fields, $options) {
        return $this->readAllRecords($fields, $options);
    }
}

?>