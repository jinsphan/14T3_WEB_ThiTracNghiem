<?php
class users_controller extends vendor_backend_controller {

	private $dataLoad = array();
	
	public function index() {
		$users = new user_model();
		$rsAll = $this->getAllData();
		$this->numAllUsers = count($rsAll);
		
		$this->fullname = $users->getNameAdmin();

		$this->rowTop10 = array();
		for($id = 0; $id < NUM_TOP_USERS; $id++){
			$this->rowTop10[$id] = $rsAll[$id];
		}

		$this->display();
	}

	private function getAllData($strFil = "")
	{	
		$users = new user_model();
		$rs = $users->getAllRecords();
		$data = array();
		if($strFil == ""){
			
			while($row = mysqli_fetch_assoc($rs)){
				if($row['role'] != 1){
					$data[] = $row;				
				}
			}
		} else{
			
			$arWords = preg_split("/[\s]+/", $strFil);		
			$s = count($arWords);

			while($row = mysqli_fetch_assoc($rs)){
				if($row['role'] != 1){
					$dem = 0;
					for($i = 0; $i < $s; $i++){
						foreach ($row as $key => $value) {
							if($key == 'username' || $key == 'email' || $key == 'status' || $key == 'created'){
								$str = $value;
								if($key == 'status'){
									$str = ($str=='1')?'creating':(($str=='2')?'Enable':'Disable');
								}
								$check = strpos($str, $arWords[$i]);
								if((string)($check) != "") {
									$dem++;
									break;
								}

							}
						}
					}
					if($dem == $s) $data[] = $row;
				}
			}
		}
		return $data;
	}

	public function getAllId($strFil)
	{	

		$allData = $this->getAllData($strFil[0]);
		$arListId = array();
		for($i = 0; $i < count($allData); $i++){
			$arListId[] = $allData[$i]['id'];
		}
		echo(json_encode($arListId));
	}

	public function ajax_loadData($prs)
	{
		$starRow = (intval($prs[1]) - 1)*NUM_TOP_USERS;
		$endRow = $starRow+NUM_TOP_USERS;
		
		$data = $this->getAllData($prs[2]);
		$dataShow = array();
		for($i=$starRow; $i<=$endRow-1; $i++){
			if(isset($data[$i]))
				$dataShow[] = $data[$i];
			else break;
		}
		$dataSend = array($dataShow, count($data));
		echo (json_encode($dataSend));
	}

	public function add()
	{
		if(isset($_POST['username']) && $_POST['username'] != ""){
			$data = $_POST;
			$users = new user_model();
			$rs = $users->addNewUser($data);
			if($rs) echo "Successful";
			else echo "error";
			return;
		} else {
			echo "error";
			return;
		}
	}

	public function view($id)
	{
		$users = new user_model();
		$rs = $users->getRecord($id);
		echo (json_encode($rs));
	}

	public function edit($id)
	{
		$users = new user_model();
		if(isset($_POST['username'])){
			$users->editRecord($id, $_POST);
			echo "Edit Successful";
		}else {
			return false;
		}
	}

	public function del($id)
	{
		$users = new user_model();
		$rs = $users->delRecord($id, "role != 1");
		if($rs) echo "Delete Successful";
		else echo "error";
	}
	
}
?>
