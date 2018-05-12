<?php
function __autoload($classname) {
	global $app;
	$arrCL 		= explode("_",$classname);
	$firstCL 	= $arrCL[0];
	$lastCL		= $arrCL[count($arrCL) - 1];
	$filename = "";
	$areaPath = $app['areaPath'];
	if($firstCL == "vendor") {
		$filename = "vendor/";
		$areaPath = "";
	}
	if($firstCL == "html" && $lastCL == "helper") {
		$filename = "views/";
		$areaPath = "";
	}
	$filename .= $lastCL."s/".$areaPath. $classname .".php";
	if (is_file($filename)) {
    	include_once($filename);
	} else {
		include_once("controllers/staticpages_controller.php");
	}
}

