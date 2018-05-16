<?php
    class login_controller extends main_controller {
        public $error = "";
        public function __construct() {
            parent::__construct();
        }
        public function index() {

            if($_SERVER["REQUEST_METHOD"] == "GET") {
                if(isset($_SESSION["loginUser"]["username"]))
                    header("Location: ".html_helper::url([
                        "ctl" => "home"
                    ]));
                else $this->display();
            }

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_SESSION["loginUser"]["username"]))
                    header("Location: ".html_helper::url([
                        "ctl" => "home"
                    ]));
                if(!isset($_POST["username"]) || !isset($_POST["password"])) {
                    header("Location: ".html_helper::url([
                        "ctl" => "home"
                    ]));
                }
                else {
                    $user = [
                        "username" => vendor_app_util::sanitizeInput($_POST["username"]),
                        "password" => vendor_app_util::sanitizeInput($_POST["password"])
                    ];
                    
                    $auth = new vendor_auth_model();
                    if($auth->login($user)) {
                        header("Location: ".html_helper::url([
                            "ctl" => "home"
                        ]));
                    } else {
                        $this->error = "Tài khoản hoặc mật khẩu không chính xác!";
                        $this->display();
                    }
                }
            }
            
        }
    }
?>