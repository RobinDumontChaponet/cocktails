<?php

require_once MODELS_INC.'Recipe.class.php';

class RecipeDAO { // This class is just a wrapper to access Recipes (in data/Donnees.inc.php) more conveniently !

	/**
	 * getAll function. Get all Recipe Objects. In fact it is only to use a more modern and convenient way to access data. For the sake of coherence !
	 *
	 * @access public
	 * @static
	 * @return Recipe Objects Array
	 */
	public static function getAll () {
		$recipes = array();

		$keys = array_keys(Recipe::$data);

		if(!empty($keys))
			foreach($keys as $key)
				$recipes[] = new Recipe($key);

		return $recipes;
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
		return new Recipe($id);
	}

	/**
	 * getByIngredient function. Get Recipe Objects by ingredient(string) in array. In fact it is only to use a more modern and convenient way to access data. For the sake of coherence !
	 *
	 * @access public
	 * @static
	 * @param int id - $id
	 * @return Recipe Objects Array
	 */
	public static function getByIngredient ($ingredient) {
		$recipes = array();

		if(!empty(Recipe::$data))
			foreach(Recipe::$data as $key => $recipeData)
				if(in_array($ingredient, $recipeData['index']))
					$recipes[] = new Recipe($key);

		return $recipes;
	}
}

?>