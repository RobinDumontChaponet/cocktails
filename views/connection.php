<!--meta title="Connexion" css="style/connection.css"-->
<div id="content">
	<form action="connection" method="post" name="connection">
		<fieldset>
		<?php if($bot===true) echo'<p class="mapsitna">Accès interdit !</p>';
		else { ?>
			<legend>Cocktails</legend>
			<label for="user">Identifiant</label><input title="Identifiant" id="user" name="user" type="text" value="<?= isset($_POST['user'])?$_POST['user']:'' ?>" required autofocus />
			<br />
			<label for="password">Mot-de-passe</label><input title="Mot-de-passe" id="password" name="password" type="password" required />
			<br />
			<?php if ($badinput===true) echo'<p class="badpass">Identifiant ou mot-de-passe incorrects !</p>';?>
			<br />
			<input class="<?= ($badinput!==true)?'ok':'warning' ?>" name="submit" type="submit" value="&#xe60c; connexion" />
			<a href="forgot" rel="forgot_password">Mot de passe oublié ?</a>
			<!--<br /><a href="#" title="mot de passe oublié ?">mot de passe oublié ?</a>-->
		<?php } ?>
		</fieldset>
</form>
</div>
