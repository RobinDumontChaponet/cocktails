<?php

$view->setTitle('Connexion');
$view->importStylesheet('style/login.css');

$view->content = function ($data) { ?>
<div id="content">
	<form action="login" method="post" name="connection">
		<?php if($data['bot']===true) echo'<p class="mapsitna">Accès interdit !</p>';
		else { ?>
			<label for="user">Identifiant</label>
			<input title="Identifiant" id="user" name="user" type="text" value="<?= isset($_POST['user'])?$_POST['user']:'' ?>" required autofocus />
			<label for="password">Mot-de-passe</label>
			<input title="Mot-de-passe" id="password" name="password" type="password" required />
			<?php if ($data['badInput']===true) echo'<p class="badpass">Identifiant ou mot-de-passe incorrects !</p>';?>
			<br /><br /><?php /* f****/ ?>
			<input class="<?= ($data['badInput']!==true)?'ok':'warning' ?>" name="submit" type="submit" value="connexion" />
			<a href="signin">Pas de compte ?<br />Inscrivez-vous.</a><a href="forgot" rel="forgot_password">Mot de passe oublié ?</a>
			<!--<br /><a href="#" title="mot de passe oublié ?">mot de passe oublié ?</a>-->
		<?php } ?>
	</form>
</div>
<?php
} ?>