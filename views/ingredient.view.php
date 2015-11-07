<?php

$view->setTitle('Ingredient');

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