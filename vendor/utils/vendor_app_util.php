<?php
class vendor_app_util {
	public static function url($options=null) {
		if($options=='/')
			return 'index.php';
			
		global $app;
		if(!isset($options['area'])) {
			$options['area'] = $app["area"];
		} else 
		if(!isset($options['ctl'])) {
			$options['ctl'] = $app["ctl"];
		}
		$act = '';
		if(isset($options['act'])) {
			$act = '/'.$options['act'];
			//$options['act'] = $app['act'];
		}
		$params = '';
		if(isset($options['params']) and $options['params']) {
			foreach($options['params'] as $k=>$v) {
				$params .= '/'.$k.'='.$v;
			}
		}

		return RootREL.$options['area'].'/'.$options['ctl'].$act.$params;
	}
	
	public static function generatePassword($strPass, $strSalt = null) {
        if($strSalt) {
            $options = [
                "cost" => 11,
                "salt" => $strSalt
            ];
            return [
                "hashPass" => password_hash($strPass, PASSWORD_BCRYPT, $options)
            ];
        }
        else {
            $strSalt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
            $options = [
                "cost" => 11,
                "salt" => $strSalt
            ];
            return [
                "hashPass" => password_hash($strPass, PASSWORD_BCRYPT, $options),
                "strSalt" => $strSalt
            ];
        }
    }
}
?>
