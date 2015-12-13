<?php

$view->setTitle('Inscription');
$view->importScript('script/passwords.transit.js');
$view->importStylesheet('style/profile.css');
use Transitive\Utils\Validation as Validation;

$view->content = function ($data) { ?>
<div id="content">
	<form method="post">
		<div>
			<label for="login">Nom d'utilisateur  *</label>
			<?php echo Validation::invalidMessage('login'); ?>
			<input type="text" name="login" id="login" placeholder="5 caractères minimum" value="<?php echo ($_POST)?$_POST['login']:'' ?>" required />

			<label name="email">E-mail</label>
			<?php echo Validation::invalidMessage('mail'); ?>
			<input type="email" name="email" id="email" placeholder="exemple@exemple.com" value="<?php echo ($_POST)?$_POST['email']:'' ?>" />

			<label for="lastName">Nom</label>
			<?php echo Validation::invalidMessage('lastName'); ?>
			<input type="text" name="lastName" value="<?php echo ($_POST)?$_POST['lastName']:'' ?>"/>

			<label for="firstName">Prénom</label>
			<?php echo Validation::invalidMessage('firstName'); ?>
			<input type="text" name="firstName" value="<?php echo ($_POST)?$_POST['firstName']:'' ?>"/>

			<label for="sex">Sexe</label>
			<select name="sex" id="sex">
				<option value='' <?php if ($_POST && $_POST['sex'] == NULL) echo 'selected'; ?>></option>
		        <option value="m" <?php if ($_POST && $_POST['sex']  == 'm') echo 'selected'; ?>>Homme</option>
		        <option value="f" <?php if ($_POST && $_POST['sex']  == 'f') echo 'selected'; ?>>Femme</option>
			</select>
		</div>

		<div>
			<label for="dBirthDate">Date de naissance</label>
			<?php echo Validation::invalidMessage('birthDate'); ?>
			<fieldset>
				<select name="dBirthDate">
					<option value="" disabled selected style="display:none;">Jour</option>
					<?php for($i = 1; $i <= 31; $i++) {
						if ($i <= 9)
							$i = '0'.$i;
						?>
						<option value='<?php echo $i;?>' <?php if ($_POST && $_POST['dBirthDate'] == $i) echo 'selected'; ?>><?php echo $i?></option>
					<?php } ?>
				</select>
				<select name="mBirthDate">
					<option value="" disabled selected style="display:none;">Mois</option>
					<?php for($i = 1; $i <= 12; $i++) {
						if ($i <= 9)
							$i = '0'.$i;
						?>
						<option value='<?php echo $i?>' <?php if ($_POST && $_POST['mBirthDate'] == $i) echo 'selected'; ?>><?php echo $i?></option>
					<?php } ?>
				</select>
				<select name="yBirthDate">
					<option value="" disabled selected style="display:none;">Année</option>
					<?php for($i = date("Y"); $i >= date("Y")-140; $i--) { ?>
						<option value='<?php echo $i?>' <?php if ($_POST && $_POST['yBirthDate'] == $i) echo 'selected'; ?>><?php echo $i?></option>
					<?php } ?>
				</select>
			</fieldset>

			<label for="address">Adresse</label>
			<input type="text" name="address" value="<?php echo ($_POST)?$_POST['address']:'' ?>"/>

			<label for="postalCode">Code postal</label>
			<input type="text" name="postalCode" value="<?php echo ($_POST)?$_POST['postalCode']:'' ?>"/>

			<label for="city">Ville</label>
			<?php echo Validation::invalidMessage('city'); ?>
			<input type="text" name="city" value="<?php echo($_POST)?$_POST['city']:'' ?>"/>

			<label for="phoneNumber">Téléphone</label>
			<?php echo Validation::invalidMessage('phoneNumber'); ?>
			<input type="text" name="phoneNumber" value="<?php echo ($_POST)?$_POST['phoneNumber']:'' ?>"/>
		</div>

		<div>
			<label for="password">Mot de passe *</label>
			<input type="password" name="password" id="password" placeholder="5 caractères minimum" required />
			<p class="notice" id="password-notice">Un bon mot de passe doit être suffisamment long. Il doit être composé d’au moins 3 types de caractères différents parmi les quatre types de caractères existants (majuscules, minuscules, chiffres et caractères spéciaux). Il ne devrait pas avoir de lien avec son détenteur (nom, date de naissance)…<br /><a href="http://www.cnil.fr/linstitution/actualite/article/article/securite-comment-construire-un-mot-de-passe-sur-et-gerer-la-liste-de-ses-codes-dacces/" title="Plus d'info sur la CNIL.fr" target="_blank">En savoir plus</a></p>
		</div>

		<input type="submit" name="signin" value="S'enregistrer"/>
		<p class="notice">Les champs marqué d'un * sont obligatoires</p>
	</form>
</div>
<script>
var bar=new ProgressBar('bar');
bar.insertBefore(document.getElementById('password-notice'));
document.getElementById('password').onkeyup = function(){checkPassword(this, bar)};
</script>
<?php
} ?>
