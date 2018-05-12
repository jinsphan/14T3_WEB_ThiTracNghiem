<?php
class vendor_auth_controller extends vendor_main_controller {
	public function __construct() {
		$this->checkAuth();
		parent::__construct();
	}
}
?>
