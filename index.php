<?php

require_once 'conf.inc.php';
require_once 'SPDO.class.php';

session_start();

function get_include_contents($filename) {
	if (is_file($filename)) {
		ob_start();
		include ($filename);
		return ob_get_clean();
	}
	return false;
}

if(empty($_GET['requ']))
	$_GET['requ']='index';

if(is_file(CONTROLLERS_INC.$_GET['requ'].'.php'))
	$inc = get_include_contents(CONTROLLERS_INC.$_GET['requ'].'.php');
else {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	header("Status: 404 Not Found");
	$_SERVER['REDIRECT_STATUS'] = 404;
	$inc = get_include_contents(CONTROLLERS_INC.'404.php');
}

include('datas.transit.inc.php');

preg_match('/<\!--meta\s*(.*)-->/i', $inc, $matches);
if($matches[1]) {
	$link=''; $script=''; $onload='';
	preg_match_all("/(\\S+)=[\"']?((?:.(?![\"']?\\s+(?:\\S+)=|[\"']))+.)[\"']?/", $matches[1], $tag);
	$tag=rearrange($tag);
	if($tag)
		foreach($tag as $rule) {
			switch($rule[1]){
				case 'title' : $title=$rule[2]; break;
				case 'css'   : $link.='<link rel="stylesheet" type="text/css" href="'.$rule[2].'"/>'."\n"; break;
				case 'js'    : $script.='<script type="text/javascript" src="'.$rule[2].'"></script>'."\n"; break;
				case 'onload': $onload.=$rule[2].'();'; break;
			}
		}
	if($onload!='') $script.="\n".'<script type="text/javascript">window.onload=function(){'.$onload.'}</script>';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 7]>   <html class="lt-ie9 lt-ie8" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 8]>   <html class="lt-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<!--[if gt IE 8]><html class="get-ie9" xmlns="http://www.w3.org/1999/xhtml"><![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<base href="<?php echo ((constant('SELF')==NULL)?'/':constant('SELF').'/'); ?>" />
<title>Cocktails<?php if(!empty($title)) echo ' | '.$title; ?></title>
<meta name="msapplication-TileColor" content="#FFF">
<link rel="stylesheet" type="text/css" href="style/reset.min.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<?php echo $link; ?>
<!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="script/polyShims.js"></script>
<script type="text/javascript" src="script/transit.js"></script>
<?php echo $script; ?>
</head>
<body>
	<div id="wrapper">
		<?php include_once('header.part.inc.php');
		echo $inc; ?>
	</div>
</body>
</html>
