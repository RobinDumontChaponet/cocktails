<?php

require_once 'SPDO.class.php';
require_once MODELS_INC.'User.class.php';

class UserDAO {
	const tableName = 'User';

	public static function create ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('INSERT INTO '.self::tableName.' (login, password, firstName, lastName, sex, email, birthDate, address, postalCode, city, phoneNumber ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$statement->bindParam(1, $user->getLogin());
			$statement->bindParam(2, $user->getPassword());
			$statement->bindParam(3, $user->getFirstName());
			$statement->bindParam(4, $user->getLastName());
			$statement->bindParam(5, $user->getSex());
			$statement->bindParam(6, $user->getEmail());
			$statement->bindParam(7, $user->getBirthDate());
			$statement->bindParam(8, $user->getAddress());
			$statement->bindParam(9, $user->getPostalCode());
			$statement->bindParam(10, $user->getCity());
			$statement->bindParam(11, $user->getPhoneNumber());
			$statement->execute();

		} catch (PDOException $e) {
			die('Error create User : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function update ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('UPDATE '.self::tableName.' SET password=?, firstName=?, lastName=?, sex=?, email=?, birthDate=?, address=?, postalCode=?, city=?, phoneNumber=?  WHERE login=?');
			$statement->bindParam(1, $user->getPassword());
			$statement->bindParam(2, $user->getFirstName());
			$statement->bindParam(3, $user->getLastName());
			$statement->bindParam(4, $user->getSex());
			$statement->bindParam(5, $user->getEmail());
			$statement->bindParam(6, $user->getBirthDate());
			$statement->bindParam(7, $user->getAddress());
			$statement->bindParam(8, $user->getPostalCode());
			$statement->bindParam(9, $user->getCity());
			$statement->bindParam(10, $user->getPhoneNumber());
			$statement->bindParam(11, $user->getLogin());
			$statement->execute();
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

		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM User where login=?');
			$statement->bindParam(1, $login);
			$statement->execute();

			if($rs = $statement->fetch(PDO::FETCH_OBJ))
				$user=new User($rs->login, $rs->password, $rs->firstName, $rs->lastName, $rs->sex, $rs->email, $rs->birthDate, $rs->address, $rs->postalCode, $rs->city, $rs->phoneNumber);
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $user;
	}
}

?>
