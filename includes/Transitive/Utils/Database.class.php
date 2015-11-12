<?php

namespace Transitive\Utils;
use \PDO;

class Database {
	private $PDOInstance = null;
	private static $instance = null;

	public static $dbHost = 'localhost';
	public static $dbUser = '';
	public static $dbPwd = '';
	public static $dbName = '';
	public static $tablePrefix = '';


	function __construct() {
		$this->PDOInstance = new PDO(
			'mysql:dbname='.self::$dbName.';host='.self::$dbHost,
			self::$dbUser,
			self::$dbPwd,
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

?>