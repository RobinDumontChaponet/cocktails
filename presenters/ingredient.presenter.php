<?php

if(!isset($_GET['id']))
	$request->redirect('all');

$presenter->data['ingredient'] = IngredientDAO::getById(urldecode(@$_GET['id']));

?>