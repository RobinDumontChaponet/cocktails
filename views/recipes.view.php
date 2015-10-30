<?php

$view->setTitle('Recettes');
$view->addStyle('/*
 * Juste parce que je me paume que je fais ce style ...
 * Lol, pareil
 */
.recipe {
    border-bottom: 1px solid grey;
    padding: 1em;
}
.recipe h1 {
    font-weight: bold;
}');

$view->content = function (&$data) { ?>

<div id="content">
	<?php
	if(empty($data['recipes']))
		echo '<p class="sad">Aucune recette.</p>';
	else
		foreach($data['recipes'] as $recipe)
			echo $recipe;
	?>
</div>

<?php
} ?>