<?php

require_once 'SPDO.class.php';
require MODELS_INC.'User.class.php';

class UserDAO {
	const tableName = 'User';

	public static function create ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('INSERT INTO '.self::tableName.' (login, password) values (?, ?)');
			$statement->bindParam(1, $user->getLogin());
			$statement->bindParam(2, $user->getPassword());
			$statement->execute();

			return $connect->lastInsertId();
		} catch (PDOException $e) {
			die('Error create User : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function update ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('UPDATE '.self::tableName.' SET password=? WHERE login=?');
			$statement->bindParam(1, $user->getPassword());
			$statement->bindParam(2, $user->getLogin());
			$statement->execute();

			return $connect->lastInsertId();
		} catch (PDOException $e) {
			die('Error update User : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function delete ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('DELETE FROM '.self::tableName.' WHERE login=?');
			$statement->bindParam(1, $user->getLogin());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error delete User : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function getAll () {
		$users = array();
		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM '.self::tableName.'');

			$statement->execute();

			while ($rs = $statement->fetch(PDO::FETCH_OBJ))
				$users[]=new User($rs->login, $rs->password);
		} catch (PDOException $e) {
			die('Error : ' . $e->getMessage() . '<br/>');
		}
		return $users;
	}

	public static function getByLogin ($login) {
		$user = null;

		var_dump('argh2');

		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM User where login=?');
			$statement->bindParam(1, $login);
			$statement->execute();

			if($rs = $statement->fetch(PDO::FETCH_OBJ))
				$user=new User($rs->login, $rs->password);
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $user;
	}
}

?>
