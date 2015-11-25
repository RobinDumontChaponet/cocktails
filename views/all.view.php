<?php

$view->setTitle('Les recettes : Aliment');
$view->importStylesheet('style/recipe-hierarchy.css');

$view->content = function ($data) { ?>

<div id="content">
	<article class="category">
		<h1><span class="self">Aliment</span></h1>
		<section class="content">
		<div class="subs"><h2>Filtres</h2>
		<?php
		if(empty($data['categories']))
			echo '<p class="sad">Aucun filtre applicable.</p>';
		else {
			echo '<ul title="Aliments">';
			foreach($data['categories'] as $category)
				echo '<li><a href="ingredient/'.$category->getLabel().'">'.$category->getLabel().'</a></li>';
			echo '</ul>';
		}
		echo '</div>';
		echo '<div class="recipes"><h2>Recettes</h2>';
		if($data['recipes']) {
			echo '<ul title="Recettes">';
			foreach($data['recipes'] as $recipe)
				echo '<li><a href="recipe/'.$recipe->getId().'">'.$recipe->getTitle().'</a></li>';
			echo '</ul>';
		} else
			echo '<p class="sad">Aucune recette à afficher.</p>';
		echo '</div>';
		?>
		</section>
	</article>
</div>

<?php
} ?>