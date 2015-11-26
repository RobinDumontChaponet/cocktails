<?php

define('ROOT_PATH', dirname(__FILE__));
define('DATA_PATH', ROOT_PATH.'/data/');
define('MODELS_INC', ROOT_PATH.'/models/');

require 'transitive/Transitive.inc.php';
use Transitive\Utils\Database as Db;
use Transitive\Utils\Validation as Validation;

$formValidation = null;
if(isset($_POST['install'])) {

	Validation::trimForm(array('dbURI', 'dbPort', 'dbUser', 'dbName', 'tablePrefix'), $_POST);

	Validation::validateForm (array(
		'dbPort' => function($value){ return ($value=='' || (!empty($value) && $value!=0 && Validation::is_port_number($value)))?true:'Le numéro de port doit être compris entre 1 et 65535'; },
		'dbUser' => function($value){ return ($value!='' && strlen($value)<=16)?true:'Le nom d\'utilisateur mySQL est requis et ne dois pas dépasser 16 caractères'; },
		'dbName' => function($value){ return ($value!='' && strlen($value)<=64 && !Validation::contains('.\/\\', $value))?true:'Le nom de la base mySQL est requis et ne dois pas dépasser 64 caractères ou contenir "\", "/" et "."'; }
	), $_POST);

	if(Validation::isFormValid()) {

		$result = '';

		/* This function is only used for the install process so we define it here */
		function sqlExecute ($queryString, $params=NULL) {
			try {
				$statement = DB::getInstance()->prepare($queryString);

				if($params && is_array($params))
					foreach($params as $key=>$param)
						$statement->bindValue($key, $param);

				$statement->execute();
			} catch (PDOException $e) {
				die('Error sqlExecute : ' . $e->getMessage() . '<br/>');
			}
		}

		include DATA_PATH.'db-schema.sql.php';

		Db::$dbHost = (empty($_POST['dbURI']))?'localhost':$_POST['dbURI'];
		Db::$dbPort = (empty($_POST['dbPort']))?'3306':$_POST['dbPort'];
		Db::$dbUser = $_POST['dbUser'];
		Db::$dbPwd = $_POST['dbPwd'];
		Db::$dbName = $_POST['dbName'];
		Db::$tablePrefix = $_POST['tablePrefix'];

		$sql = getSqlSchema(Db::$tablePrefix);

		if(isset($_POST['dropTables']) && $_POST['dropTables']==true) {
			sqlExecute($sql['User']['drop']);
			sqlExecute($sql['favorite']['drop']);
		}

		sqlExecute($sql['User']['create']);
		sqlExecute($sql['favorite']['create']);

		$result.= '<p class="true">Les tables correspondantes ont été initialisées dans la Base-de-données</p>';

		/* This is nowDoc (hereDoc 2.0 ;-) */
		$config = <<<'EOD'

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


/*
 * Database
 */
if(class_exists('Transitive\Core\FrontController')) {
EOD;
		$config.= '
	Utils\Database::$dbHost = \''.Db::$dbHost.'\';
	Utils\Database::$dbPort = \''.Db::$dbPort.'\';
	Utils\Database::$dbUser = \''.Db::$dbUser.'\';
	Utils\Database::$dbPwd = \''.Db::$dbPwd.'\';
	Utils\Database::$dbName = \''.Db::$dbName.'\';
	Utils\Database::$tablePrefix = \''.Db::$tablePrefix.'\';
';
		$config.= <<<'EOD'
}


/*
 * Locales
 */
setlocale(LC_ALL, 'fr_FR.utf8', 'fr', 'fr_FR', 'fr_FR@euro', 'fr-FR', 'fra');

?>
EOD;
		$writeOk=false;
		if(is_writable(ROOT_PATH.'/includes/')) {
			$writeOk = file_put_contents(ROOT_PATH.'/includes/conf.inc.php', "<?php\n".$config);
			if($writeOk!==false)
				$result.= '<p class="true">Le fichier de configuration a été mis-à-jour.</p>';
		}

		if(!is_writable(ROOT_PATH.'/includes/') || $writeOk===false) {
			$result.= '<p class="error">Le fichier de configuration "'.ROOT_PATH.'/includes/conf.inc.php'.'" est inaccessible en écriture.</p>
			<p>Remplacez le contenu du fichier par ce qui suit :</p>
			<textarea readonly>&lt;?php'.$config.'</textarea>';
		}
		$result.= '<a href="/">Accéder au site</a>';
	}
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 7]>   <html class="lt-ie9 lt-ie8" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 8]>   <html class="lt-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if gt IE 8]><html class="get-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cocktails | ~ Installation ~</title>
<meta name="msapplication-TileColor" content="#D07C5E">
<link rel="stylesheet" type="text/css" href="style/reset.min.css">
<link rel="stylesheet" type="text/css" href="style/style.combined.css">
<!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="script/polyShims.js"></script>
<style>
legend, label {
	margin-top: 1em;
	font-weight: bold;
}
form button, form input [type="submit"] {
	display: block;
	text-align: center;
}
#content {
	border-radius: 4px;
	padding:10px;
	text-align:center;
}

