<?php

$view->setTitle('Favoris');

$view->content = function ($data) { ?>

<div id="content">
	<h1>Favoris</h1>
	<?php
	if(empty($_SESSION['cocktailsFavorites']))
		echo '<p class="sad">Aucune recette enregistrée.</p>';
	else {
		echo '<ul>';
		foreach($_SESSION['cocktailsFavorites'] as $favorite)
			echo '<li>'.$favorite.'</li>';
		echo '</ul>';
	}

	if (!isset($_SESSION['cocktailsUser'])) { ?>
		<p class="notice"><a href="login">Connectez-vous</a> pour enregistrer vos favoris</p>
	<?php } ?>
</div>

<?php
} ?>