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
                    FROM answers INNER JOIN questions ON questions.question_id = answers.question_id 
                    WHERE questions.question_id = ?";
            
        $sqlCountCorrectAnserwers = "SELECT COUNT(is_correct_answer) as total
                                        FROM answers WHERE question_id = '{$question_id}' AND is_correct_answer = '1'";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt->execute();

        $stmtCrAns = $this->conn->prepare($sqlCountCorrectAnserwers);
        $stmtCrAns->execute();

        $data = [
            "totalCrAns" => $stmtCrAns->fetchAll(PDO::FETCH_ASSOC)[0]["total"],
            "answers" => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];

        return $data;
    }
}

?>