<?php

header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden");
header("Status: 403 Forbidden");
$_SERVER['REDIRECT_STATUS'] = 403;

include(VIEWS_INC.'403.php');

?>