<?php
session_start();
$app['ctl'] = "home";
$prs = [];

if(isset($_GET["pr"])) {
	$prs = explode("/",$_GET["pr"]);
} else {
	if($_SERVER['PHP_SELF']!="/index.php") {
		$prs = explode("/",substr($_SERVER["REQUEST_URI"], 1));
	}
}

$noPrs = count($prs);
if($noPrs) {
	// Check if admin area
	if(isset($prs[0]) && $prs[0]=="admin") {
		$app['area'] = 'admin';
		$app['areaPath'] = 'admin/';
		array_shift($prs);
		$noPrs--;
	}
	$app['ctl'] = $prs[0];
	if(isset($prs[0])) $app['ctl'] = $prs[0];
	if(isset($prs[1])) $app['act'] = $prs[1];
	if($noPrs>2) {
		$app['prs'] = [];
		for($i=2; $i<$noPrs; $i++) {
			if(!isset(explode("=", $prs[$i])[1]))
				$app['prs'][$i-1] = $prs[$i];
			else
				$app['prs'][explode("=", $prs[$i])[0]] = explode("=", $prs[$i])[1];
		}
	}
}


$c = $app['ctl']."_controller";

if(!is_file(ControllerREL.$app['areaPath'].$c.".php")) {
	$c = "staticpages_controller";
	$app['ctl'] = "staticpages";	
	$app['act'] = "error";
}

$controller = new $c();
