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
                $this->display();
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