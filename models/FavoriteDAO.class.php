<?php

require_once 'SPDO.class.php';
require_once MODELS_INC.'Favorite.class.php';

class FavoriteDAO {
	const tableName = 'favorite';

	/**
	 * create function. Insert new entry for $favorite un db.
	 *
	 * @access public
	 * @static
	 * @param Favorite Object - $favorite
	 * @return void
	 */
	public static function create ($favorite) {
		try {
			$statement = SPDO::getInstance()->prepare('INSERT INTO '.self::tableName.' (login, recipeId) values (?, ?)');
			$statement->bindValue(1, $favorite->getLogin());
			$statement->bindValue(2, $favorite->getRecipeId());
			$statement->execute();

			return $connect->lastInsertId();
		} catch (PDOException $e) {
			die('Error create Favorite : ' . $e->getMessage() . '<br/>');
		}
	}

	/**
	 * Well it will not be used anyway...
	 */
	public static function update ($favorite) {
		try {
			$statement = SPDO::getInstance()->prepare('UPDATE '.self::tableName.' SET recipeId=? WHERE login=?');
			$statement->bindValue(1, $favorite->getRecipeId());
			$statement->bindValue(2, $favorite->getLogin());
			$statement->execute();

			return $connect->lastInsertId();
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
		try {
			$statement = SPDO::getInstance()->prepare('DELETE FROM '.self::tableName.' WHERE login=? AND recipeId=?');
			$statement->bindValue(1, $favorite->getLogin());
            $statement->bindValue(2, $favorite->getRecipeId());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error delete Favorite : ' . $e->getMessage() . '<br/>');
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
			$statement = SPDO::getInstance()->prepare('SELECT * FROM '.self::tableName.'');
			$statement->execute();

			while ($rs = $statement->fetch(PDO::FETCH_OBJ))
				$favorites[] = new Favorite((object)array('login' => $rs->login), $rs->recipeId);
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
			$statement = SPDO::getInstance()->prepare('SELECT * FROM Favorite where login=?');
			$statement->bindValue(1, $user->getLogin());
			$statement->execute();

			if($rs = $statement->fetch(PDO::FETCH_OBJ))
				$favorites[] = new Favorite($user, $rs->recipeId);
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $favorites;
	}

	/**
	 * setUserFavorites function. Delete Fav in db if not in $favorites and create if not in db
	 *
	 * @access public
	 * @static
	 * @param User object - $user
	 * @param Favorite Objects Array - $favorites
	 * @return void
	 */
	public static function setUserFavorites ($user, $favorites) {
		$existingFavorites = self::getByUser($user);
		foreach($existingFavorites as $favorite) {
			if(($key = array_search($favorite, $favorites)) === false)
				self::delete($favorite);
			else
				unset($favorites[$key]);
		}
		foreach($favorites as $favorite) {
			self::create($favorite);
		}
	}
}

?>
