<?php

namespace Transitive\Core;

if (!function_exists('http_response_code')) {
	function http_response_code($newcode = NULL) {
		static $code = 200;
		if($newcode !== NULL) {
			header('X-PHP-Response-Code: '.$newcode, true, $newcode);
			if(!headers_sent())
				$code = $newcode;
		}
		return $code;
	}
}

class FrontController {
	public static $controllerIncludePath;
	public static $viewIncludePath;
	public static $defaultRequestUrl='index';
	private $requestUrl;
	private $request;

	public function __construct ($requestUrl='') {
		$this->requestUrl = (!empty($requestUrl))?$requestUrl:self::$defaultRequestUrl;
		$this->request = new Request(self::$controllerIncludePath.$this->requestUrl.'.controller.php', self::$viewIncludePath.$this->requestUrl.'.view.php');
	}

	// - Getters_

	public function getRequestUrl () {
		return $this->requestUrl;
	}

	public function getRequest () {
		return $this->request;
	}

	// - Setters_

	public function setRequestUrl ($requestUrl) {
		$this->requestUrl = $requestUrl;
	}

	public function setRequest ($request) {
		$this->request = $request;
	}

	// - Other methods_


	public function execute () {
		if(!is_file($this->request->getControllerPath())) {
			http_response_code(404);
			$_SERVER['REDIRECT_STATUS'] = 404;

			$this->request->setControllerPath(self::$controllerIncludePath.'genericHttpErrorHandler.controller.php');
			if(!is_file(self::$viewIncludePath.'genericHttpErrorHandler.view.php'))
				$this->request->setViewPath('');
			else
				$this->request->setViewPath(self::$viewIncludePath.'genericHttpErrorHandler.view.php');
		}
		$this->request->execute();
	}


	public function printMetas () {
		$this->request->getView()->printMetaTags();
	}
	public function printTitle ($separator=' | ', $endSeparator='') {
		if(!empty($title = $this->request->getView()->getTitle()))
			echo '<title>'.$separator.$title.$endSeparator.'</title>';
	}
	public function printStyle () {
		$this->request->getView()->printStyle();
	}
	public function printScripts () {
		$this->request->getView()->printScripts();
	}
	public function displayContent ($key=NULL) {
		$this->request->getView()->displayContent($key);
	}

	public function outputJson () {
		if(!headers_sent()) {
			header('Content-Type: application/json');
		}

		$this->request->getView()->outputJson();
	}
	public function displayJsonContent () {
		if(!headers_sent()) {
			header('Content-Type: application/json');
		}

		$this->request->getView()->displayJsonContent();
	}

	public function __toString() {
		// @TODO
		return 'Transitive [ vars…_ ] ';
	}

	function __destruct() {
		if(session_status()!=PHP_SESSION_NONE && $this->getRequestUrl()!='login')
			$_SESSION['referrer'] = $this->getRequestUrl();
	}
}

FrontController::$controllerIncludePath = ROOT_PATH.'/controllers/';
FrontController::$viewIncludePath = ROOT_PATH.'/views/';

?>