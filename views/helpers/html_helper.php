<?php
class html_helper{
	public static function url($options=null) {
		if($options=='/')
			return 'index.php';
			
		global $app;
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
			if(html_helper::isAssoc($options["params"]))
				foreach($options['params'] as $k=>$v) {
					$params .= '/'.$k.'='.$v;
				}
			else
				$params = implode("/", $options["params"]);
		}
		return "/".$options['ctl'].$act.$params;
	}

	protected static function isAssoc(array $arr) {
		if(array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
}
?>
