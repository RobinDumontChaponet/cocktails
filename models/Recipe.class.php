<?php

use \Transitive\Utils as Utils;

class Recipe extends Wrapper { // This class is just a wrapper to access Recipes (in data/Donnees.inc.php) more conveniently and more importantly in the same way as the other Objects !

	// Helpers
	public static function getDataAt($key) {
		if(isset(self::$recipesData[$key]))
			return self::$recipesData[$key];
		return null;
	}
	private function getData() {
		return self::getDataAt($this->key);
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
		$ingredients = array();
		foreach($this->getData()['index'] as $index)
			$ingredients[] = IngredientDAO::getById($index);

		return $ingredients;
	}

	public function getImagePath () {
		return WEB_DATA.'Photos/'.ucfirst(Utils\Strings::post_slug($this->getTitle())).'.jpg';
	}

	// Methods
	public function __toString () {
		//return ' Recipe(wrapper) [ title: '.$this->getTitle().'; quantities: '.$this->getQuantities().'; instructions: '.$this->getInstructions().'; ingredients: '.$this->getIngredients().' ] ';

		$str = '<article class="recipe">'.PHP_EOL;
		$str.= '	<h1>'.$this->getTitle().'</h1>'.PHP_EOL;
		if(FavoriteDAO::isFavorite($this))
			$str.= '	<a class="favorite-button remove" href="favorites/remove/'.$this->getId().'" title="Je n\'aime plus !">Supprimer des favoris</a>';
		else
			$str.= '	<a class="favorite-button add" href="favorites/add/'.$this->getId().'" title="J\'aime !">Ajouter aux favoris</a>';
		$str.= '	<section class="content">';

		if(file_exists($imagePath = $this->getImagePath()))
			$str.= '<figure><img src="'.$imagePath.'" alt="" /></figure>';

		$str.= '		<h2> Ingrédients : </h2>'."\n	".'<ul>';
		foreach(explode('|', $this->getQuantities()) as $quantity)
			$str.= '	<li>'.$quantity.'</li>';
		$str.= '		</ul>'.PHP_EOL;
		$str.= '		<h2> Préparation : </h2>'.PHP_EOL;
		$str.= '		<p>'.$this->getInstructions().'</p>'.PHP_EOL;

		$str.= '	</section>';
		$str.= '	<ul>'.PHP_EOL;
		foreach ($this->getIngredients() as $ingredient)
			$str.= '		<li class="tag"><a href="ingredient/'.urlencode($ingredient->getId()).'">'.$ingredient->getLabel().'</a></li>';
		$str.= '	</ul>'.PHP_EOL;
		$str.= '</article>'.PHP_EOL;

		return $str;
	}
}

?>