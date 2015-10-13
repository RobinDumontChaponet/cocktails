<!--meta title="Profil"-->
<style>
input {
	display: block;
}
form div {
	display: inline-block;
}
</style>
<div id="content">
	<form method="post">
		<div>
			<label for="lastename">Nom</label>
			<input type="text" name="lastName" value=<?php echo $user->getLastName(); ?>>
			<label for="firstname">Prénom</label>
			<input type="text" name="firstName" value=<?php echo $user->getFirstName(); ?>>

			<fieldset>
		        <label for="sex">Sexe</label>
		        <select name="sex">
		            <option value='' <?php if ($user->getSex() == NULL) { echo 'selected'; }?>></option>
		            <option value="m" <?php if ($user->getSex() == 'm') { echo 'selected'; }?>>Homme</option>
		            <option value="f" <?php if ($user->getSex() == 'f') { echo 'selected'; }?>>Femme</option>
		        </select>
			</fieldset>

	        <label for="email">Adresse mail</label>
	        <input type="text" name="email" placeholder="exemple@exemple.org" value=<?php echo $user->getEmail(); ?>>

			<label for="birthDate">Date de naissance</label>
	        <input type="date" name="birthDate" placeholder="jj/mm/aaaa" value=<?php echo $user->getBirthDate(); ?>>
		</div>
		<div>
			<label for="address">Adresse</label>
	        <input type="text" name="address" value=<?php echo $user->getAddress(); ?>>

			<label for="postalCode">Code postal</label>
	        <input type="text" name="postalCode" value=<?php echo $user->getPostalCode(); ?>>

			<label for="city">Ville</label>
	        <input type="text" name="city" value=<?php echo $user->getCity(); ?>>

			<label for="phoneNumber">Téléphone</label>
	        <input type="text" name="phoneNumber" value=<?php echo $user->getPhoneNumber(); ?>>
		</div>
		<input type="submit" value="enregistrer"/>
	</form>
</div>
