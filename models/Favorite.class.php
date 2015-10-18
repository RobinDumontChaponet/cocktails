<?php

class Favorite {

	// Variables
	private $login;
	private $recipe;

	// Constructors
	public function __construct ($recipe, $user) {
		$this->login=$user->getLogin();
		$this->recipe=$recipe;
	}

	// Getters
	public function getLogin () {
		return $this->login;
	}
	public function getRecipe () {
		return $this->recipe;
	}

	// Setters
	public function setUser ($user) {
		$this->login=$user->getLogin();
	}
	public function setLogin ($login) {
		$this->login=$login;
	}
	public function setRecipe ($recipe) {
		$this->recipe=$recipe;
	}

	// Methods
	public function __toString () {
		//return ' Favorite [ login: '.$this->login.'; recipe:'.$this->recipe.' ] ';

		$str = '<article class="favorite">'.PHP_EOL;
		$str.= '		<h1>'.$this->getRecipe()->getTitle().'</h1>'; // Titre

		$str.= '<a href="#" title="">x</a>'.PHP_EOL;

		$str.= '	</article>'.PHP_EOL;

		return $str;
	}
}

?>