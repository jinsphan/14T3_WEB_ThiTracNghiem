<?php
class account_controller extends main_controller {

	public function logout() 
	{
        session_destroy();
        header("Location: /");
	}

	public function update() {
		$this->checkLoggedIn();
		if($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullname = vendor_app_util::sanitizeInput((isset($_POST["fullname"]) ? $_POST["fullname"] : ""));
			$sex      = vendor_app_util::sanitizeInput((isset($_POST["sex"]) ? $_POST["sex"] : ""));
            $date_of_birth = date("Y:m:d", strtotime(vendor_app_util::sanitizeInput((isset($_POST["date_of_birth"]) ? $_POST["date_of_birth"] : ""))));
			
			if($fullname == "" || $sex == "" || $date_of_birth == "") {
				echo json_encode([
					"success" => 0,
					"data" => [
						"message" => "Vui lòng nhập đầy đủ thông tin"
					]
				]);
			}
			else {
				$account_model = new account_model();
				if(isset($_POST["password"])) {
					if($account_model->update(
						[
							"account_id" => $_SESSION["loginUser"]["account_id"]
						],
						[
							"fullname" => $fullname,
							"sex" => $sex,
							"date_of_birth" => $date_of_birth,
							"password" => vendor_app_util::generatePassword($_POST["password"])
						]
					)) {
						echo json_encode([
							"success" => 1,
							"data" => [
								"message" => "Cập nhật thông tin thành công"
							]
						]);
					}
					else {
						echo json_encode([
							"success" => 0,
							"data" => [
								"message" => "Cập nhật thông tin thất bại"
							]
						]);
					}
				}

				else {
					if($account_model->update(
						[
							"account_id" => $_SESSION["loginUser"]["account_id"]
						],
						[
							"fullname" => $fullname,
							"sex" => $sex,
							"date_of_birth" => $date_of_birth
						]
					)) {
						echo json_encode([
							"success" => 1,
							"data" => [
								"message" => "Cập nhật thông tin thành công"
							]
						]);
					}

					else {
						echo json_encode([
							"success" => 0,
							"data" => [
								"message" => "Cập nhật thông tin thất bại"
							]
						]);
					}
				}
			}
		}
	}
}
?>
