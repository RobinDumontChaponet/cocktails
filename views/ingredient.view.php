<?php

$view->setTitle('Ingredient : '.((empty($data['ingredient']))?$view->data['ingredient']->getLabel():''));
$view->importStylesheet('style/recipe-hierarchy.css');

$view->content = function ($data) { ?>

<div id="content">
	<?php
	if(empty($data['ingredient']))
		echo '<p class="sad">Aucun ingredient sélectionné.</p>';
	else
		echo $data['ingredient'];
	?>
</div>

<?php
} ?>