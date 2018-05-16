<?php
    class main_controller extends vendor_main_controller {
        public function __construct() {
            parent::__construct();
        }

        public function checkLoggedIn() {
            if(!isset($_SESSION["loginUser"]["username"]))
                header("Location: ".html_helper::url([
                    "ctl" => "login" 
                ]));
        }
        
    }
?>