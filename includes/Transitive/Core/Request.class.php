<?php

namespace Transitive\Core;

class Request {
	private $presenterPath;
	private $viewPath;
	private $presenter;
	private $view;

	public function __construct ($presenterPath='', $viewPath='') {
		$this->presenterPath = $presenterPath;
		$this->viewPath = $viewPath;
		$this->presenter = new Presenter();
		$this->view = new View();
	}

	// - Getters_
	public function getPresenterPath () {
		return $this->presenterPath;
	}
	public function getViewPath () {
		return $this->viewPath;
	}

	public function getPresenter () {
		return $this->presenter;
	}

	public function getView () {
		return $this->view;
	}

	// - Setters_
	public function setPresenterPath ($path) {
		$this->presenterPath=$path;
	}
	public function setViewPath ($path) {
		$this->viewPath=$path;
	}

	public function setPresenter ($presenter) {
		$this->presenter=$presenter;
	}

	public function setView ($view) {
		$this->view=$view;
	}

	// - Extras_

	public function redirect ($gotoUrl, $delay=0) {
		if(!headers_sent() && $delay<=0)
			header('Location: '.$gotoUrl);
		else
			$this->view->addRawMetaTag('<meta http-equiv="refresh" content="'.$delay.'; url='.$gotoUrl.'">');
	}

	public function refresh () {
		$this->redirect($this->path);
	}

	public function goBack () {
		if(isset($_SESSION['referrer']))
			$this->redirect($_SESSION['referrer']);
	}

	public function execute () {
		function includePresenter (&$self) {
			$request = &$self;
			$presenter = $self->getPresenter();
			include $self->getPresenterPath();
		}
		function includeView (&$self) {
			if(!empty($self->getViewPath())) {
				$view = $self->getView();
				$view->setData($self->getPresenter()->data);
				include $self->getViewPath();
			}
		}

		includePresenter($this);
		includeView($this);
	}

	public function __debugInfo() {
		return array(
			'presenterPath' => $this->presenterPath,
			'viewPath' => $this->viewPath,
			'presenter' => $this->presenter,
			'view' => $this->view
		);
	}
}

?>