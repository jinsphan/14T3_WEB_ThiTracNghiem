<?php
class account_model extends vendor_crud_model
{

	public function __construct() {
		parent::__construct();
	}

	public function addNewUser($data)
	{
		return $this->createRecord($data);
	}

	public function getNameAdmin()
	{
		return $_SESSION['loginUser']["fullname"];
	}
}
?>