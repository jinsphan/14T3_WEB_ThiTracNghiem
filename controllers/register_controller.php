<?php
    class register_controller extends main_controller {
        protected $error;
        protected $success;
        public function __construct() {
            parent::__construct();
        }

        public function index() {
            
            if($_SERVER["REQUEST_METHOD"] == "GET") {
                if(isset($_SESSION["loginUser"]["username"]))
                    header("Location: ".html_helper::url([
                        "ctl" => "home"
                    ]));
                $this->display();
            }

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_SESSION["loginUser"]["username"]))
                    header("Location: ".html_helper::url([
                        "ctl" => "home"
                    ]));

                if(!isset($_POST["username"]) || !isset($_POST["password"]) 
                    || !isset($_POST["repassword"]) || !isset($_POST["fullname"])
                    || !isset($_POST["sex"]) || !isset($_POST["fullname"]) || !isset($_POST["date_of_birth"])) {
                        header("Location: ".html_helper::url([
                            "ctl" => "home"
                        ]));
                }
                else {
                    if($_POST["password"] != $_POST["repassword"]) {
                        $this->error = "Xác nhận mật khẩu không chính xác!";
                        $this->display();
                    }
                    else {
                        $username = vendor_app_util::sanitizeInput($_POST["username"]);
                        $password = vendor_app_util::generatePassword(vendor_app_util::sanitizeInput($_POST["password"]));
                        $fullname = vendor_app_util::sanitizeInput($_POST["fullname"]);
                        $sex      = vendor_app_util::sanitizeInput($_POST["sex"]);
                        $date_of_birth = date("Y:m:d", strtotime(vendor_app_util::sanitizeInput($_POST["date_of_birth"])));

                        if($username == "" || $password == "" || $sex == "" || $fullname == "" || $date_of_birth == "") {
                            $this->error = "Vui lòng nhập đầy đủ thông tin!";
                            $this->display();
                        }
                        else {
                            $reg = new vendor_reg_model();

                            $data = [
                                "username" => $username,
                                "password" => $password,
                                "fullname" => $fullname,
                                "sex"      => $sex,
                                "date_of_birth" => $date_of_birth
                            ];
                            
                            if($reg->register($data)) {
                                $this->success = "Đăng ký tài khoản thành công, vui lòng đăng nhập để thực hiện các chức năng!";
                                $this->display();
                            }
                            else {
                                $this->error = "Tài khoản này đã có người đăng ký, vui lòng chọn tên tài khoản khác!";
                                $this->display();
                            }
                        }
                    }
                }
            }
        }
        
    }
?>