<?php

$badAgents = array('Java','Jakarta', 'User-Agent', 'compatible ;', 'libwww, lwp-trivial', 'curl, PHP/', 'urllib', 'GT::WWW', 'Snoopy', 'MFC_Tear_Sample', 'HTTP::Lite', 'PHPCrawl', 'URI::Fetch', 'Zend_Http_Client', 'http client', 'PECL::HTTP');
$bot=false;
$badinput=false;
foreach($badAgents as $agent) {
	if(strpos($_SERVER['HTTP_USER_AGENT'],$agent) !== false) {
		$bot=true;
		break;
	}
}


header("HTTP/1.1 200 OK");

if (isset($_SESSION['cocktailsUser']) && get_class($_SESSION['cocktailsUser']) == 'User')
	header ('Location: index');
elseif (isset($_POST['submit'])) {
	if ($_POST['user']=='' || $_POST['password']=='') $badinput=true;
	elseif(!$bot) {
		require MODELS_INC.'UserDAO.class.php';
		require 'validate.transit.inc.php';
		require 'passwordHash.inc.php';
		$user = UserDAO::getByLogin($_POST['user']);
		if ($user != NULL) {
			if (empty($user) || !validate_password($_POST['password'] , $user->getPassword())) {
				$badinput = true;
				sleep(1);
			} else {
				$_SESSION['cocktailsUser'] = $user;
				FavoriteDAO::sync();
				if(!empty($_SESSION['referrer']) && $_SESSION['referrer']!='login' && $_SESSION['referrer']!='logout')
					header('Location: '.$_SESSION['referrer']);
				else
					header ('Location: index');
				exit;
			}
		} else {
			$badinput = true;
		}
	}
}
include(VIEWS_INC.'login.php');

?>