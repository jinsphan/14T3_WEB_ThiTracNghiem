<?php
class vendor_auth_model extends vendor_main_model {
	//public static function login($username, $password) {
	public function login($user) {
		$email = $user['email'];
		$password = vendor_app_util::generatePassword($user['password']);
		$query = "SELECT * FROM `users` WHERE (`email` = '".$email."') & (`password` = '".$password."')";
		$result = mysqli_query($this->con,$query);
		if ($result->num_rows > 0) {
			$_SESSION['loginUser'] = mysqli_fetch_array($result); 
			return 1;
		}
		return 0;
	}
}
	
