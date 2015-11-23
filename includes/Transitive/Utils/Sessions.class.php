<?php

namespace Transitive\Utils;

abstract class Sessions {
	public static $keyPrefix;

	public static function isStarted () {
		return session_status() != PHP_SESSION_NONE;
	}

	public static function start (/*...*/) {
	if (!self::isStarted())
		session_start();

	    // .... @TO-DO ?
	}

	public static function getId() {
		if (self::isStarted())
			return session_id();
		return false;
	}

	public static function set($key, $value='') {
		if(self::isStarted()) {
            $_SESSION[self::$keyPrefix.$key] = $value;
            return true;
		}
		return false;
    }

	public static function exist($key) { // can't name this 'isset' as it's reserved by php.
		return self::isStarted() && isset($_SESSION[self::$keyPrefix.$key]);
	}
    public static function get($key) {
		if(self::exist($key))
            return $_SESSION[self::$keyPrefix.$key];
		return null;
    }

    public static function remove ($key) {
	    unset($_SESSION[self::$keyPrefix.$key]);
    }

    public static function destroy() {
		if (self::isStarted()) {
			session_unset();
			session_destroy();
		}
	}
}

?>