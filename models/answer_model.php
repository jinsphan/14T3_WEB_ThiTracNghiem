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
            
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>