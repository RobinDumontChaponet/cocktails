<?php

$view->setTitle('Favoris');

$view->content = function ($data) { ?>

<div id="content">
	<?php
	if(empty($_SESSION['cocktailsFavorites']))
		echo '<p class="sad">Aucune recette enregistrée.</p>';
	else
		foreach($_SESSION['cocktailsFavorites'] as $favorite)
			echo $favorite.'<br />';

	if (!isset($_SESSION['cocktailsUser'])) { ?>
		<p class="notice"><a href="login">Connectez-vous</a> pour enregistrer vos favoris</p>
	<?php } ?>
</div>

<?php
} ?>