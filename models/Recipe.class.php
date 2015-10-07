<?php

require_once DATA_PATH.'Donnees.inc.php';
require 'strings.transit.inc.php';

class Recipe { // This class is just a wrapper to access Recipes (in data/Donnees.inc.php) more conveniently and more importantly in the same way as the other Objects !

	// Variables
	private $key;
	public static $data;

	// Helpers
	public static function getDataAt($key) {
		return self::$data[$key];
	}
	private function getData() {
		return self::getDataAt($this->key);
	}

	// Constructors
	public function __construct ($key) {
		$this->key=$key;
	}

	// Getters
	public function getId () {
		return $this->key;
	}
	public function getTitle () {
		return $this->getData()['titre'];
	}
	public function getQuantities () {
		return $this->getData()['ingredients'];
	}
	public function getInstructions () {
		return $this->getData()['preparation'];
	}
	public function getIngredients () {
		return $this->getData()['index'];  // @TODO ?
	}

	public function getImagePath () {
		return WEB_DATA.'Photos/'.post_slug($this->getTitle()).'.jpg';
	}

	// Methods
	public function __toString () {
		//return ' Recipe(wrapper) [ title: '.$this->getTitle().'; quantities: '.$this->getQuantities().'; instructions: '.$this->getInstructions().'; ingredients: '.$this->getIngredients().' ] ';

		$str = '<article class="recipe">'.PHP_EOL;
		$str.= '	<h1>'.$this->getTitle().'</h1>'.PHP_EOL; // Titre
		$str.= '	<h2> Ingrédients : </h2>'."\n	".'<ul>';
		foreach(explode('|', $this->getQuantities()) as $quantity)
			$str.= '<li>'.$quantity.'</li>';
		$str.= '	</ul>'.PHP_EOL;
		$str.= '	<h2> Préparation : </h2>'.PHP_EOL;
		$str.= '	<p>'.$this->getInstructions().'</p>'.PHP_EOL;
		$str.= '	<h2>Index : </h2>'.PHP_EOL;
		$str.= '	<ul>'.PHP_EOL;
		foreach ($this->getIngredients() as $index)
			$str.= '		<li><a href="#">'.$index.'</a></li>';
		$str.= '	</ul>'.PHP_EOL;

		if(file_exists($imagePath = $this->getImagePath()))
			$str.= '<img src="'.$imagePath.'" alt="" />';

		$str.= '</article>'.PHP_EOL;

		return $str;
	}
}

Recipe::$data = $Recettes;

?>