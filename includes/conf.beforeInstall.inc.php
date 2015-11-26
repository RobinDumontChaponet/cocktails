<?php

namespace Transitive;

/*
 * Architecture-related
 */
define('ROOT_PATH', dirname(dirname(__FILE__)));
define('SELF', (dirname($_SERVER['PHP_SELF']) == '/' ? '' : dirname($_SERVER['PHP_SELF'])));
define('CONTROLLERS_INC', ROOT_PATH.'/controllers/');
define('MODELS_INC', ROOT_PATH.'/models/');
define('VIEWS_INC', ROOT_PATH.'/views/');
define('DATA_PATH', ROOT_PATH.'/data/');
define('WEB_DATA', SELF.'data/');

if(class_exists('Transitive\Core\FrontController')) {
	Core\FrontController::$presenterIncludePath = ROOT_PATH.'/presenters/';
	Core\FrontController::$viewIncludePath = ROOT_PATH.'/views/';
}

/***********************************************************
 *                                                         *
 * If the database is not config we go to install script ! *
 *                                                         *
 ***********************************************************/
header('Location: install.php');


/*
 * Locales
 */
setlocale(LC_ALL, 'fr_FR.utf8', 'fr', 'fr_FR', 'fr_FR@euro', 'fr-FR', 'fra');

?>