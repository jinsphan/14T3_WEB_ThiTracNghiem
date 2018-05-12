<?php
class vendor_main_controller {
	protected $layout = "";
	protected $model; 
	protected $controller = "home";
	protected $action = "index";
	public	  $components;
	//protected $htmlhp;
	
	public function  __construct() {
		global $app;
		$this->controller = $app['ctl'];
		if(isset($app['act'])) $this->action = $app['act'];
		if(method_exists($this, $this->action)) {
			if($this->action=='view' || $this->action=='edit' || $this->action=='del') {
				$id='';
				if(isset($app['prs'][1]))	$id=$app['prs'][1];
				$this->{$this->action}($id);
			} else {
				if(isset($app['prs']) && count($app['prs'])) {
					$this->{$this->action}($app['prs']);
				} else $this->{$this->action}();
			}
		} else {
			include "views/staticpages/error.php";
		}
	}
	
	public function display($options=null) {
		global $app;
		if(!isset($options['ctl']))	$options['ctl'] = $this->controller;
		if(!isset($options['act']))	$options['act'] = $this->action;
		include_once "views/".$app['areaPath'].$options['ctl']."/".$options['act'].".php";
	}

	public function uploadImg($flies, $newSize=null) {
		$t=time();
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $flies["image"]["name"]);
		$extension = end($temp);
		if ((($flies["image"]["type"] == "image/gif")
			|| ($flies["image"]["type"] == "image/jpeg")
			|| ($flies["image"]["type"] == "image/jpg")
			|| ($flies["image"]["type"] == "image/pjpeg")
			|| ($flies["image"]["type"] == "image/x-png")
			|| ($flies["image"]["type"] == "image/png"))
			&& ($flies["image"]["size"] < 200000000)
			&& in_array($extension, $allowedExts))
		{
			if ($flies["image"]["error"] > 0) {
				//var_dump($flies["image"]["error"]);
				echo 'error';
				return false;
		    }
			$ulfd = RootURI."/media/upload/" .$this->controller.'/';
			$newfn = time().rand(10000,99999).'.'.$extension;
		    if (file_exists($ulfd . $newfn)) {
		      	return true;
		    } else {
		        move_uploaded_file($flies["image"]["tmp_name"], $ulfd.$newfn);
				$SimpleImg = new SimpleImage_Component();
				$SimpleImg->load($ulfd.$newfn);
				if(isset($newSize['height']) && !isset($newSize['width'])) {
					$SimpleImg->resizeToHeight($newW);
				} else {
					$newW = 200;
					if(isset($newSize['width'])) {
						$newW = $newSize['width'];
					}
					$SimpleImg->resizeToWidth($newW);
				}
				$SimpleImg->save($ulfd.$newfn);
				return $newfn;
		    }
		} else {
			echo "Invalid file";
			return false;
		}
	}
	
    public function setProperty($name, $value) {
        $this->$name = $value;
    }
    
    public function checkAuth () {
		if (!isset($_SESSION['loginUser']['username'])) {
			header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
		}
    }
}
?>
