<?php

$controller->data['recipe'] = RecipeDAO::getById(@$_GET['id']);

?>