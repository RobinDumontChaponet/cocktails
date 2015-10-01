<?php
$badAgents = array('Java','Jakarta', 'User-Agent', 'compatible ;', 'libwww, lwp-trivial', 'curl, PHP/', 'urllib', 'GT::WWW', 'Snoopy', 'MFC_Tear_Sample', 'HTTP::Lite', 'PHPCrawl', 'URI::Fetch', 'Zend_Http_Client', 'http client', 'PECL::HTTP');
$bot=false;
$badinput=false;
foreach($badAgents as $agent) {
     if(strpos($_SERVER['HTTP_USER_AGENT'],$agent) !== false)
        $bot=true;
}
header("HTTP/1.1 200 OK");
if (isset($_SESSION['cocktailsUser']) && $_SESSION['cocktailsUser']!='')
	header ('Location: index.php');
elseif (isset($_POST['login']) && isset($_POST['password']) && !$bot) {
	if ($_POST['login']=='' || $_POST['password']=='') $badinput=true;
	else {
		require(MODELS_INC.'UserDAO.class.php');
		include('validate.transit.inc.php');
		include_once('passwordHash.inc.php');
		$user = UserDAO::getByLogin ($_POST['login']);
		if ($user != NULL) {
			if (empty($user) || !validePassword($_POST['password'] , $user->getPassword())) {
				$badinput = true;
				echo "fail";
				sleep(1);
			} else {
				session_start();
				$_SESSION['cocktailsUser'] = $user;
				session_start();
				header ('Location: index.php');
				exit;
			}
		} else {
			$badinput = true;
		}
	}
}
include(VIEWS_INC.'connection.php');
?>
