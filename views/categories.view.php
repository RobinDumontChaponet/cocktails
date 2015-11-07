<?php

$view->setTitle('Types de cocktails');

$view->content = function ($data) { ?>

<div id="content">
	<?php
	if(empty($data['categories']))
		echo '<p class="sad">Aucune catégorie.</p>';
	else
		foreach($data['categories'] as $category)
			echo '<a href="category/'.$category->getId().'">'.$category->getLabel().'</a>';
	?>
</div>

<?php
} ?>