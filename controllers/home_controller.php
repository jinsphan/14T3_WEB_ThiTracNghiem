<?php
//include "models/home_model.php"; 
class home_controller extends main_controller
{
	public function index() 
	{
		$this->display();
	} 
	public function getDemo(){
		$ar = ["a"=>5];
		echo json_encode($ar);	
	}
}
?>
