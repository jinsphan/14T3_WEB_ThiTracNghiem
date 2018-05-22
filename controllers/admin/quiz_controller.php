<?php 

class quiz_controller extends vendor_backend_controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {     // list all quizs
        // $quiz_model = new quiz_model();
        // $quizs_data = $quiz_model->readAll("*", [
        //     "conditions" => " '1'='1' ORDER BY date_created"
        // ]);
        // echo json_encode($quizs_data);
        $this->display();
    }

    public function getAll() {
        $quiz_model = new quiz_model();
        $quizs_data = $quiz_model->readAll("*", [
            "conditions" => " '1'='1' ORDER BY date_created"
        ]);
        echo json_encode($quizs_data);
    }

    public function readByID($params) {
        if($params != null && isset($params["quiz_id"])) {
            $quiz_id = vendor_app_util::sanitizeInput($params["quiz_id"]);
            $quiz_model = new quiz_model();
            $quiz_data = $quiz_model->readByID([
                "quiz_id" => $quiz_id
            ]);

            die(var_dump($quiz_data));
        }
    }

    public function toggleStatus() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $quiz_id = (int)vendor_app_util::sanitizeInput((isset($_POST["quiz_id"]) ? $_POST["quiz_id"] : ""));
            $quiz_status = (int)vendor_app_util::sanitizeInput((isset($_POST["quiz_status"]) ? $_POST["quiz_status"] : ""));
            if($quiz_id == 0) {
                echo json_encode([
                    "success" => 0,
                    "data" => [
                        "message" => "Vui lòng nhập đầy đủ thông tin"
                    ]
                ]);
            }
            else {
                $quiz_model = new quiz_model();
                if($quiz_model->updateRecord(
                    [
                        "quiz_id" => $quiz_id
                    ],
                    [
                        "quiz_status" => $quiz_status
                    ]
                )) {
                    echo json_encode([
                        "success" => 1,
                        "data" => [
                            "message" => "Toggle thành công"
                        ]
                    ]);
                }
                else {
                    echo json_encode([
                        "success" => 0,
                        "data" => [
                            "message" => "Toggle thất bại"
                        ]
                    ]);
                }
            }
        }
    }

    public function search($params) {
        if($params != null && isset($params["keyword"])) {
            $keyword = vendor_app_util::sanitizeInput($params["keyword"]);
            $quiz_model = new quiz_model();
            $quizs_data = $quiz_model->search($keyword);
            die(var_dump($quizs_data));
        }
    }
}

?>