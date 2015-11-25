<?php

$badAgents = array('Java','Jakarta', 'User-Agent', 'compatible ;', 'libwww, lwp-trivial', 'curl, PHP/', 'urllib', 'GT::WWW', 'Snoopy', 'MFC_Tear_Sample', 'HTTP::Lite', 'PHPCrawl', 'URI::Fetch', 'Zend_Http_Client', 'http client', 'PECL::HTTP');
$bot=false;
$badInput=false;
foreach($badAgents as $agent) {
	if(strpos($_SERVER['HTTP_USER_AGENT'],$agent) !== false) {
		$bot=true;
		break;
	}
}

if (isset($_SESSION['cocktailsUser']) && get_class($_SESSION['cocktailsUser']) == 'User')
	$request->redirect('index');
elseif (isset($_POST['submit'])) {
	if ($_POST['user']=='' || $_POST['password']=='') $badInput=true;
	elseif(!$bot) {
		//require MODELS_INC.'UserDAO.class.php';
		//require 'passwordHash.inc.php';
		$user = UserDAO::getByLogin($_POST['user']);
		if ($user != NULL) {
			if (empty($user) || !Transitive\Utils\Passwords::validate_password($_POST['password'] , $user->getPassword())) {
				$badInput = true;
				sleep(1);
			} else {
				$_SESSION['cocktailsUser'] = $user;
				FavoriteDAO::sync();
				if(!empty($_SESSION['referrer']) && $_SESSION['referrer']!='login' && $_SESSION['referrer']!='logout')
					$request->redirect($_SESSION['referrer']);
				else
					$request->redirect('index');
				exit;
			}
		} else {
			$badInput = true;
		}
	}
}

$presenter->data['bot'] = $bot;
$presenter->data['badInput'] = $badInput;

?>