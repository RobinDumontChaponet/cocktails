<!--meta title="Favoris"-->

<div id="content">
	<?php
	if(empty($favorites))
		echo '<p class="sad">Aucune recette enregistrée.</p>';
	else
		foreach($favorites as $favorite)
			echo $favorite.'<br />';

	if (!isset($_SESSION['cocktailsUser'])) { ?>
        <p class="notice"><a href="login">Connectez-vous</a> pour enregistrer vos favoris</p>
     <?php } ?>

</div>