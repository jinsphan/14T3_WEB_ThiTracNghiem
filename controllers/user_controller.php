<?php
class user_controller extends main_controller
{
	
	public function logout() 
	{
        session_destroy();
        header("Location: /");
	}
}
?>
