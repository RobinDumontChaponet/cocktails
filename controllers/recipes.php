<?php

require_once MODELS_INC.'RecipeDAO.class.php';

$recipes = RecipeDAO::getAll();

include VIEWS_INC.'recipes.php';

?>