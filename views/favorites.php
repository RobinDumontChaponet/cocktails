<!--meta title="Favoris"-->

<div id="content">
	<?php
	if(empty($favorites))
		echo '<p class="sad">Aucune recette enregistrée.</p>';
	else
		echo '<ul>';
		foreach($favorites as $favorite)
			echo '<li>'.$favorite.'</li>'; // @TODO
		echo '</ul>';

	if (!isset($_SESSION['cocktailsUser'])) { ?>
        <p class="notice"><a href="connection">Connectez-vous</a> pour enregistrer vos favoris</p>
     <?php } ?>
</div>