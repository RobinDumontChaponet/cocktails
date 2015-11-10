<?php

class Category extends Wrapper { // This class is just a wrapper to access coctails Categories (in data/Donnees.inc.php) more conveniently and more importantly in the same way as the other Objects !

	// Helpers
	public static function getDataAt($key) {
		if(isset(self::$hierarchyData['Aliment']['sous-categorie'][$key]))
			return self::$hierarchyData['Aliment']['sous-categorie'][$key];
		return null;
	}
	private function getData() {
		return self::getDataAt($this->key);
	}

	// Getters
	public function getLabel () {
		return $this->getData();
	}

	public function getHierarchy () {
		if($s = CategoryDAO::getByChildIngredient($this))
			return $s[0]->getLabel().' > ';
		return '';
	}

	// Functions
	public function __toString () {
		$str = '<article class="category">'.PHP_EOL;
		$str.= '<h1>'.$this->getHierarchy().'<span class="self">'.$this->getLabel().'</span></h1>';
		$ingredients = IngredientDAO::getByCategory($this);

		$str.= '<section class="content">';
		if(empty($ingredients))
			$str.= '<p class="sad">Aucun ingredient.</p>';
		else {
			$str.= '<ul>';
			foreach($ingredients as $ingredient)
				$str.= '<li><a href="ingredient/'.urlencode($ingredient->getId()).'">'.$ingredient->getLabel().'</a></li>';
			$str.= '</ul>';
		}
		$str.= '</section></article>';

		return $str;
	}
}

?>