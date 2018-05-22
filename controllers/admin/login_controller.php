<?php
class login_controller extends vendor_main_controller {
	public function __construct() {
		parent::__construct();
		global $app;
		$rolesFlip = array_flip($app['roles']);
		if (isset($_SESSION['loginUser']['role']) && $_SESSION['loginUser']['role']==$rolesFlip["admin"]) {
			header("Location: ".vendor_app_util::url(array('ctl'=>'dashboard')));
		}
	}

	public function index() {
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			// if(isset($_SESSION["loginUser"]["username"])) {
			// 	header("Location: ".vendor_app_util::url([
			// 		"ctl" => "dashboard"
			// 	]));
			// }
			$this->display();
		}

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = vendor_app_util::sanitizeInput((isset($_POST["username"]) ? $_POST["username"] : ""));
			$password = vendor_app_util::sanitizeInput((isset($_POST["password"]) ? $_POST["password"] : ""));
			if($username == "" || $password == "") {
				$this->error = "Vui lòng nhập đầy đủ thông tin";
				$this->display();
			}
			else {
				$account = [
					"username" => $username,
					"password" => $password
				];

				$auth = new vendor_auth_model();
				if($auth->loginAdmin($account)) {
					header( "Location: ".vendor_app_util::url(array('ctl'=>'dashboard')));	
				}
				else {
					$this->error = "Tài khoản hoặc mật khẩu không chính xác!";
                    $this->display();
				}
			}
		}
	}
	public function logout() {
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
		header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
	}
}
?>
