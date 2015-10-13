<?php

require_once DATA_PATH.'Donnees.inc.php';

class Category { // This class is just a wrapper to access Recipes (in data/Donnees.inc.php) more conveniently and more importantly in the same way as the other Objects !

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


	public function getSubCategory () {
		return $this->getData()['sous-categorie'];
	}
	public function getSuperCategory () {
		return $this->getData()['super-categorie'];
	}


	// Functions
	public function __toString () {
		return 'Category(wrapper) [ ... ]';
	}
}

Recipe::$data = $Hierarchie;

?>