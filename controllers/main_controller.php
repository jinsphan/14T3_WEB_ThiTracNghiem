<?php
    class main_controller extends vendor_main_controller {
        public function __construct() {
            parent::__construct();
            $subject_model = new subject_model();
            $_SESSION["subjects"] = $subject_model->readAll("*");
        }

        public function checkLoggedIn() {
            if(!isset($_SESSION["loginUser"]["username"]))
                header("Location: ".html_helper::url([
                    "ctl" => "login" 
                ]));
        }
        
    }
?>