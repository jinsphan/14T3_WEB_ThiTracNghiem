<?php
class html_helper{
	public static function url($options=null) {
		if($options=='/')
			return 'index.php';
			
		global $app;
		if(!isset($options['area'])) {
			$options['area'] = $app["areaPath"];
		}
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
		return "/".$options['ctl'].$act.$params;
	}
}
?>
