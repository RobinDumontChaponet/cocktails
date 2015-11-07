<?php

$view->setTitle('Recette : ');

$view->content = function ($data) { ?>
<div id="content">
	<?php
	if(empty($data['recipe']))
		echo '<p class="sad">Aucune recette sélectionnée.</p>';
	else
		echo $data['recipe'];
	?>
</div>
<?php
} ?>