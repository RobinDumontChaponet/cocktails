<?php

namespace Transitive\Core;

class Request {
	private $controllerPath;
	private $viewPath;
	private $controller;
	private $view;

	public function __construct ($controllerPath='', $viewPath='') {
		$this->controllerPath = $controllerPath;
		$this->viewPath = $viewPath;
		$this->controller = new Controller();
		$this->view = new View();
	}

	// - Getters_
	public function getControllerPath () {
		return $this->controllerPath;
	}
	public function getViewPath () {
		return $this->viewPath;
	}

	public function getController () {
		return $this->controller;
	}

	public function getView () {
		return $this->view;
	}

	// - Setters_
	public function setControllerPath ($path) {
		$this->controllerPath=$path;
	}
	public function setViewPath ($path) {
		$this->viewPath=$path;
	}

	public function setController ($controller) {
		$this->controller=$controller;
	}

	public function setView ($view) {
		$this->view=$view;
	}

	// - Extras_

	function redirect ($gotoUrl, $delay=0) {
		if(!headers_sent() && $delay<=0)
			header('Location: '.$gotoUrl);
		else
			$this->view->addRawMetaTag('<meta http-equiv="refresh" content="'.$delay.'; url='.$gotoUrl.'">');
	}

	function refresh () {
		$this->redirect($this->path);
	}

	public function goBack () {
		if(isset($_SESSION['referrer']))
			$this->redirect($_SESSION['referrer']);
	}

	public function execute () {
		function includeController ($self) {
			$request = &$self;
			$controller = $self->getController();
			include $self->getControllerPath();
		}
		function includeView (&$self) {
			if(!empty($self->getViewPath())) {
				$view = $self->getView();
				$view->setData($self->getController()->data);
				include $self->getViewPath();
			}
		}

		includeController($this);
		includeView($this);
	}

	public function __toString() {
		// @TODO
		return 'Request [ vars…_ ] ';
	}
}

?>