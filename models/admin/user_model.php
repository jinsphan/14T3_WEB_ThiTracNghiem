<?php
class user_model extends vendor_crud_model
{

	public function __construct() {
		parent::__construct();
	}

	public function addNewUser($data)
	{
		$data['password'] = md5($data['password']);
		return $this->addRecord($data);
	}

	public function getNameAdmin()
	{
		return $_SESSION['loginUser']['firstname']." ".$_SESSION['loginUser']['lastname'];
	}
}