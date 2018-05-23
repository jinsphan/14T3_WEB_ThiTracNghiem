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

    public function readAccountHistory($quiz_id) {
        $sql = "SELECT username, fullname, quiz_name, num_of_correct, num_of_wrong, total_score, exam_histories.date_created
                FROM {$this->table} INNER JOIN accounts ON exam_histories.account_id = accounts.account_id
                INNER JOIN quizs ON exam_histories.quiz_id = quizs.quiz_id
                WHERE exam_histories.quiz_id = ?
                ORDER BY exam_histories.date_created";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $quiz_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>