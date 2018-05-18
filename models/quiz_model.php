<?php 

class quiz_model extends vendor_crud_model {

    protected $error;

    public function __construct()
    {
        parent::__construct();
    }

    public function create($datas) {
        return $this->createRecord($datas);
    }

    public function readByCode($quiz_code) {
        $sql = "SELECT quiz_id  
                FROM {$this->table} 
                WHERE quiz_code = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $quiz_code);
        try {
            $stmt->execute();

        } catch(Exception $e) {
            $e->getMessage();
        }
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readQA($quiz_id) {
        $sql = "SELECT question_description, question_id 
                FROM questions INNER JOIN quizs ON questions.quiz_id = quizs.quiz_id 
                WHERE quizs.quiz_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $quiz_id);
        $stmt->execute();
        $questions= $stmt->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0; $i < count($questions); $i++) {
            $sql = "SELECT answer_description, answer_id
                    FROM answers INNER JOIN questions ON questions.question_id = answers.question_id 
                    WHERE questions.question_id = {$questions[$i]["question_id"]}";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $questions[$i]["answers"] = $answers;
            
        }
        return $questions;
    }
}

?>