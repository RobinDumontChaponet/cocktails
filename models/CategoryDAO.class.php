<?php

//require_once MODELS_INC.'Category.class.php';

class CategoryDAO { // This class is just a wrapper to access Categories (in data/Donnees.inc.php) more conveniently !

	/**
	 * getAll function. Get all Recipe Objects. In fact it is only to use a more modern and convenient way to access data. For the sake of coherence !
	 *
	 * @access public
	 * @static
	 * @return Recipe Objects Array
	 */
	public static function getAll () {
		$categories = array();

		foreach(Category::$hierarchyData['Aliment']['sous-categorie'] as $key => $categoy)
			$categories[] = new Category($key);

		return $categories;
	}

	public static function getByChildIngredient($child) {
		$ingredients = array();

		foreach(Ingredient::$hierarchyData as $key => $ingredient)
			if(isset($ingredient['sous-categorie']) && in_array($child->getLabel(), $ingredient['sous-categorie']))
				$ingredients[] = new Ingredient($key);

		return $ingredients;
	}

	/**
	 * getById function. Get Recipe Object by id in array. In fact it is only to use a more modern and convenient way to access data. For the sake of coherence !
	 *
	 * @access public
	 * @static
	 * @param int id - $id
	 * @return Recipe Object
	 */
	public static function getById ($id) {
		if(Category::getDataAt($id))
			return new Category($id);
		return null;
	}
}

?>