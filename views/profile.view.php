<?php

$view->setTitle('Profil');
$view->linkScript('script/passwords.transit.js');
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
	<form method="post">
		<div>
			<label for="login">Nom d'utilisateur </label>
			<input type="text" readonly="readonly" id="login" value="<?= $data['user']->getLogin() ?>" />

			<label for="mail" name="email">E-mail</label>
			<input type="email" name="email" id="mail" placeholder="exemple@exemple.com" value="<?= $data['user']->getEmail() ?>" />

			<label for="lastName">Nom</label>
			<input type="text" name="lastName" id="lastName" value="<?= $data['user']->getLastName() ?>"/>

			<label for="firstName">Prénom</label>
			<input type="text" name="firstName" id="firstName" value="<?= $data['user']->getFirstName() ?>"/>

			<label for="sex">Sexe</label>
			<select name="sex" id="sex">
				<option value='' <?php if ($data['user']->getSex() == NULL) echo 'selected'; ?>></option>
		        <option value="m" <?php if ($data['user']->getSex() == 'm') echo 'selected'; ?>>Homme</option>
		        <option value="f" <?php if ($data['user']->getSex() == 'f') echo 'selected'; ?>>Femme</option>
			</select>
		</div>

		<div>
			<label for="birthDate">Date de naissance</label>
			<input type="date" name="birthDate" id="birthDate" placeholder="jj/mm/aaaa" value="<?= $data['user']->getBirthDate() ?>"/>

			<label for="address">Adresse</label>
			<input type="text" name="address" id="address" value="<?= $data['user']->getAddress() ?>"/>

			<label for="postalCode">Code postal</label>
			<input type="text" name="postalCode" id="postalCode" value="<?= $data['user']->getPostalCode() ?>"/>

			<label for="city">Ville</label>
			<input type="text" name="city" id="city" value="<?= $data['user']->getCity() ?>"/>

			<label for="phoneNumber">Téléphone</label>
			<input type="text" name="phoneNumber" id="phoneNumber" value="<?= $data['user']->getPhoneNumber() ?>"/>
		</div>

		<div>
			<label for="password">Nouveau mot de passe *</label>
			<input type="password" name="password" id="password" placeholder="5 caractères minimum" required />
			<p class="notice" id="password-notice">Un bon mot de passe doit être suffisamment long. Il doit être composé d’au moins 3 types de caractères différents parmi les quatre types de caractères existants (majuscules, minuscules, chiffres et caractères spéciaux). Il ne devrait pas avoir de lien avec son détenteur (nom, date de naissance)…<br /><a href="http://www.cnil.fr/linstitution/actualite/article/article/securite-comment-construire-un-mot-de-passe-sur-et-gerer-la-liste-de-ses-codes-dacces/" title="Plus d'info sur la CNIL.fr" target="_blank">En savoir plus</a></p>
		</div>

		<input type="submit" value="enregistrer"/>
	</form>
</div>
<script>
var bar=new ProgressBar('bar');
bar.insertBefore(document.getElementById('password-notice'));
document.getElementById('password').onkeyup = function(){checkPassword(this, bar)};
</script>
<?php } ?>