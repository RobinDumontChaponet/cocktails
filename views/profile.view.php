<?php

$view->setTitle('Profil');
$view->linkScript('script/passwords.transit.js');
$view->importStylesheet('style/profile.css');
use Transitive\Utils\Validation as Validation;

$view->content = function ($data) { ?>
<div id="content">
	<form method="post">
		<div>
			<label for="login">Nom d'utilisateur </label>
			<input type="text" readonly="readonly" id="login" value="<?= $data['user']->getLogin() ?>" />

			<label for="mail" name="email">E-mail</label>
			<?= Validation::invalidMessage('email'); ?>
			<input type="email" name="email" id="mail" placeholder="exemple@exemple.com" value="<?php if($_POST) {echo $_POST['email'];} else {echo $data['user']->getEmail();} ?>" />

			<label for="lastName">Nom</label>
			<?= Validation::invalidMessage('lastName'); ?>
			<input type="text" name="lastName" id="lastName" value="<?php if($_POST) {echo $_POST['lastName'];} else {echo $data['user']->getLastName();} ?>"/>

			<label for="firstName">Prénom</label>
			<?= Validation::invalidMessage('firstName'); ?>
			<input type="text" name="firstName" id="firstName" value="<?php if($_POST) {echo $_POST['firstName'];} else {echo $data['user']->getFirstName();} ?>"/>

			<label for="sex">Sexe</label>
			<?= Validation::invalidMessage('sex'); ?>
			<select name="sex" id="sex">
				<option value='' <?php if ($data['user']->getSex() == NULL) echo 'selected'; ?>></option>
		        <option value="m" <?php if ($data['user']->getSex() == 'm') echo 'selected'; ?>>Homme</option>
		        <option value="f" <?php if ($data['user']->getSex() == 'f') echo 'selected'; ?>>Femme</option>
			</select>
		</div>

		<div>
			<label for="birthDate">Date de naissance</label>
			<?= Validation::invalidMessage('birthDate'); ?>
			<input type="date" name="birthDate" id="birthDate" placeholder="jj/mm/aaaa" value="<?php if($_POST) {echo $_POST['birthDate'];} else {echo $data['user']->getBirthDate();} ?>"/>
			<?php echo $data['user']->getBirthDate() ?>

			<label for="address">Adresse</label>
			<?= Validation::invalidMessage('address'); ?>
			<input type="text" name="address" id="address" value="<?php if($_POST) {echo $_POST['address'];} else {echo $data['user']->getAddress();} ?>"/>

			<label for="postalCode">Code postal</label>
			<?= Validation::invalidMessage('postalCode'); ?>
			<input type="text" name="postalCode" id="postalCode" value="<?php if($_POST) {echo $_POST['postalCode'];} else {echo $data['user']->getPostalCode();} ?>"/>

			<label for="city">Ville</label>
			<?= Validation::invalidMessage('city'); ?>
			<input type="text" name="city" id="city" value="<?php if($_POST) {echo $_POST['city'];} else {echo $data['user']->getCity();} ?>"/>

			<label for="phoneNumber">Téléphone</label>
			<?= Validation::invalidMessage('phoneNumber'); ?>
			<input type="tel" autocomplete="off" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="phoneNumber" id="phoneNumber" value="<?php if($_POST && $_POST['phoneNumber'] == 10) {echo $_POST['phoneNumber'];} else {echo $data['user']->getPhoneNumber();} ?>"/>
		</div>

		<div>
			<label for="password">Nouveau mot de passe *</label>
			<input type="password" name="password" id="password" placeholder="5 caractères minimum" />
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
