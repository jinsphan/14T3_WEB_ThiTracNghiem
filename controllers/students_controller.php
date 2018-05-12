<?php
class students_controller extends vendor_main_controller
{
	//public $components = array('SimpleImage');
	public function index() 
	{	
		$students = new student_model();
		$records = $students->getAllRecords();
		
		$this->setProperty('records',$records);
		$this->display();
	} 

	public function add() 
	{
		if(isset($_POST['btn_submit'])) {
			$studentData = $_POST['data'][$this->controller];
			if(!empty($studentData['fullname']))  {
				$studentData['photo'] = $this->uploadImg($_FILES);
				$student = new student_model();
				if($student->addRecord($studentData))
					header( "Location: ".html_helpers::url(array('ctl'=>'students')));
			}
		}
		$this->display();
	}

	public function edit($id) 
	{
		$student = new student_model();
		$record = $student->getRecord($id);
		$this->setProperty('record',$record);
		if(isset($_POST['btn_submit'])) {
			$studentData = $_POST['data'][$this->controller];
			if(!empty($studentData['fullname']))  {
				if(isset($_FILES) and $_FILES["image"]["name"]) {
					if(file_exists(RootURI."/media/upload/" .$this->controller.'/'.$record['photo']))
						unlink(RootURI."/media/upload/" .$this->controller.'/'.$record['photo']);
					$studentData['photo'] = $this->uploadImg($_FILES);
				}
				if($student->editRecord($id, $studentData))
					header( "Location: ".html_helpers::url(array('ctl'=>'students')));
			}
		}
		$this->display();
	}
	
	public function view($id) 
	{
		$student = new student_model();
		$record = $student->getRecord($id);
		$this->setProperty('record',$record);
		$this->display();
	}
	
	public function del($id) 
	{
		$student = new student_model();
		$record = $student->getRecord($id);
		if(file_exists(RootURI."/media/upload/" .$this->controller.'/'.$record['photo']))
			unlink(RootURI."/media/upload/" .$this->controller.'/'.$record['photo']);
			
		echo $student->delRecord($id);
		exit();
		//$student->delRecord($id);
		//header( "Location: ".html_helpers::url(array('ctl'=>'students')));
	}
}
?>
