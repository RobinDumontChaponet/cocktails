<?php

namespace Transitive;

use Transitive\Core\FrontController as FrontController;

require 'transitive/Transitive.inc.php';
require 'conf.inc.php';

session_start();

FrontController::$defaultRequestUrl = 'all';
$transit = new FrontController(@$_GET['requ']);
$transit->execute();
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 7]>   <html class="lt-ie9 lt-ie8" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 8]>   <html class="lt-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if gt IE 8]><html class="get-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php $transit->printMetas() ?>
<base href="<?php echo ((constant('SELF')==NULL)?'/':constant('SELF').'/'); ?>" />
<?php $transit->printTitle('Cocktails | ') ?>
<meta name="msapplication-TileColor" content="#D07C5E">
<link rel="stylesheet" type="text/css" href="style/reset.min.css">
<link rel="stylesheet" type="text/css" href="style/style.combined.css">
<?php $transit->printStyle() ?>
<!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="script/polyShims.js"></script>
<?php $transit->printScripts() ?>
</head>
<body>
<div id="wrapper">
	<?php include_once('header.part.inc.php');
	$transit->displayContent();
	echo PHP_EOL; ?>
</div>
</body>
</html>