<?php 

class subject_controller extends vendor_backend_controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function create() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $subject_name = vendor_app_util::sanitizeInput((isset($_POST["subject_name"]) ? $_POST["subject_name"] : ""));
            $description = vendor_app_util::sanitizeInput((isset($_POST["description"]) ? $_POST["description"] : ""));
            $parent_subject_id = (int)vendor_app_util::sanitizeInput((isset($_POST["parent_subject_id"]) ? $_POST["parent_subject_id"] : ""));
            if($subject_name == "") {
                echo json_encode([
                    "success" => 0,
                    "data" => [
                        "message" => "Vui lòng nhập đầy đủ thông tin"
                    ]
                ]);
            }
            else {
                $subject_model = new subject_model();
                if($parent_subject_id != 0) {
                    $subject = $subject_model->readByID([
                        "subject_id" => $parent_subject_id
                    ]);
                    if($subject == null) {
                        echo json_encode([
                            "success" => 0,
                            "data" => [
                                "message" => "Chủ đề cha không hợp lệ!"
                            ]
                        ]);
                    }
                    else {
                        $subject_rela_model = new subject_relationship_model();

                        $subject_id = $subject_model->create([
                            "subject_name" => $subject_name,
                            "description" => $description
                        ]);
                        
                        $subject_rela_model->create([
                            "parent_subject_id" => $parent_subject_id,
                            "child_subject_id" => $subject_id
                        ]);

                        echo json_encode([
                            "success" => 1,
                            "data" => [
                                "message" => "Tạo con chủ đề thành công"
                            ],
                        ]);
                    }
                } else {
                    $subject_id = $subject_model->create([
                        "subject_name" => $subject_name,
                        "description" => $description
                    ]);
                    echo json_encode([
                        "success" => 1,
                        "data" => [
                            "message" => "Tạo chính chủ đề thành công"
                        ],
                    ]);
                }
            }
        }
    }

    public function readByID($params = null) {
        if($params != null && isset($params["subject_id"])) {
            $subject_id = vendor_app_util::sanitizeInput($params["subject_id"]);
            
            $subject_model = new subject_model();

            $subject = $subject_model->readByID([
                "subject_id" => $subject_id
            ]);
            die(var_dump($subject));
        }
    }

    public function readAll() {
        $subject_model = new subject_model();
        $subject_rela_model = new subject_relationship_model();

        $subject_data = [];

        // find root subject
        $allSubjects = $subject_model->readAll("subject_id, subject_name, description");
        foreach($allSubjects as $subject) {
            if($subject_rela_model->findParentSubject([
                "child_subject_id" => $subject["subject_id"]
            ]) == null) {
                $subject_data["{$subject["subject_id"]}"] = $subject;
                $subject_data["{$subject["subject_id"]}"]["childs"] = [];
            }
        }
        foreach($subject_data as $root_subject) {
            $this->findChildSubject($root_subject["subject_id"], $subject_data["{$root_subject["subject_id"]}"]["childs"]);
        }
        
        echo json_encode($subject_data);
    }

    private function findChildSubject($parent_subject_id, &$subject_data){
        $subject_rela_model = new subject_relationship_model();
        $subject_model = new subject_model();

        $childs = $subject_rela_model->findChildSubject("*", [
            "conditions" => "parent_subject_id = {$parent_subject_id}"
        ]);

        if($childs == null) {
            return null;
        }
        else {
            foreach($childs as $child) {
                $subject_data["{$child["child_subject_id"]}"] = $subject_model->readByID([
                    "subject_id" => $child["child_subject_id"]
                ], "subject_id, subject_name, description");

                $subject_data["{$child["child_subject_id"]}"]["childs"] = [];

                $this->findChildSubject($child["child_subject_id"], $subject_data["{$child["child_subject_id"]}"]["childs"]);
            }
        }
    }

    public function update() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $subject_id = (int)vendor_app_util::sanitizeInput((isset($_POST["subject_id"]) ? $_POST["subject_id"] : ""));
            $subject_name = vendor_app_util::sanitizeInput((isset($_POST["subject_name"]) ? $_POST["subject_name"] : ""));
            $description = vendor_app_util::sanitizeInput((isset($_POST["description"]) ? $_POST["description"] : ""));
            $parent_subject_id = (int)vendor_app_util::sanitizeInput((isset($_POST["parent_subject_id"]) ? $_POST["parent_subject_id"] : ""));
            $subject_status = (int)vendor_app_util::sanitizeInput((isset($_POST["subject_status"]) ? $_POST["subject_status"] : ""));
            if($subject_name == "" || $subject_id == 0) {
                echo json_encode([
                    "success" => 0,
                    "data" => [
                        "message" => "Vui lòng nhập đầy đủ thông tin"
                    ]
                ]);
            } 
            else {
                $subject_model = new subject_model();
                if($parent_subject_id != 0) {
                    $parent_subject = $subject_model->readByID([
                        "subject_id" => $parent_subject_id
                    ]);
                    if($parent_subject == null) {
                        echo json_encode([
                            "success" => 0,
                            "data" => [
                                "message" => "Chủ đề cha không hợp lệ!"
                            ]
                        ]);
                    }
                    else {
                        $subject_rela_model = new subject_relationship_model();
                        
                        $rs = $subject_rela_model->findParentSubject([
                            "child_subject_id" => $subject_id
                        ]);
                            
                        if($rs == null) {
                            $subject_rela_model->create([
                                "parent_subject_id" => $parent_subject_id,
                                "child_subject_id" => $subject_id
                            ]);
                        }

                        else {
                            $subject_rela_model->update(
                                [
                                    "subject_relationship_id" => $rs["subject_relationship_id"]
                                ],
                                [
                                    "parent_subject_id" => $parent_subject_id
                                ]
                            );
                        }

                        $subject_model->update(
                            [
                                "subject_id" => $subject_id
                            ],
                            [
                                "subject_name" => $subject_name,
                                "description" => $description,
                                "subject_status" => $subject_status
                            ]
                        );

                        echo json_encode([
                            "success" => 1,
                            "data" => [
                                "message" => "Chỉnh sửa chủ đề thành công"
                            ],
                        ]);
                    }
                }

                else {
                    $subject_rela_model = new subject_relationship_model();

                    $rs = $subject_rela_model->findParentSubject([
                        "child_subject_id" => $subject_id
                    ]);

                    if($rs != null) {
                        $subject_rela_model->del([
                            "subject_relationship_id" => $rs["subject_relationship_id"]
                        ]);
                    }

                    $subject_model->update(
                        [
                            "subject_id" => $subject_id
                        ],
                        [
                            "subject_name" => $subject_name,
                            "description" => $description,
                            "subject_status" => $subject_status
                        ]
                    );

                    echo json_encode([
                        "success" => 1,
                        "data" => [
                            "message" => "Chỉnh sửa chủ đề thành công"
                        ],
                    ]);
                }
            }
        }
    }

    public function delete($params = null) {
        if($params != null && isset($params["subject_id"])) {
            $subject_id = (int)vendor_app_util::sanitizeInput($params["subject_id"]);

            $subject_model = new subject_model();

            if($subject_model->del([
                "subject_id" => $subject_id
            ]) == 1) {
                echo json_encode([
					"success" => 1,
					"data" => [
						"message" => "Xóa chủ đề thành công"
					]
				]);
            }
            else {
                echo json_encode([
					"success" => 0,
					"data" => [
						"message" => "Xóa chủ đề không thành công"
					]
				]);
            }
        }
    }
}
?>