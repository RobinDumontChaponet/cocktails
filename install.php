<?php

require 'transitive/Transitive.inc.php';
use Transitive\Utils\Database as Db;

if(isset($_POST['install'])) {

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

	include dirname(__FILE__).'/data/db-struct.sql.php';

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
form label, form button, form input [type="submit"] {
	display: block;
	text-align: center;
}
#content {
	border-radius: 4px;
	padding:10px;
	text-align:center;
}

input, select {
	display: block;
	margin-left: auto;
	margin-right: auto;
}
</style>
</head>
<body>
<div id="wrapper">
	<header>
		<h1><a href="<?= $_SERVER['PHP_SELF'] ?>">Installation</a></h1>
	</header>
	<div id="content">
		<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
			<label for="dbURI">Host URI</label>
			<input id="dbURI" type="text" name="dbURI" value="localhost" placeholder="Par défaut `localhost`" required autofocus />
			<label for="dbPort">Port</label>
			<input id="dbPort" type="text" name="dbPort" value="3306" required />
			<label for="dbUser">Utilisateur mySQL</label>
			<input id="dbUser" type="text" name="dbUser" required />
			<label for="dbPwd">Mot-de-passe de la base-de-données</label>
			<input id="dbPwd" type="text" name="dbPwd" required />
			<label for="dbName">Nom de la base-de-données mySQL</label>
			<input id="dbName" type="text" name="dbName" required />
			<label for="dropTables">Remplacer les tables si elles existent ?</label>
			<input id="dropTables" type="checkbox" name="dropTables" />
			<label for="tablePrefix">Préfixe des tables</label>
			<input id="tablePrefix" type="text" name="tablePrefix" />
			<p class="notice">L'utilisateur SQL nécessite les droits CREATE & DROP lors de l'installation<br />puis SELECT, INSERT, UPDATE et DELETE en production</p>
			<input type="submit" name="install" value="Installer" />
		</form>
	</div>
	<footer></footer>
</div>
</body>
</html>