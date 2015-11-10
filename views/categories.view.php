<?php

$view->setTitle('Les recettes : Aliment');
$view->importStylesheet('style/recipe-hierarchy.css');

$view->content = function ($data) { ?>

<div id="content">
	<article class="category">
		<h1><span class="self">Aliment</span></h1>
		<section class="content">
		<?php
		if(empty($data['categories']))
			echo '<p class="sad">Aucune catégorie.</p>';
		else {
			echo '<ul>';
			foreach($data['categories'] as $category)
				echo '<li><a href="category/'.$category->getId().'">'.$category->getLabel().'</a></li>';
			echo '</ul>';
		}
		?>
		</section>
	</article>
</div>

<?php
} ?>