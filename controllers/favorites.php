<?php

require_once MODELS_INC.'Favorite.class.php';

if (isset($_SESSION['cocktailsUser'])) {
    echo "Vous avez des favoris en tant que User";
    // Récupérer favoris de l'utilisateur connecté et afficher
} else {
    echo "Vous avez des favoris en tant que temporaire";
    // Récupérer ce qu'il y a dans les cookies, si il y a
}

include(VIEWS_INC.'favorites.php');

?>
