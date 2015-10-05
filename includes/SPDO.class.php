<?php

class SPDO {
	/**
	 * Instance de la classe PDO
	 *
	 * @var PDO
	 * @access private
	 */

	private $PDOInstance = null;

	/**
	 * Instance de la classe SPDO
	 *
	 * @var SPDO
	 * @access private
	 * @static
	 */

	private static $instance = null;

	const DEFAULT_SQL_USER = 'cocktail';

	const DEFAULT_SQL_HOST = 'localhost';

	const DEFAULT_SQL_PASS = 'cocktail';

	const DEFAULT_SQL_DTB = 'cocktails';

	private function __construct() {
		$this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST, self::DEFAULT_SQL_USER , self::DEFAULT_SQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new SPDO();
		}
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