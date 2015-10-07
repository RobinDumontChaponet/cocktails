<!--meta title="Recettes"-->

<style>
/*
 * C'est juste parce que je me paume que je fais ce style ...
 * lol, pareil
 */
.recipe {
    border-bottom: 1px solid grey;
    padding: 1em;
}
.recipe h1 {
    font-weight: bold;
}
</style>
<div id="content">
	<?php
	foreach($recipes as $recipe)
		echo $recipe;
	?>
</div>