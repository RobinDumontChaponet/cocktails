<?php

namespace Transitive\Utils;
use \PDO;

class Database {
	private $PDOInstance = null;
	private static $instance = null;

	public static $defaultDbHost = 'localhost';
	public static $defaultDbUser = '';
	public static $defaultDbPwd = '';
	public static $defaultDbName = '';

	function __construct() {
		$this->PDOInstance = new PDO(
			'mysql:dbname='.self::$defaultDbName.';host='.self::$defaultDbHost,
			self::$defaultDbUser,
			self::$defaultDbPwd,
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			)
		);
	}

	public static function getInstance() {
		if (is_null(self::$instance))
			self::$instance = new Database();

		return self::$instance;
	}

	public function query($query) {
		return $this->PDOInstance->query($query);
	}

	public function prepare($query) {
		return $this->PDOInstance->prepare($query);
	}

	public function lastInsertId() {
		return $this->PDOInstance->lastInsertId();
	}
}

Database::$defaultDbUser = 'cocktail';
Database::$defaultDbPwd = 'cocktail';
Database::$defaultDbName = 'cocktails';

?>