<?php

require_once MODELS_INC.'Favorite.class.php';

/*
$favorites = array();

if (isset($_SESSION['cocktailsUser']))
	$favorites = FavoriteDAO::getByUser($_SESSION['cocktailsUser']);
else {
	// @TODO
}
*/

if (!isset($_SESSION['cocktailsFavorites']))
	$_SESSION['cocktailsFavorites'] = array();

include(VIEWS_INC.'favorites.php');

?>