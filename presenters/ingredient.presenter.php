<?php

$presenter->data['ingredient'] = IngredientDAO::getById(urldecode(@$_GET['id']));

?>