label {
	display: block;
}

input, select {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

textarea {
	display: block;
	white-space: pre-line;
	text-align: left;
	background: rgba(253, 253, 253, 0.53);
	margin: 10px 0;
	padding: 10px;
	border: 1px solid;
	border-color: #e7e9ed #e6e7ec #e1e2e7;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
}
</style>
</head>
<body>
<div id="wrapper">
	<header>
		<h1><a href="<?php echo $_SERVER['PHP_SELF'] ?>">~ Installation ~</a></h1>
	</header>
	<div id="content">
<?php
if(!isset($_POST['install']) || !Validation::isFormValid()) {
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<dl>
				<dt>
					<label for="dbURI">Host URI</label>
				</dt>
				<dd>
					<input id="dbURI" type="text" name="dbURI" value="<?php echo @$_POST['dbURI'] ?>" placeholder="Par défaut `localhost`" autofocus />
				</dd>
				<dt>
					<?php echo Validation::invalidMessage('dbPort'); ?>
					<label for="dbPort">Port</label>
				</dt>
				<dd>
					<input id="dbPort" type="text" name="dbPort" value="<?php echo @$_POST['dbPort'] ?>" placeholder="Par défaut `3306`" />
				</dd>
				<dt>
					<?php echo Validation::invalidMessage('dbUser'); ?>
					<label for="dbUser">Utilisateur mySQL *</label>
				</dt>
				<dd>
					<input id="dbUser" type="text" name="dbUser" value="<?php echo @$_POST['dbUser'] ?>" placeholder="(requis)" required />
				</dd>
				<dt>
					<label for="dbPwd">Mot-de-passe de la base-de-données</label>
				</dt>
				<dd>
					<input id="dbPwd" type="text" name="dbPwd" value="<?php echo @$_POST['dbPwd'] ?>" />
				</dd>
				<dt>
					<?php echo Validation::invalidMessage('dbName'); ?>
					<label for="dbName">Nom de la base-de-données mySQL *</label>
				</dt>
				<dd>
					<input id="dbName" type="text" name="dbName" value="<?php echo @$_POST['dbName'] ?>" placeholder="(requis)" required />
				</dd>
				<dt>
					<label for="dropTables">Remplacer les tables si elles existent ?</label>
				</dt>
				<dd>
					<input id="dropTables" type="checkbox" name="dropTables" />
				</dd>
				<dt>
					<label for="tablePrefix">Préfixe des tables</label>
				</dt>
				<dd>
					<input id="tablePrefix" type="text" name="tablePrefix" value="<?php echo @$_POST['tablePrefix'] ?>" placeholder="Par défaut, aucun" />
				</dd>
			</dl>
			<p class="notice">L'utilisateur SQL nécessite les droits CREATE & DROP lors de l'installation<br />puis SELECT, INSERT, UPDATE et DELETE en production</p>
			<input type="submit" name="install" value="Installer" />
		</form>
<?php
} elseif(isset($result))
	echo $result;
?>
	</div>
	<footer></footer>
</div>
</body>
</html>