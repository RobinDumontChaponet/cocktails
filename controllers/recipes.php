<?php

require_once MODELS_INC.'RecipeDAO.class.php';

$recipes = RecipeDAO::getByIngredient('Malibu');

include VIEWS_INC.'recipes.php';

?>
