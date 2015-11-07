<?php

require_once DATA_PATH.'Donnees.inc.php';

abstract class Wrapper { // This class is just a wrapper to access data (in data/Donnees.inc.php) more conveniently and more importantly in the same way as the other Objects !

	// Variables
	protected $key;
	public static $recipesData;
	public static $hierarchyData;

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
}

Wrapper::$recipesData = $Recettes;
Wrapper::$hierarchyData = $Hierarchie;

?>