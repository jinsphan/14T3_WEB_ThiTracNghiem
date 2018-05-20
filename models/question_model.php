<?php 

class question_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }

    public function create($datas) {
        return $this->createRecord($datas);
    }

    public function readByQuizID($quiz_id) {
        $sql = "SELECT question_description, question_id 
                FROM questions INNER JOIN quizs ON questions.quiz_id = quizs.quiz_id 
                WHERE quizs.quiz_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $quiz_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTotalByQuizID($quiz_id) {
        $sql = "SELECT COUNT(question_id) AS total_questions 
                FROM questions 
                WHERE quiz_id = ? 
                LIMIT 0, 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $quiz_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["total_questions"];
    }
}

?>