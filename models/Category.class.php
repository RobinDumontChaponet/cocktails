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
		$str.= '<div class="subs"><h2>Filtres</h2>';
		if(empty($ingredients))
			$str.= '<p class="sad">Aucun filtre applicable.</p>';
		else {
			$str.= '<ul title="Sous-ingredients">';
			foreach($ingredients as $ingredient)
				$str.= '<li><a href="ingredient/'.urlencode($ingredient->getId()).'">'.$ingredient->getLabel().'</a></li>';
			$str.= '</ul>';
		}
		$str.= '</div>';
		$str.= '<div class="recipes"><h2>Recettes</h2>';
		if($recipes = RecipeDAO::getByCategory($this)) {
			$str.= '<ul title="Recettes">';
			foreach($recipes as $recipe)
				$str.= '<li><a href="recipe/'.$recipe->getId().'">'.$recipe->getTitle().'</a></li>';
			$str.= '</ul>';
		} else
			$str.= '<p class="sad">Aucune recette à afficher.</p>';
		$str.= '</div>';
		$str.= '</section></article>';

		return $str;
	}
}

?>