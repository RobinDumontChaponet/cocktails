<!--meta title="Votre profil"-->

<div id="content">
	<form method="post">
		<label for="lastename">Nom</label>
		<input type="text" name="lastName" value=<?php echo $user->getLastName(); ?>>

		<label for="firstname">Prénom</label>
		<input type="text" name="firstName" value=<?php echo $user->getFirstName(); ?>>

        <label for="sex">Sexe</label>
        <select name="sex">
            <option value='' <?php if ($user->getSex() == NULL) { echo 'selected'; }?>></option>
            <option value="m" <?php if ($user->getSex() == 'm') { echo 'selected'; }?>>Homme</option>
            <option value="f" <?php if ($user->getSex() == 'f') { echo 'selected'; }?>>Femme</option>
        </select>

        <label for="mail">Adresse mail</label>
        <input type="text" name="mail" placeholder="mail" value=<?php echo $user->getEmail(); ?>>

		<label for="birthDate">Date de naissance</label>
        <input type="date" name="birthDate" value=<?php echo $user->getBirthDate(); ?>>

		<label for="address">Adresse</label>
        <input type="text" name="address" value=<?php echo $user->getAddress(); ?>>

		<label for="postalCode">Code postal</label>
        <input type="text" name="postalCode" value=<?php echo $user->getPostalCode(); ?>>

		<label for="city">Ville</label>
        <input type="text" name="city" value=<?php echo $user->getCity(); ?>>

		<label for="phoneNumber">Téléphone</label>
        <input type="text" name="phoneNumber" value=<?php echo $user->getPhoneNumber(); ?>>

		<input type="submit" value="enregistrer"/>
	</form>
</div>
