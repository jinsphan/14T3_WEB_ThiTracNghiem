<?php
    class quiz_controller extends main_controller {
        public function index() {
            $this->display();
        }

        public function create() {
            $this->checkLoggedIn();
            if($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->display();
            }
            
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $quiz_name = vendor_app_util::sanitizeInput(isset($_POST["quiz_name"]) ? $_POST["quiz_name"] : "");
                $description = vendor_app_util::sanitizeInput(isset($_POST["description"]) ? $_POST["description"] : "");
                $subject_id = (int)vendor_app_util::sanitizeInput(isset($_POST["subject_id"]) ? $_POST["subject_id"] : "");
                $max_time = (int)vendor_app_util::sanitizeInput(isset($_POST["max_time"]) ? $_POST["max_time"] : "");
                $total_score = (int)vendor_app_util::sanitizeInput(isset($_POST["total_score"]) ? $_POST["total_score"] : "");
                $quiz_type_id = (int)vendor_app_util::sanitizeInput(isset($_POST["quiz_type_id"]) ? $_POST["quiz_type_id"] : "");
                $is_random_question = (int)(vendor_app_util::sanitizeInput(isset($_POST["is_random_question"]) ? $_POST["is_random_question"] : "") === "true" );
                $is_random_answer = (int)(vendor_app_util::sanitizeInput(isset($_POST["is_random_answer"]) ? $_POST["is_random_answer"] : "") === "true" );
                $is_redo = (int)(vendor_app_util::sanitizeInput(isset($_POST["is_redo"]) ? $_POST["is_redo"] : "") === "true" );

                // check input
                if($quiz_name == "" || $subject_id == 0 || $max_time == 0 || $total_score == 0 || $quiz_type_id == 0) {
                    echo json_encode([
                        "success" => 0,
                        "data" => [
                            "message" => "Thông tin nhập không chính xác!"
                        ]
                    ]);
                }
                
                else {
                    $datas = [];
                    if($quiz_type_id == 1) { // private

                        // chech thoi gian
                        $datetime_start = DateTime::createFromFormat("Y-m-d\TH:i", vendor_app_util::sanitizeInput(isset($_POST["datetime_start"]) ? $_POST["datetime_start"] : ""));
                        $datetime_finish = DateTime::createFromFormat("Y-m-d\TH:i", vendor_app_util::sanitizeInput(isset($_POST["datetime_finish"]) ? $_POST["datetime_finish"] : ""));
                        
                        if($datetime_start === false || $datetime_finish === false) {
                            echo json_encode([
                                "success" => 0,
                                "data" => [
                                    "message" => "Thời gian nhập không chính xác!"
                                ]
                            ]);
                        }

                        else if($datetime_start >= $datetime_finish) {
                            echo json_encode([
                                "success" => 0,
                                "data" => [
                                    "message" => "Thời gian nhập không chính xác!"
                                ]
                            ]);
                        }
                        else {
                            $datetime_start->format("Y-m-d H:i:s");
                            $datetime_finish->format("Y-m-d H:i:s");
                            // gui len db;
                            $datas = [
                                "quiz_name" => $quiz_name,
                                "description" => $description,
                                "subject_id" => $subject_id,
                                "max_time" => $max_time,
                                "total_score" => $total_score,
                                "quiz_type_id" => $quiz_type_id,
                                "is_random_question" => $is_random_question,
                                "is_random_answer" => $is_random_answer,
                                "is_redo" => $is_redo,
                                "datetime_start" => $datetime_start,
                                "datetime_finish" => $datetime_finish,
                            ];
                        }
                    }

                    else if($quiz_type_id == 2){  // public
                        $datas = [
                            "quiz_name" => $quiz_name,
                            "description" => $description,
                            "subject_id" => $subject_id,
                            "max_time" => $max_time,
                            "total_score" => $total_score,
                            "quiz_type_id" => $quiz_type_id,
                            "is_random_question" => $is_random_question,
                            "is_random_answer" => $is_random_answer,
                            "is_redo" => $is_redo,
                        ];
                    }
                    
                    // tao bai thi
                    $quiz_model = new quiz_model();
                    $quiz_id = $quiz_model->create($datas);
                    if($quiz_id == 0) {
                        echo json_encode([
                            "success" => 0,
                            "data" => [
                                "message" => "Tạo bài thi thất bại, vui lòng thử lại"
                            ]
                        ]);
                    }
                    
                    // them cau hoi
                    else {
                        
                    }

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