<?php 

class question_controller extends main_controller {
    
    public function __construct()
    {
        parent::__construct();
    } 

    public function readByQuizID($params) {
        $this->checkLoggedIn();
        if($params != null && isset($params["quiz_id"]) && is_numeric($params["quiz_id"])) {
            $quiz_id = vendor_app_util::sanitizeInput($params["quiz_id"]);
            $question_model = new question_model();

            echo json_encode($question_model->readByQuizID($quiz_id));
        }
    }

    public function update() {
        $this->checkLoggedIn();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $question_id = (int)vendor_app_util::sanitizeInput((isset($_POST["question_id"]) ? $_POST["question_id"] : ""));
            $question_description = vendor_app_util::sanitizeInput(((isset($_POST["question_description"]) ? $_POST["question_description"] : "")));
            
            if($question_id == 0 || $question_description == "") {
                echo json_encode([
                    "success" => 0,
                    "data" => [
                        "message" => "Vui lòng nhập đầy đủ thông tin"
                    ]
                ]);
            }
            else {
                $question_model = new question_model();
                if($question_model->update(
                    [
                        "question_id" => $question_id
                    ],
                    [
                        "question_description" => $question_description
                    ]
                )) {
                    echo json_encode([
                        "success" => 1,
                        "data" => [
                            "message" => "Chỉnh sửa câu hỏi thành công"
                        ]
                    ]);
                }

                else {
                    echo json_encode([
                        "success" => 1,
                        "data" => [
                            "message" => "Chỉnh sửa câu hỏi thất bại"
                        ]
                    ]);
                }
            }
        }
    }

    public function delete($params) {

        if($params != null && isset($params["question_id"]) && is_numeric($params["question_id"])) {
            $question_id = (int)vendor_app_util::sanitizeInput($params["question_id"]);
            $question_model = new question_model();
            $answer_model = new answer_model();

            // del answer first
            if($answer_model->delByQuizID([
                "question_id" => $question_id
            ]) > 0) {

                if($question_model->del([
                    "question_id" => $question_id
                ]) == 1) {
                    echo json_encode([
                        "success" => 1,
                        "data" => [
                            "message" => "Xóa câu hỏi thành công"
                        ]
                    ]);
                } 
                else {
                    echo json_encode([
                        "success" => 0,
                        "data" => [
                            "message" => "Xóa câu hỏi thất bại"
                        ]
                    ]);
                }
            }

            else {
                echo json_encode([
                    "success" => 0,
                    "data" => [
                        "message" => "Xóa câu hỏi thất bại"
                    ]
                ]);
            }
                   
        }
    }
}

?>