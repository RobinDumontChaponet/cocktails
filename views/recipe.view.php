<?php

$view->setTitle('Recette : '.((empty($data['recipe']))?$view->data['recipe']->getTitle():''));
$view->addStyle ('section {min-height: 252px}');

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