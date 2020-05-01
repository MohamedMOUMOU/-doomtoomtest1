<?php
// App Core Class
// Creates URL & loads core controller
// URL Format - /controller/method/params
class Core{
	protected $currentController = 'pages';
	protected $currentMethod = 'index';
	protected $params = [];
	public function __construct(){
		// print_r($this->getUrl());
		$url = $this->getUrl();
		// Look in controllers for first value
		if(file_exists('../app/controllers/' . ucwords($url[0] ). '.php')){
			// if exists, set as controller
			$this->currentController = ucwords($url[0]);
			// Unset 0 index
			unset($url[0]);
		// require the controller
		require_once '../app/controllers/' . $this->currentController . '.php';
		// Instantiate controller class
		$this->currentController = new $this->currentController;
		// Check for second part of te url
		if(isset($url[1])){
			// Check to see if method exists
			if(method_exists($this->currentController, $url[1])){
				$this->currentMethod = $url[1];
				// unset 1 index
				unset($url[1]);
			}
		}
		// Get params
		$this->params = $url ? array_values($url) : [];
		// Call a callback wit array of params
		call_user_func_array([$this->currentController,$this->currentMethod], $this->params);
		// Get params
		$this->params = $url ? array_values($url) : [];
		// Call a callback wit array of params
		call_user_func_array([$this->currentController,$this->currentMethod], $this->params);
		}
		elseif($url[0] == "api" && is_dir('../app/api/' . $url[1]) && file_exists('../app/api/' . $url[1] . "/" . $url[2])){
			// echo "it worked";
			include '../app/api/' . $url[1] . '/' . $url[2];
		}
	}
	public function getUrl(){
		if(isset($_GET['url'])){
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}
}
?>