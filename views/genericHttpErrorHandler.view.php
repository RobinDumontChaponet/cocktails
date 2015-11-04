<?php

$view->setTitle(http_response_code());
$view->linkStylesheet ('style/genericHttpErrorHandler.css');

$view->content = function ($data) { ?>

<div id="content">
	<h1><?php echo http_response_code() ?></h1>
	<p><?php echo Transitive\Utils\HttpRequest::http_response_message() ?></p>
</div>

<?php
} ?>