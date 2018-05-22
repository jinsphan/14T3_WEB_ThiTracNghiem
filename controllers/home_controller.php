<?php
//include "models/home_model.php"; 
class home_controller extends main_controller
{
	public function __construct() {
		parent::__construct();
	}
	
	public function index() 
	{
		$quiz_controller = new quiz_controller();
		$this->data = $quiz_controller->readAll();
		$this->display();
	} 
	public function getDemo(){
		$ar = ["a"=>5];
		echo json_encode($ar);	
	}
}
?>
