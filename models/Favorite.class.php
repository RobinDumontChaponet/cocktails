<?php

class Favorite {

	// Variables
	private $login;
	private $recipeId;


	// Constructors
	public function __construct ($user, $recipeId) {
		$this->login=$user->getLogin();
		$this->recipeId=$recipeId;
	}

	// Getters
	public function getLogin () {
		return $this->login;
	}
	public function getRecipeId () {
		return $this->recipeId;
	}

	// Setters
	public function setUser ($user) {
		$this->login=$user->getLogin();
	}
	public function setLogin ($login) {
		$this->login=$login;
	}
	public function setRecipeId ($recipeId) {
		$this->recipeId=$recipeId;
	}

	// Functions
	public function __toString () {
		return 'Favorite [ login: '.$this->login.'; recipeId:'.$this->recipeId.' ]';
	}
}
?>
