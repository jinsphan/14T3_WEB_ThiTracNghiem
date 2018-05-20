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
        $sql = "SELECT *  
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

    public function readByID($datas) {
        return $this->readRecord($datas);
    }

    public function readQA($quiz_id) {
        $sql = "SELECT quiz_id, max_time, is_random_answer, is_random_question 
                FROM quizs 
                WHERE quiz_id = ? 
                LIMIT 0, 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $quiz_id, PDO::PARAM_INT);
        $stmt->execute();

        $quiz_data = $stmt->fetch(PDO::FETCH_ASSOC);

        $is_random_answer = (int)$quiz_data["is_random_answer"];
        $is_random_quesion = (int)$quiz_data["is_random_question"];

        unset($quiz_data["is_random_answer"]);
        unset($quiz_data["is_random_question"]);

        $question_model = new question_model();
        $questions = $question_model->readByQuizID($quiz_id);

        $answer_model = new answer_model();

        if($is_random_answer != 1) {
            for($i = 0; $i < count($questions); $i++) {
                $questions[$i]["is_many_answers"] = ((int)$answer_model->countCorrectByQuestionID($questions[$i]["question_id"]) > 1 ? "1" : "0");
                $questions[$i]["answers"] = $answer_model->readByQuestionID($questions[$i]["question_id"]);
            }
        }
        
        else {
            for($i = 0; $i < count($questions); $i++) {
                $questions[$i]["is_many_answers"] = ((int)$answer_model->countCorrectByQuestionID($questions[$i]["question_id"]) > 1 ? "1" : "0");
                $questions[$i]["answers"] = $answer_model->readByQuestionID($questions[$i]["question_id"]);
                shuffle($questions[$i]["answers"]);
            }
        }

        if($is_random_quesion == 1)
            shuffle($questions);
        $quiz_data["questions"] = $questions;
        return $quiz_data;
    }
}

?>