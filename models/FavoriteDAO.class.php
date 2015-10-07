<?php

require_once 'SPDO.class.php';
require_once MODELS_INC.'Favorite.class.php';

class FavoriteDAO {
	const tableName = 'favorite';

	public static function create ($favorite) {
		try {
			$statement = SPDO::getInstance()->prepare('INSERT INTO '.self::tableName.' (login, recipeId) values (?, ?)');
			$statement->bindParam(1, $favorite->getLogin());
			$statement->bindParam(2, $favorite->getRecipeId());
			$statement->execute();

			return $connect->lastInsertId();
		} catch (PDOException $e) {
			die('Error create Favorite : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function update ($favorite) {
		try {
			$statement = SPDO::getInstance()->prepare('UPDATE '.self::tableName.' SET recipeId=? WHERE login=?');
			$statement->bindParam(1, $favorite->getRecipeId());
			$statement->bindParam(2, $favorite->getLogin());
			$statement->execute();

			return $connect->lastInsertId();
		} catch (PDOException $e) {
			die('Error update Favorite : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function delete ($favorite) {
		try {
			$statement = SPDO::getInstance()->prepare('DELETE FROM '.self::tableName.' WHERE login=? AND recipeId=?');
			$statement->bindParam(1, $favorite->getLogin());
            $statement->bindParam(2, $favorite->getRecipeId());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error delete Favorite : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function getAll () {
		$users = array();
		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM '.self::tableName.'');

			$statement->execute();

			while ($rs = $statement->fetch(PDO::FETCH_OBJ))
				$favorites[]=new Favorite($rs->login, $rs->recipeId);
		} catch (PDOException $e) {
			die('Error : ' . $e->getMessage() . '<br/>');
		}
		return $users;
	}

	public static function getByLogin ($login) {
		$user = null;

		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM Favorite where login=?');
			$statement->bindParam(1, $login);
			$statement->execute();

			if($rs = $statement->fetch(PDO::FETCH_OBJ))
				$user=new Favorite($rs->login, $rs->recipeId);
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $user;
	}
}

?>
