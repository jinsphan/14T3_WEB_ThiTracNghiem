<?php
class account_controller extends vendor_backend_controller {

	public function __construct()
	{
		parent::__construct();
	}

	private $dataLoad = array();
	
	public function index() {
		$account = new account_model();
		$rs = $account->readAll();
		$this->numAllUsers = count($rs);
		$this->fullname = $_SESSION["loginUser"]["fullname"];

		$this->rowTop10 = array();
		if(count($rs) < NUM_TOP_USERS)
			$this->rowTop10 = $rs;

		else
			for($id = 0; $id < NUM_TOP_USERS; $id++){
				$this->rowTop10[$id] = $rs[$id];
			}
		
		$this->display();
	}

	private function getAllData($strFil = "")
	{	
		$account_model = new account_model();
		$rs = $account_model->readAllRecords();
		$data = array();
		if($strFil == ""){
			foreach($rs as $row) {
				if($row["role_id"] != 1) {
					$data[] = $row;
				}
			}
		} else{
			
			$arWords = preg_split("/[\s]+/", $strFil);		
			$s = count($arWords);

			foreach($rs as $row){
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

	public function create()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = vendor_app_util::sanitizeInput((isset($_POST["username"]) ? $_POST["username"] : ""));
			$password = vendor_app_util::sanitizeInput((isset($_POST["password"]) ? $_POST["password"] : ""));
			$fullname = vendor_app_util::sanitizeInput((isset($_POST["fullname"]) ? $_POST["fullname"] : ""));
			$sex = vendor_app_util::sanitizeInput((isset($_POST["sex"]) ? $_POST["sex"] : ""));
			$date_of_birth = date("Y:m:d", strtotime(vendor_app_util::sanitizeInput($_POST["date_of_birth"])));
			

			if($username == "" || $password == "" || $fullname == "" || $date_of_birth == "") {
				echo json_encode([
					"success" => 0,
					"data" => [
						"message" => "Vui lòng nhập đầy đủ thông tin"
					]
				]);
			}
			else {
				$account_model = new account_model();
				if($account_model->create([
					"username" => $username,
					"password" => vendor_app_util::generatePassword($password),
					"fullname" => $fullname,
					"sex" => $sex,
					"date_of_birth" => $date_of_birth
				])) {
					echo json_encode([
						"success" => 1,
						"data" => [
							"message" => "Tạo tài khoản thành công"
						]
					]);
				}
				
				else {
					echo json_encode([
						"success" => 0,
						"data" => [
							"message" => "Tên tài khoản đã có người đăng ký"
						]
					]);
				}

			}
		}
	}

	public function read($params = null)
	{
		if($params != null && isset($params["account_id"])) {
			$account_model = new account_model();
			$account_id = (int)vendor_app_util::sanitizeInput($params["account_id"]);
			$rs = $account_model->readByID([
				"account_id" => $account_id
			]);
			echo (json_encode($rs));
		}
		
	}

	public function update()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$account_id = (int)vendor_app_util::sanitizeInput((isset($_POST["account_id"]) ? $_POST["account_id"] : ""));
			$username = vendor_app_util::sanitizeInput((isset($_POST["username"]) ? $_POST["username"] : ""));
			// $password = vendor_app_util::sanitizeInput((isset($_POST["password"]) ? $_POST["password"] : ""));
			$fullname = vendor_app_util::sanitizeInput((isset($_POST["fullname"]) ? $_POST["fullname"] : ""));
			$sex = vendor_app_util::sanitizeInput((isset($_POST["sex"]) ? $_POST["sex"] : ""));
			$date_of_birth = date("Y:m:d", strtotime(vendor_app_util::sanitizeInput($_POST["date_of_birth"])));
			$role_id = (int)vendor_app_util::sanitizeInput((isset($_POST["role_id"]) ? $_POST["role_id"] : ""));
			$account_status = (int)vendor_app_util::sanitizeInput((isset($_POST["account_status"]) ? $_POST["account_status"] : ""));

			if( $account_id == 0 || $username == "" || $fullname == "" || $sex == "" || $date_of_birth == "" || $role_id == 0) {
				echo json_encode([
					"success" => 0,
					"data" => [
						"message" => "Vui lòng nhập đầy đủ thông tin"
					]
				]);
			}
			else {
				$account_model = new account_model();
				if($account_model->updateByID(
					[
						"account_id" => $account_id
					],
					[
						"username" => $username,
						"fullname" => $fullname,
						"sex" => $sex,
						"date_of_birth" => $date_of_birth,
						"role_id" => $role_id,
						"account_status" => $account_status
					]
				)){
					echo json_encode([
						"success" => 1,
						"data" => [
							"message" => "Cập nhật tài khoản thành công"
						]
					]);
				}
				else {
					echo json_encode([
						"success" => 0,
						"data" => [
							"message" => "Tên tài khoản đã có người đăng ký"
						]
					]);
				}
			}
		}
	}

	public function delete($params = null)
	{
		if($params != null && isset($params["account_id"])) {
			$account_id = vendor_app_util::sanitizeInput($params["account_id"]);
			$account_model = new account_model();
			if($account_model->del([
				"account_id" => $account_id,
				"role_id" => 2
			]) == 1) {
				echo json_encode([
					"success" => 1,
					"data" => [
						"message" => "Xóa tài khoản thành công"
					]
				]);
			} else {
				echo json_encode([
					"success" => 0,
					"data" => [
						"message" => "Xóa tài khoản thất bại"
					]
				]);
			}
		}
	}
	
}
?>
