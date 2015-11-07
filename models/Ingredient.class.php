<?php

class Ingredient extends Wrapper { // This class is just a wrapper to access Ingredients (in data/Donnees.inc.php) more conveniently and more importantly in the same way as the other Objects !

	// Helpers
	public static function getDataAt($key) {
		if(isset(self::$hierarchyData[$key]))
			return self::$hierarchyData[$key];
		return null;
	}
	private function getData() {
		return self::getDataAt($this->key);
	}

	// Getters
	public function getLabel () {
		return $this->key;
	}

	public function getSubs () {
		if(isset($this->getData()['sous-categorie']))
			return $this->getData()['sous-categorie'];
		return array();
	}
	public function getSupers () {
		if(isset($this->getData()['super-categorie']))
			return $this->getData()['super-categorie'];
		return array();
	}

	// Functions
	public function __toString () {
		$str = '<article class="ingredient">'.PHP_EOL;
		$str.= '<h1>'.$this->getLabel().'</h1>';
		if($subs = $this->getSubs()) {
			$str.= '<h2>Sous-ingrédients</h2><ul>';
			foreach($subs as $sub)
				$str.= '<li><a href="ingredient/'.urlencode($sub).'">'.$sub.'</a></li>';
			$str.= '</ul>';
		} elseif($recipes = RecipeDAO::getByIngredient($this)) {
			$str.= '<h2>Recettes</h2><ul>';
			foreach($recipes as $recipe)
				$str.= '<li><a href="recipe/'.$recipe->getId().'">'.$recipe->getTitle().'</a></li>';
			$str.= '</ul>';
		}
		$str.= '</article>';

		return $str;
	}
}

?>