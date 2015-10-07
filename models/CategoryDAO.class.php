<?php

require_once MODELS_INC.'Category.class.php';

class CategoryDAO { // This class is just a wrapper to access Recipes (in data/Donnees.inc.php) more conveniently !

	/**
	 * getAll function. Get all Recipe Objects. In fact it is only to use a more modern and convenient way to access data. For the sake of coherence !
	 *
	 * @access public
	 * @static
	 * @return Recipe Objects Array
	 */
	public static function getAll () {
		$categories = array();

		$keys = array_keys(Category::$data);

		if(!empty($keys))
			foreach($keys as $key)
				$categories[] = new Category($key);

		return $categories;
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
		return new Category($id);
	}
}

?>