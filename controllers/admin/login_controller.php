<?php
class login_controller extends vendor_main_controller {
	public function __construct() {
		parent::__construct();
		global $app;
		$rolesFlip = array_flip($app['roles']);
		if (isset($_SESSION['loginUser']['role']) && $_SESSION['loginUser']['role']==$rolesFlip["admin"]) {
			header( "Location: ".vendor_app_util::url(array('ctl'=>'dashboard')));
		}
	}

	public function index() {
		if(isset($_POST['btn_submit'])) {

			$user = $_POST['user'];
			$auth = new vendor_auth_model();
			if($auth->login($user)) {
				header( "Location: ".vendor_app_util::url(array('ctl'=>'dashboard', 'params'=> [1,2,3])));
			} else {
				header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
			}
		}
		$this->display();
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
