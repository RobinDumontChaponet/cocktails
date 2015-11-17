<?php

use \Transitive\Utils\Database as DB;

class FavoriteDAO {
	const tableName = 'favorite';
	private static function getTableName () {
		return DB::$tablePrefix.self::tableName;
	}

	/**
	 * create function. Insert new entry for $favorite in db.
	 *
	 * @access public
	 * @static
	 * @param Favorite Object - $favorite
	 * @return void
	 */
	public static function create ($favorite) {
		try {
			$statement = DB::getInstance()->prepare('INSERT INTO '.self::getTableName().' (login, recipeId) values (?, ?)');
			$statement->bindValue(1, $favorite->getLogin());
			$statement->bindValue(2, $favorite->getRecipe()->getId());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error create Favorite : ' . $e->getMessage() . '<br/>');
		}
	}

	/**
	 * Well it will not be used anyway...
	 */
	public static function update ($favorite) {
		try {
			$statement = DB::getInstance()->prepare('UPDATE '.self::getTableName().' SET recipeId=? WHERE login=?');
			$statement->bindValue(1, $favorite->getRecipe()->getId());
			$statement->bindValue(2, $favorite->getLogin());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error update Favorite : ' . $e->getMessage() . '<br/>');
		}
	}

	/**
	 * delete function. Delete $favorite in db.
	 *
	 * @access public
	 * @static
	 * @param Favorite Object - $favorite
	 * @return void
	 */
	public static function delete ($favorite) {
		if(!empty($favorite)) {
			try {
				$statement = DB::getInstance()->prepare('DELETE FROM '.self::getTableName().' WHERE login=? AND recipeId=?');
				$statement->bindValue(1, $favorite->getLogin());
	            $statement->bindValue(2, $favorite->getRecipe()->getId());
				$statement->execute();
			} catch (PDOException $e) {
				die('Error delete Favorite : ' . $e->getMessage() . '<br/>');
			}
		}
	}

	/**
	 * getAll function. Get all Favorite in db.
	 *
	 * @access public
	 * @static
	 * @return Favorite Objects Array
	 */
	public static function getAll () {
		$favorites = array();
		try {
			$statement = DB::getInstance()->prepare('SELECT * FROM '.self::getTableName().'');
			$statement->execute();

			while ($rs = $statement->fetch(PDO::FETCH_OBJ)) {
				$recipe = RecipeDAO::getById($rs->recipeId);
				$favorites[$rs->recipeId] = new Favorite($recipe, (object)array('login' => $rs->login));
			}
		} catch (PDOException $e) {
			die('Error : ' . $e->getMessage() . '<br/>');
		}
		return $favorites;
	}

	/**
	 * getByUser function. Get all Favorite of $user in db.
	 *
	 * @access public
	 * @static
	 * @param User object - $user
	 * @return Favorite Objects Array
	 */
	public static function getByUser ($user) {
		$favorites = array();

		try {
			$statement = DB::getInstance()->prepare('SELECT * FROM '.self::getTableName().' where login=?');
			$statement->bindValue(1, $user->getLogin());
			$statement->execute();

			while ($rs = $statement->fetch(PDO::FETCH_OBJ)) {
				$recipe = RecipeDAO::getById($rs->recipeId);
				$favorites[$rs->recipeId] = new Favorite($recipe, $user);
			}
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $favorites;
	}

	/**
	 * sync function. Push saved Favorites from db to $favorites and create Fav from $favorites if not already in db
	 *
	 * @access public
	 * @static
	 * @param User object - $user
	 * @param Favorite Objects Array - $favorites
	 * @return void
	 */
	public static function sync () {
		$savedFavorites = self::getByUser($_SESSION['cocktailsUser']);

		if(isset($_SESSION['cocktailsFavorites']) && count($_SESSION['cocktailsFavorites']))
			foreach($_SESSION['cocktailsFavorites'] as $key => $favorite) {
				if(!isset($savedFavorites[$key])) {
					$favorite->setUser($_SESSION['cocktailsUser']);
					self::create($favorite);
				}
				$savedFavorites[$key] = $favorite;
			}

		$_SESSION['cocktailsFavorites'] = $savedFavorites;
	}


	public static function addById ($recipeId) {
		if(!isset($_SESSION['cocktailsFavorites']))
			$_SESSION['cocktailsFavorites'] = array();

		if(isset($_SESSION['cocktailsFavorites'][$recipeId]))
			return false;

		$favorite = new Favorite(RecipeDAO::getById($recipeId));
		$_SESSION['cocktailsFavorites'][$recipeId] = $favorite;

		if(isset($_SESSION['cocktailsUser'])) {
			$favorite->setUser($_SESSION['cocktailsUser']);
			self::create($favorite);
		}
	}

	public static function removeById ($recipeId) {
		if(isset($_SESSION['cocktailsFavorites'][$recipeId])) {
/*			$favorite = null;

			foreach($_SESSION['cocktailsFavorites'] as $item) {
				var_dump('argh3');
				if ($item->getRecipe()->getId() == $recipe->getId()) {
					var_dump('argh4');
					$favorite = $item;
					break;
				}
			}
			$favorite = $_SESSION['cocktailsFavorites'][$recipeId];
*/
				self::delete($_SESSION['cocktailsFavorites'][$recipeId]);
				unset($_SESSION['cocktailsFavorites'][$recipeId]);
		}
	}

	public static function isFavorite ($recipe) {
		return isset($_SESSION['cocktailsFavorites'][$recipe->getId()]);
	}
}

?>