<?php
class student_model extends vendor_crud_model
{
	protected $table = 'students';
	protected $id_student = null;
	protected $name = null;
	protected $address = null;

	public function __construct() {
		parent::__construct();
		
	}

}