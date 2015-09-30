<?php

require_once 'SPDO.class.php';
require MODELS_INC.'User.class.php';

class UserDAO {
	public function create ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('INSERT INTO user (idAuth, login, pwd) values (?, ?, ?)');
			$statement->bindParam(1, $user->getAuth()->getId());
			$statement->bindParam(2, $user->getLogin());
			$statement->bindParam(3, $user->getPwd());
			$statement->execute();

			return $connect->lastInsertId();
		} catch (PDOException $e) {
			die('Error create user!: ' . $e->getMessage() . '<br/>');
		}
	}

	public function update ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('UPDATE user SET idAuth=?, login=?, pwd=? WHERE idUser=?');
			$statement->bindParam(1, $user->getAuth()->getId());
			$statement->bindParam(2, $user->getLogin());
			$statement->bindParam(3, $user->getPwd());
			$statement->bindParam(4, $user->getId());
			$statement->execute();

			return $connect->lastInsertId();
		} catch (PDOException $e) {
			die('Error update user!: ' . $e->getMessage() . '<br/>');
		}
	}

	public function delete ($user) {
		try {
			$statement = SPDO::getInstance()->prepare('DELETE FROM user WHERE idUser=?');
			$statement->bindParam(1, $user->getId());
			$statement->execute();
		} catch (PDOException $e) {
			die('Error delete user!: ' . $e->getMessage() . '<br/>');
		}
	}

	public function getAll () {
		$users = array();
		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM user');

			$statement->execute();

			while ($rs = $statement->fetch(PDO::FETCH_OBJ))
				$users[]=new User($rs->idUser, $rs->login, $rs->pwd, getAuthById($rs->idAuth));
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $users;
	}

	public function getById ($id) {
		$user = null;
		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM user where idUser=?');
			$statement->bindParam(1, $id);
			$statement->execute();

			if($rs = $statement->fetch(PDO::FETCH_OBJ))
				$user=new User($rs->idUser, $rs->login, $rs->pwd, getAuthById($rs->idAuth));
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $user;
	}

	public function getByLogin ($login) {
		$user = null;

		try {
			$statement = SPDO::getInstance()->prepare('SELECT * FROM user where login=?');
			$statement->bindParam(1, $login);
			$statement->execute();

			if($rs = $statement->fetch(PDO::FETCH_OBJ))
				$user=new User($rs->idUser, $rs->login, $rs->pwd, getAuthById($rs->idAuth));
		} catch (PDOException $e) {
			die('Error!: ' . $e->getMessage() . '<br/>');
		}
		return $user;
	}
}

?>