<?php

require_once MODELS_INC.'Favorite.class.php';

if(isset($_GET['remove'])) {
	FavoriteDAO::removeById($_GET['remove']);
}

if(isset($_GET['add'])) {
	FavoriteDAO::addById($_GET['add']);
}

if (!isset($_SESSION['cocktailsFavorites']))
	$_SESSION['cocktailsFavorites'] = array();

?>