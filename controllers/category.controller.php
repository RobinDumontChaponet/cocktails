<?php

$controller->data['category'] = CategoryDAO::getById(@$_GET['id']);

?>