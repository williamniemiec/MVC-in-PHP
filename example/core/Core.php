<?php
class Core {
	public function run(){
		$params = array();

		// Controller
		$url = '/';
		if(isset($_GET['url']) && !empty($_GET['url']) && $_GET['url'] != '/'){
			$url .= $_GET['url'];
		}

		if($url != '/'){
			$url = explode("/", $url);
			array_shift($url);

			$currentController = $url[0]."Controller";
			array_shift($url);

			// Action
			if(!empty($url[0])){
				$currentAction = $url[0];
				array_shift($url);
			} else {
				$currentAction = 'index';	
			}

			// Params
			if(!empty($url[0])){
				$params = $url;
			}
		} else {
			$currentController = 'homeController';
			$currentAction = 'index';
		}

		$c = new $currentController();
		call_user_func_array(array($c, $currentAction), $params);
	}
}