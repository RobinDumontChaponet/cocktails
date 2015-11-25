<?php

namespace Transitive;

abstract class TransitiveAutoloader {
	public static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	public static function autoloadTransitive($nameSpace) {
		$i = count($nameSpace) - 1;
		$nameSpace[$i] = ucfirst($nameSpace[$i]);
		$class = implode(DIRECTORY_SEPARATOR, $nameSpace);
			require $class.'.class.php';
	}

	public static function autoloadModels($class) {
		if(file_exists(MODELS_INC.$class.'.class.php'))
			require MODELS_INC.$class.'.class.php';
	}

	public static function autoload ($class) {
		$nameSpace = explode('\\', $class);
		if($nameSpace[0]=='Transitive')
			self::autoloadTransitive($nameSpace);
		else
			self::autoloadModels($class);
	}
}

TransitiveAutoloader::register();

?>