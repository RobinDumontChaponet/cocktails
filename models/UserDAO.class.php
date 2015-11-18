<?php

use \Transitive\Utils\Database as DB;

class UserDAO {
	const tableName = 'User';
	private static function getTableName () {
		return DB::$tablePrefix.self::tableName;
	}

	public static function create ($user) {
		if($user->getBirthDate()=='00/00/0000')
			$user->setBirthDate(null);

		try {
			$statement = DB::getInstance()->prepare('INSERT INTO '.self::getTableName().' (login, password, firstName, lastName, sex, email, birthDate, address, postalCode, city, phoneNumber ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$statement->bindValue(1, $user->getLogin());
			$statement->bindValue(2, $user->getPassword());
			$statement->bindValue(3, $user->getFirstName());
			$statement->bindValue(4, $user->getLastName());
			$statement->bindValue(5, $user->getSex());
			$statement->bindValue(6, $user->getEmail());
			$statement->bindValue(7, $user->getBirthDate());
			$statement->bindValue(8, $user->getAddress());
			$statement->bindValue(9, $user->getPostalCode());
			$statement->bindValue(10, $user->getCity());
			$statement->bindValue(11, $user->getPhoneNumber());
			$statement->execute();

		} catch (PDOException $e) {
			die('Error create User : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function update ($user) {
		if($user->getBirthDate()=='00/00/0000')
			$user->setBirthDate(null);

		try {
			$statement = DB::getInstance()->prepare('UPDATE '.self::getTableName().' SET password=?, firstName=?, lastName=?, sex=?, email=?, birthDate=?, address=?, postalCode=?, city=?, phoneNumber=?  WHERE login=?');
			$statement->bindValue(1, $user->getPassword());
			$statement->bindValue(2, $user->getFirstName());
			$statement->bindValue(3, $user->getLastName());
			$statement->bindValue(4, $user->getSex());
			$statement->bindValue(5, $user->getEmail());
			$statement->bindValue(6, $user->getBirthDate());
			$statement->bindValue(7, $user->getAddress());
			$statement->bindValue(8, $user->getPostalCode());
			$statement->bindValue(9, $user->getCity());
			$statement->bindValue(10, $user->getPhoneNumber());
			$statement->bindValue(11, $user->getLogin());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error update User : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function delete ($user) {
		try {
			$statement = DB::getInstance()->prepare('DELETE FROM '.self::getTableName().' WHERE login=?');
			$statement->bindValue(1, $user->getLogin());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error delete User : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function getAll () {
		$users = array();
		try {
			$statement = DB::getInstance()->prepare('SELECT * FROM '.self::getTableName().'');

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
			$statement = DB::getInstance()->prepare('SELECT login, password, firstName, lastName, sex, email, DATE_FORMAT(birthDate, "%d/%m/%Y") AS birthDate, address, postalCode, city, phoneNumber FROM '.self::getTableName().' where login=?');
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
