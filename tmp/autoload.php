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
	switch ($lastCL) {
		case 'controller': {			
			$filename .= "controllers/".$areaPath. $classname .".php";
        	break;
		}
		case 'model': {
			$filename .= "models/". $classname .".php";
        	break;
		}	
		case 'helper':
			$filename = "views/helpers/". $classname .".php";
        	break;
		case 'component': {
			$comFolder = str_split($classname, strrpos($classname, '_'))[0];
			$filename = "components/".$comFolder.'/'. $classname .".php";
        	break;
		}
		default:	$filename = "controllers/staticpages_controller.php";
	}
	if (is_file($filename)) {
    	include_once($filename);
	} else {
		include_once("controllers/staticpages_controller.php");
	}
}
