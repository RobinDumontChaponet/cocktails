<?php

$presenter->data['categories'] = CategoryDAO::getAll();

$presenter->data['recipes'] = RecipeDAO::getAll();

?>