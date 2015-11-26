<?php

if(!isset($_GET['id']))
	$request->redirect('all');

$presenter->data['recipe'] = RecipeDAO::getById(@$_GET['id']);

?>