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
                $max_score = (int)vendor_app_util::sanitizeInput(isset($_POST["max_score"]) ? $_POST["max_score"] : "");
                $quiz_type_id = (int)vendor_app_util::sanitizeInput(isset($_POST["quiz_type_id"]) ? $_POST["quiz_type_id"] : "");
                $is_random_question = (int)(vendor_app_util::sanitizeInput(isset($_POST["is_random_question"]) ? $_POST["is_random_question"] : "") === "true" );
                $is_random_answer = (int)(vendor_app_util::sanitizeInput(isset($_POST["is_random_answer"]) ? $_POST["is_random_answer"] : "") === "true" );
                $is_redo = (int)(vendor_app_util::sanitizeInput(isset($_POST["is_redo"]) ? $_POST["is_redo"] : "") === "true" );

                // check input
                if($quiz_name == "" || $subject_id == 0 || $max_time == 0 || $max_score == 0 || $quiz_type_id == 0) {
                    echo json_encode([
                        "success" => 0,
                        "data" => [
                            "message" => "Thông tin nhập không chính xác!"
                        ]
                    ]);
                }
                
                else {
                    $datas = [];
                    $quiz_code = "";
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
                            $datetime_start = $datetime_start->format("Y-m-d H:i:s");
                            $datetime_finish = $datetime_finish->format("Y-m-d H:i:s");
                            $quiz_code = md5(uniqid($_SESSION["loginUser"]["username"].":", true));
                            // gui len db;
                            
                            $datas = [
                                "quiz_name" => $quiz_name,
                                "description" => $description,
                                "subject_id" => $subject_id,
                                "max_time" => $max_time,
                                "max_score" => $max_score,
                                "quiz_type_id" => $quiz_type_id,
                                "is_random_question" => $is_random_question,
                                "is_random_answer" => $is_random_answer,
                                "is_redo" => $is_redo,
                                "account_id_create" => $_SESSION["loginUser"]["account_id"],
                                "quiz_code" => $quiz_code,
                                "datetime_start" => $datetime_start,
                                "datetime_finish" => $datetime_finish
                            ];
                        }
                    }

                    else if($quiz_type_id == 2){  // public
                        $datas = [
                            "quiz_name" => $quiz_name,
                            "description" => $description,
                            "subject_id" => $subject_id,
                            "max_time" => $max_time,
                            "max_score" => $max_score,
                            "quiz_type_id" => $quiz_type_id,
                            "is_random_question" => $is_random_question,
                            "is_random_answer" => $is_random_answer,
                            "is_redo" => $is_redo,
                            "account_id_create" => $_SESSION["loginUser"]["account_id"]
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
                        $question_model = new question_model();
                        $answer_model = new answer_model();
                        foreach($_POST["xlsx_data"] as $question ) {
                            $question_data = [
                                "question_description" => $question["question"],
                                "quiz_id" => $quiz_id
                            ];
                            $question_id = $question_model->create($question_data);
                            $correct_answers = explode(",", $question["correct_answers"]);
                                $keys = array_keys($question);
                                for($i = 2; $i < count($question); $i++) {
                                    $is_correct_answer = 0;
                                    if(in_array((string)($i-1), $correct_answers))
                                        $is_correct_answer = 1;
                                    $answer_data = [
                                        "answer_description" => $question[$keys[$i]],
                                        "question_id"  => $question_id,
                                        "is_correct_answer" => $is_correct_answer
                                    ];
                                    $answer_model->create($answer_data);
                                }     
                        }
                        
                        if($quiz_type_id == 1)
                            echo json_encode([
                                "success" => 1,
                                "data" => [
                                    "message" => "Tạo bài thi thành công!",
                                    "quiz_code" => $quiz_code
                                ]
                            ]);
                        else if($quiz_type_id == 2)
                            echo json_encode([
                                "success" => 1,
                                "data" => [
                                    "message" => "Tạo bài thi thành công!"
                                ]
                            ]);
                    }
                }
            }
        }

        public function start($params = null) {
            $this->checkLoggedIn();
            if(count($params) < 2 ) {
                header("Location: ".html_helper::url([
                    "ctl" => "home"
                ]));
            }
            else {
                if(!isset($params["quiz_id"]) || !isset($params["s"]))
                    header("Location: ".html_helper::url([
                        "ctl" => "home"
                    ]));
                else {

                    $quiz_id = vendor_app_util::sanitizeInput($params["quiz_id"]);

                    $currentExam = md5($_SESSION["loginUser"]["username"].$quiz_id.$params["s"]);
                    if($_SESSION["loginUser"]["currentExam"] != $currentExam || !isset($_SESSION["loginUser"]["currentExam"])) {
                        header("Location: ".html_helper::url([
                            "ctl" => "home"
                        ]));
                    }
                    else {
                        unset($_SESSION["loginUser"]["currentExam"]);

                        $exam_history_model = new exam_history_model();
                        $quiz_model = new quiz_model();

                        $history = $exam_history_model->readByQuizIDAndAcc([
                            "quiz_id" => $quiz_id ,
                            "account_id" => $_SESSION["loginUser"]["account_id"]
                        ]);

                        $quiz = $quiz_model->readByID(["quiz_id" => $quiz_id]);

                        if((int)$quiz["is_redo"] == 0 && $history != NULL) {
                            $this->error = "Bạn chỉ được phép thi bài thi này 1 lần!";
                            $this->display();
                        }
                        else {
                            $exam_history_model->create([
                                "account_id" => $_SESSION["loginUser"]["account_id"],
                                "quiz_id" => $quiz_id 
                            ]);
                            $this->quiz_data = $quiz_model->readQA($quiz_id);
                            die(var_dump($this->quiz_data));
                            $this->display();
                        }
                    }
                }
            }
        }
        
        public function confirm($params = null) {
            $this->checkLoggedIn();
            if($params != null && count($params) == 1) {
                if(isset($params["quiz_id"])) {
                    $quiz_model = new quiz_model();
                    $this->quiz_id = vendor_app_util::sanitizeInput($params["quiz_id"]);
                    $rs = $quiz_model->readByID(["quiz_id" => $this->quiz_id]);
                    if($rs == null) {
                        header("Location: ".html_helper::url([
                            "ctl" => "home"
                        ]));
                    }
                    else if($rs["quiz_status"] == 0) {
                        $this->error = "Bài thi này chưa được kích hoạt, vui lòng liên hệ với admin để kích hoạt bài thi!";
                        $this->display();
                    }
                    else {
                        $this->quiz_data = $rs;
                        $this->s = md5(uniqid("", true));
                        $_SESSION["loginUser"]["currentExam"] = md5($_SESSION["loginUser"]["username"].$this->quiz_id.$this->s);
                        $this->display();
                    }
                }

                if(isset($params["quiz_code"])) {
                    $quiz_model = new quiz_model();

                    $quiz_code = vendor_app_util::sanitizeInput($params["quiz_code"]);

                    $rs = $quiz_model->readByCode($quiz_code);

                    if(!$rs) {
                        header("Location: ".html_helper::url([
                            "ctl" => "home"
                        ]));
                    }
                    else if($rs["quiz_status"] == 0) {
                        $this->error = "Bài thi này chưa được kích hoạt, vui lòng liên hệ với admin để kích hoạt bài thi!";
                        $this->display();
                    }
                    else {
                        $this->quiz_data = $rs;
                        $this->quiz_id = $rs["quiz_id"];
                        $this->s = md5(uniqid("", true));
                        $_SESSION["loginUser"]["currentExam"] = md5($_SESSION["loginUser"]["username"].$this->quiz_id.$this->s);
                        $this->display();
                    }
                }
                else {
                    header("Location: ".html_helper::url([
                        "ctl" => "home"
                    ]));
                }
            }
            else {
                header("Location: ".html_helper::url([
                    "ctl" => "home"
                ]));
            }
        }
    }
?>