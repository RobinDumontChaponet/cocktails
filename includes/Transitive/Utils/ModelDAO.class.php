<?php

// @TODO !
// @TODO !
// @TODO !
// @TODO !

use \Transitive\Utils\Database as DB;

class ModelDAO {
	const tableName = '';
	private static function getTableName () {
		return DB::$tablePrefix.self::tableName;
	}

	public static function create ($object) {
		try {
			$statement = DB::getInstance()->prepare('');
// 			$statement->bindValue(1, $user->getLogin());

			$statement->execute();

		} catch (PDOException $e) {
			die(__METHOD__.' : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function update ($user) {
		if($user->getBirthDate()=='00/00/0000')
			$user->setBirthDate(null);

		try {
			$statement = DB::getInstance()->prepare('');
// 			$statement->bindValue(1, $user->getPassword());

			$statement->execute();
		} catch (PDOException $e) {
			die(__METHOD__.' : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function delete ($object) {
		try {
			$statement = DB::getInstance()->prepare('DELETE FROM '.self::getTableName().' WHERE id=?');
			$statement->bindValue(1, $object->getId());
			$statement->execute();
		} catch (PDOException $e) {
			die(__METHOD__.' : ' . $e->getMessage() . '<br/>');
		}
	}

	public static function getAll () {
		$objects = array();
		try {
			$statement = DB::getInstance()->prepare('SELECT * FROM '.self::getTableName().'');

			$statement->execute();

			while ($rs = $statement->fetch(PDO::FETCH_OBJ))
				$objects[]=new User($rs->login, $rs->password);
		} catch (PDOException $e) {
			die(__METHOD__.' : ' . $e->getMessage() . '<br/>');
		}
		return $objects;
	}

	public static function getByLogin ($login) {
		$object = null;

		try {
			$statement = DB::getInstance()->prepare('SELECT login, password, firstName, lastName, sex, email, DATE_FORMAT(birthDate, "%d/%m/%Y") AS birthDate, address, postalCode, city, phoneNumber FROM '.self::getTableName().' where login=?');
			$statement->bindParam(1, $login);
			$statement->execute();

			if($rs = $statement->fetch(PDO::FETCH_OBJ))
				$object=new User($rs->login, $rs->password, $rs->firstName, $rs->lastName, $rs->sex, $rs->email, $rs->birthDate, $rs->address, $rs->postalCode, $rs->city, $rs->phoneNumber);
		} catch (PDOException $e) {
			die(__METHOD__.' : ' . $e->getMessage() . '<br/>');
		}
		return $object;
	}
}

?>
