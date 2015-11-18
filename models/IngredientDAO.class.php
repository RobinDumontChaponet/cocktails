<?php

class IngredientDAO { // This class is just a wrapper to access Ingredient Objects (in data/Donnees.inc.php) more conveniently !

	/**
	 * getAll function. Get all Ingredient Objects. In fact it is only a more modern and convenient way to access data. For the sake of coherence !
	 *
	 * @access public
	 * @static
	 * @return Ingredient Objects Array
	 */
	public static function getAll () {
		$ingredients = array();

		$keys = array_keys(Ingredient::$hierarchyData);

		if(!empty($keys))
			foreach($keys as $key)
				$ingredients[] = new Ingredient($key);

		return $ingredients;
	}

	public static function getByCategory ($category) {
		$ingredients = array();

		foreach(Ingredient::$hierarchyData as $key => $ingredient)
			if(isset($ingredient['super-categorie']) && in_array($category->getLabel(), $ingredient['super-categorie']))
				$ingredients[] = new Ingredient($key);

		return $ingredients;
	}

	public static function getByChildIngredient($child) {
		$ingredients = array();

		foreach(Ingredient::$hierarchyData as $key => $ingredient)
			if(isset($ingredient['sous-categorie']) && in_array($child->getLabel(), $ingredient['sous-categorie']))
				$ingredients[] = new Ingredient($key);

		return $ingredients;
	}

	/**
	 * getById function. Get Ingredient Object by id in array. In fact it is only a more modern and convenient way to access data. For the sake of coherence !
	 *
	 * @access public
	 * @static
	 * @param int id - $id
	 * @return Ingredient Object
	 */
	public static function getById ($id) {
		if(Ingredient::getDataAt($id))
			return new Ingredient($id);
		return null;
	}
}

?>