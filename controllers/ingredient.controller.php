<?php

$controller->data['ingredient'] = IngredientDAO::getById(urldecode(@$_GET['id']));

?>