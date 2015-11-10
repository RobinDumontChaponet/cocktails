<?php

$view->setTitle('Categorie');
$view->importStylesheet('style/recipe-hierarchy.css');

$view->content = function ($data) { ?>

<div id="content">
	<?php
	if(empty($data['category']))
		echo '<p class="sad">Aucun type sélectionné.</p>';
	else
		echo $data['category'];
	?>
</div>

<?php
} ?>