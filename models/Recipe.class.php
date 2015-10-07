<?php

require_once DATA_PATH.'Donnees.inc.php';

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

	// Functions
	public function __toString () {
		return 'Recipe(wrapper) [ ... ]';
	}
}

Recipe::$data = $Recettes;

?>