<?php

//require_once MODELS_INC.'RecipeDAO.class.php';

$controller->data['recipes'] = RecipeDAO::getAll();

?>