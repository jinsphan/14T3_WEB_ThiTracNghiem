<?php 

class answer_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }

    public function create($datas) {
        return $this->createRecord($datas);
    }

    public function readByQuestionID($question_id) {
        $sql = "SELECT answer_description, answer_id
                    FROM {$this->table} INNER JOIN questions ON questions.question_id = answers.question_id 
                    WHERE questions.question_id = ?";
            
        // $sqlCountCorrectAnserwers = "SELECT COUNT(is_correct_answer) as total
        //                                 FROM answers WHERE question_id = '{$question_id}' AND is_correct_answer = '1'";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt->execute();

        // $stmtCrAns = $this->conn->prepare($sqlCountCorrectAnserwers);
        // $stmtCrAns->execute();

        // $data = [
        //     "total_correct_answers" => $this->->fetchAll(PDO::FETCH_ASSOC)[0]["total"],
        //     "answers" => $stmt->fetchAll(PDO::FETCH_ASSOC)
        // ];

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countCorrectByQuestionID($question_id) {

        $sql = "SELECT COUNT(answer_id) as total_correct_answers 
                FROM {$this->table} 
                WHERE question_id = ? AND is_correct_answer = 1
                LIMIT 0, 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["total_correct_answers"];
    }

    public function readCorrectByQuestionID($question_id) {
        $sql = "SELECT answer_id 
                FROM {$this->table} 
                WHERE question_id = ? AND is_correct_answer = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delByQuestionID($conditions) {
        return $this->delRecord($conditions);
    }
}

?>