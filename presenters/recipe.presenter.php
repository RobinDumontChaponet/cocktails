<?php

$presenter->data['recipe'] = RecipeDAO::getById(@$_GET['id']);

?>