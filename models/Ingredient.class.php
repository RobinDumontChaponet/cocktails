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

	public function getSubsName () {
		if(isset($this->getData()['sous-categorie']))
			return $this->getData()['sous-categorie'];
		return array();
	}
	public function getSupersName () {
		if(isset($this->getData()['super-categorie']))
			return $this->getData()['super-categorie'];
		return array();
	}

	public function getHierarchy () {
		if($s = IngredientDAO::getByChildIngredient($this))
			return $s[0]->getHierarchy().$s[0]->getLabel().' > ';
		return '';
	}

	// Functions
	public function __toString () {
		$str = '<article class="ingredient">'.PHP_EOL;
		$str.= '<h1>'.$this->getHierarchy().'<span class="self">'.$this->getLabel().'</span></h1>';

		$str.= '<section class="content">';
		if($subs = $this->getSubsName()) {
			$str.= '<ul title="Sous-ingredients">';
			foreach($subs as $sub)
				$str.= '<li><a href="ingredient/'.urlencode($sub).'">'.$sub.'</a></li>';
			$str.= '</ul>';
		} elseif($recipes = RecipeDAO::getByIngredient($this)) {
			$str.= '<ul title="Recettes">';
			foreach($recipes as $recipe)
				$str.= '<li><a href="recipe/'.$recipe->getId().'">'.$recipe->getTitle().'</a></li>';
			$str.= '</ul>';
		}
		$str.= '</section></article>';

		return $str;
	}
}

?>