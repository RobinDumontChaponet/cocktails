<?php

//require 'Core/Transitive.class.php';

namespace Transitive;

class Autoloader {
	public static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
		//spl_autoload_register(array(__CLASS__, 'autoloadModels'));
		//spl_autoload_register(array(__CLASS__, 'autoloadTransitive'));
	}

	public static function autoloadTransitive($nameSpace) {
		$i = count($nameSpace) - 1;
		$nameSpace[$i] = ucfirst($nameSpace[$i]);
		$class = implode(DIRECTORY_SEPARATOR, $nameSpace);
		//var_dump('transitiveLoaded : '.$class);
		//if(file_exists($class.'.class.php'))
			require $class.'.class.php';
	}

	public static function autoloadModels($class) {
		//var_dump('autoloadModels : '.MODELS_INC.$class.'.class.php');

		if(file_exists(MODELS_INC.$class.'.class.php'))
			require MODELS_INC.$class.'.class.php';
	}

	public static function autoload ($class) {
		//var_dump('autoload : '.$class);

		$nameSpace = explode('\\', $class);
		if($nameSpace[0]=='Transitive')
			self::autoloadTransitive($nameSpace);
		else //if($nameSpace[0]=='Models')
			self::autoloadModels($class);
	}
}

Autoloader::register();

?>