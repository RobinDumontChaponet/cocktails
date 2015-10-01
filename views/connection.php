<!--meta title="Connexion" css="style/connection.css"-->
<div id="content">
	<form method="post" action="">
		<label>Identifiant</label>
		<input type="text" name="login" placeholder="Nom d'utilisateur"/>
		<label>Mot de passe</label>
		<input type="password" name="password" placeholder="Mot de passe"/>
		<a href="forgot" rel="forgot_password">Mot de passe oublié ?</a>
		<button type="submit" name="submit">Connexion</button>
		<a href="register">Vous n'avez pas de compte ? S'inscrire</a>
		<?php if ($badinput===true) echo'<p class="badpass">Identifiant ou mot-de-passe incorrects !</p>';?>
	</form>
</div>
