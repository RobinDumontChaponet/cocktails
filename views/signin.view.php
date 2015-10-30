<!--meta title="Inscription" js="script/passwords.transit.js"-->
<?php

$view->setTitle('Inscription');
$view->importScript('script/passwords.transit.js');
$view->addStyle('
input, select {
	display: block;
	margin-left: auto;
	margin-right: auto;
}
form div {
	display: inline-block;
	vertical-align: top;
	width: 33%;
	text-align: center;
}
.progress {
	width: 190px;
	margin: 0 auto;
	text-align: center;
	position: relative;
	top: -30px;
	pointer-events: none;
}
.progress span {
	display: block;
	border-bottom-left-radius: 4px;
	width: 0;
	padding: 0;
	height: 32px;
	background: rgba(255, 0, 0, .05);
	border-bottom: 3px solid red;

	-webkit-transition: padding .1s linear;
	-moz-transition: padding .1s linear;
	-o-transition: padding .1s linear;
	transition: padding .1s linear;
}
.progress span[data-progress^="4"] {
	border-bottom-color: lightcoral;
	background-color: rgba(240, 127, 127, .05);
}
.progress span[data-progress^="6"] {
	border-bottom-color: lightsalmon;
	background-color: rgba(255, 160, 123, .05);
}
.progress span[data-progress^="8"] {
	border-bottom-color: rgb(255, 210, 0);
	background-color: rgba(255, 210, 0, .05);
}
.progress span[data-progress="100%"] {
	border-bottom-color: lightgreen;
	background-color: rgba(146, 238, 146, .15);
	border-bottom-right-radius: 4px;
}');

$view->content = function (&$data) { ?>
<div id="content">
	<?php if ( $_POST && $errorExistingLogin ) {
		echo '<p>Ce nom de compte existe déjà</p>';
	} ?>
	<form method="post">
		<div>
			<label for="login">Nom d'utilisateur  *</label>
			<input type="text" name="login" id="login" placeholder="5 caractères minimum" value="<?= ($_POST)?$_POST['login']:'' ?>" required />

			<label name="email">E-mail</label>
			<input type="email" name="email" id="mail" placeholder="exemple@exemple.com" value="<?= ($_POST)?$_POST['email']:'' ?>" />

			<label for="lastName">Nom</label>
			<input type="text" name="lastName" value="<?= ($_POST)?$_POST['lastName']:'' ?>"/>

			<label for="firstName">Prénom</label>
			<input type="text" name="firstName" value="<?= ($_POST)?$_POST['firstName']:'' ?>"/>

			<label for="sex">Sexe</label>
			<select name="sex">
				<option value=''></option>
				<option value="m">Homme</option>
				<option value="f">Femme</option>
			</select>
		</div>

		<div>
			<label for="birthDate">Date de naissance</label>
			<input type="date" name="birthDate" placeholder="jj/mm/aaaa" value="<?= ($_POST)?$_POST['birthDate']:'' ?>"/>

			<label for="address">Adresse</label>
			<input type="text" name="address" value="<?= ($_POST)?$_POST['address']:'' ?>"/>

			<label for="postalCode">Code postal</label>
			<input type="text" name="postalCode" value="<?= ($_POST)?$_POST['postalCode']:'' ?>"/>

			<label for="city">Ville</label>
			<input type="text" name="city" value="<?=($_POST)?$_POST['city']:'' ?>"/>

			<label for="phoneNumber">Téléphone</label>
			<input type="text" name="phoneNumber" value="<?= ($_POST)?$_POST['phoneNumber']:'' ?>"/>
		</div>

		<div>
			<label for="password">Mot de passe *</label>
			<input type="password" name="password" id="password" placeholder="5 caractères minimum" required />
			<p class="notice" id="password-notice">Un bon mot de passe doit être suffisamment long. Il doit être composé d’au moins 3 types de caractères différents parmi les quatre types de caractères existants (majuscules, minuscules, chiffres et caractères spéciaux). Il ne devrait pas avoir de lien avec son détenteur (nom, date de naissance)…<br /><a href="http://www.cnil.fr/linstitution/actualite/article/article/securite-comment-construire-un-mot-de-passe-sur-et-gerer-la-liste-de-ses-codes-dacces/" title="Plus d'info sur la CNIL.fr" target="_blank">En savoir plus</a></p>
		</div>

		<input type="submit" name="enregistrer" value="S'enregistrer"/>
	</form>
</div>
<script>
var bar=new ProgressBar('bar');
bar.insertBefore(document.getElementById('password-notice'));
document.getElementById('password').onkeyup = function(){checkPassword(this, bar)};
</script>
<?php
} ?>