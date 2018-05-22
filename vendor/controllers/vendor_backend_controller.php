<?php
class vendor_backend_controller extends vendor_main_controller {
	public function __construct() {
		global $app;
		
		// $this->checkAuth();
		// $rolesFlip = array_flip($app['roles']);
		// if (!isset($_SESSION['loginUser']['role_id']) || $_SESSION['loginUser']['role_id']!=$rolesFlip["admin"]) {
		// 	header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
		// }
		parent::__construct();
	}
}
?>
