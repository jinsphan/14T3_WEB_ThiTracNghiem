<?php
    class quiz_controller extends main_controller {
        protected $error;
        protected $success;
        public function index() {
            $this->display();
        }

        public function create() {
            $this->checkLoggedIn();
            if($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->display();
            }
            
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $quiz_name = vendor_app_util::sanitizeInput($_POST["quiz_name"]);
                $description = vendor_app_util::sanitizeInput($_POST["description"]);
                $subject_id = (int)vendor_app_util::sanitizeInput($_POST["subject_id"]);
                $max_time = (int)vendor_app_util::sanitizeInput($_POST["max_time"]);
                $total_score = (int)vendor_app_util::sanitizeInput($_POST["total_score"]);
                $quiz_type_id = (int)vendor_app_util::sanitizeInput($_POST["quiz_type_id"]);
                $is_random_question = (int)(vendor_app_util::sanitizeInput($_POST["is_random_question"]) === "true" );
                $is_random_answer = (int)(vendor_app_util::sanitizeInput($_POST["is_random_answer"]) === "true" );
                $is_redo = (int)(vendor_app_util::sanitizeInput($_POST["is_redo"]) === "true" );

                if($quiz_name == "" || $subject_id == 0 || $max_time == 0 || $total_score == 0 || $quiz_type_id == 0) {
                    $this->error = "Vui lòng nhập đúng thông tin!";
                    $this->display();
                }
                
                else {
                    $date = DateTime::createFromFormat("Y-m-d\Th:i", "0003-01-02T14:03");
                    echo $date->format("Y-m-d h-i-s");
                }
            }
        }

        public function start($params = null) {
            $this->checkLoggedIn();
            if($params != null) {
                $this->quiz_id = $params[1];
            }
            $this->data_quiz = [
                [
                    "name_question" => "Lựa ch đúng nhất:",
                    "correct_answer" => [1],
                    "answers" => [
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên a lớn nhất biết 225 ⋮ a và 160 ⋮ a. Vậy:",
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên x lớn nhất biết 35 ⋮ x và 49 ⋮ x."
                    ],
                ],
                [
                    "name_question" => "Lựa chọn đáp án đúng nhất:",
                    "correct_answer" => [1],
                    "answers" => [
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên a lớn nhất biết 225 ⋮ a và 160 ⋮ a. Vậy:",
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên x lớn nhất biết 35 ⋮ x và 49 ⋮ x."
                    ],
                ],
                [
                    "name_question" => "Lựa chọn đáp án đúng nhất:",
                    "correct_answer" => [1],
                    "answers" => [
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên a lớn nhất biết 225 ⋮ a và 160 ⋮ a. Vậy:",
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên x lớn nhất biết 35 ⋮ x và 49 ⋮ x."
                    ],
                ],
                [
                    "name_question" => "Lựa chọn đáp án đúng nhất:",
                    "correct_answer" => [1],
                    "answers" => [
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên a lớn nhất biết 225 ⋮ a và 160 ⋮ a. Vậy:",
                        "Toi rat la dau khi nghe bai cua son Tung",
                        "Tìm số tự nhiên x lớn nhất biết 35 ⋮ x và 49 ⋮ x."
                    ],
                ]
            ];
            $this->display();
        }
        
        public function confirm($params = null) {
            $this->checkLoggedIn();
            if($params != null) {
                $this->quiz_id = $params[1];
                $this->display();
            }
        }
    }
?>