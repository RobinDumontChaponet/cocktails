<?php

$view->setTitle('Profil');
$view->linkScript('script/passwords.transit.js');
$view->importStylesheet('style/profile.css');
use Transitive\Utils\Validation as Validation;


$view->content = function ($data) {
$birthDate = explode('-', $data['user']->getBirthDate());
?>
<div id="content">
	<form method="post">
		<!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
		<input style="display:none" type="text" name="fakeusernameremembered"/>
		<input style="display:none" type="password" name="fakepasswordremembered"/>
		<!-- [/] fake fields are a workaround for chrome autofill getting the wrong fields -->
		<div>
			<label for="login">Nom d'utilisateur </label>
			<input type="text" readonly="readonly" id="login" value="<?php echo $data['user']->getLogin() ?>" />

			<label for="mail" name="email">E-mail</label>
			<?php echo Validation::invalidMessage('email'); ?>
			<input type="email" name="email" id="mail" placeholder="exemple@exemple.com" value="<?php if($_POST) {echo $_POST['email'];} else {echo $data['user']->getEmail();} ?>" />

			<label for="lastName">Nom</label>
			<?php echo Validation::invalidMessage('lastName'); ?>
			<input type="text" name="lastName" id="lastName" value="<?php if($_POST) {echo $_POST['lastName'];} else {echo $data['user']->getLastName();} ?>"/>

			<label for="firstName">Prénom</label>
			<?php echo Validation::invalidMessage('firstName'); ?>
			<input type="text" name="firstName" id="firstName" value="<?php if($_POST) {echo $_POST['firstName'];} else {echo $data['user']->getFirstName();} ?>"/>

			<label for="sex">Sexe</label>
			<?php echo Validation::invalidMessage('sex'); ?>
			<select name="sex" id="sex">
				<option value='' <?php if ($data['user']->getSex() == NULL) echo 'selected'; ?>></option>
		        <option value="m" <?php if ($data['user']->getSex() == 'm') echo 'selected'; ?>>Homme</option>
		        <option value="f" <?php if ($data['user']->getSex() == 'f') echo 'selected'; ?>>Femme</option>
			</select>
		</div>

		<div>
			<label for="birthDate">Date de naissance</label>
			<?php echo Validation::invalidMessage('birthDate'); ?>
			<select name="dBirthDate">
				<option value=''>Jour</option>
				<?php for($i = 1; $i <= 31; $i++) {
					if ($i <= 9)
						$i = '0'.$i;
					?>
					<option value='<?php echo $i;?>' <?php if (($_POST && $_POST['dBirthDate'] == $i) || $birthDate[2] == $i) echo 'selected'; ?>><?php echo $i?></option>
				<?php } ?>
			</select>
			<select name="mBirthDate">
				<option value=''>Mois</option>
				<?php for($i = 1; $i <= 12; $i++) {
					if ($i <= 9)
						$i = '0'.$i;
					?>
					<option value='<?php echo $i?>' <?php if (($_POST && $_POST['mBirthDate'] == $i) || $birthDate[1] == $i) echo 'selected'; ?>><?php echo $i?></option>
				<?php } ?>
			</select>
			<select name="yBirthDate">
				<option value=''>Année</option>
				<?php for($i = date("Y"); $i >= date("Y")-140; $i--) { ?>
					<option value='<?php echo $i?>' <?php if (($_POST && $_POST['yBirthDate'] == $i) || $birthDate[0] == $i) echo 'selected'; ?>><?php echo $i?></option>
				<?php } ?>
			</select>

			<label for="address">Adresse</label>
			<?php echo Validation::invalidMessage('address'); ?>
			<input type="text" name="address" id="address" value="<?php if($_POST) {echo $_POST['address'];} else {echo $data['user']->getAddress();} ?>"/>

			<label for="postalCode">Code postal</label>
			<?php echo Validation::invalidMessage('postalCode'); ?>
			<input type="text" name="postalCode" id="postalCode" value="<?php if($_POST) {echo $_POST['postalCode'];} else {echo $data['user']->getPostalCode();} ?>"/>

			<label for="city">Ville</label>
			<?php echo Validation::invalidMessage('city'); ?>
			<input type="text" name="city" id="city" value="<?php if($_POST) {echo $_POST['city'];} else {echo $data['user']->getCity();} ?>"/>

			<label for="phoneNumber">Téléphone</label>
			<?php echo Validation::invalidMessage('phoneNumber'); ?>
			<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="phoneNumber" id="phoneNumber" value="<?php if(isset($_POST['phoneNumber'])) echo $_POST['phoneNumber']; else echo $data['user']->getPhoneNumber(); ?>"/>
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
