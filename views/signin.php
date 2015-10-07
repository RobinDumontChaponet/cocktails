<!--meta title="Inscription"-->

<div>
    <section>
        <form method="post">
            <section>
                <label for="login">Nom d'utilisateur</label>
                <span>5 caractères minimum</span>
                <input type="text" name="login" id="login" placeholder="nom d'utilisateur" value='<?php if ($_POST) {
                    echo $_POST['login'];
                } ?>' />

                <label for="password">Mot de passe</label>
                <span>5 caractères minimum</span>
                <input type="password" name="password" id="password" placeholder="mot-de-passe"/>

                <label name="email">E-mail</label>
                <input type="email" name="email" id="mail" placeholder="exemple@exemple.com" value='<?php if ($_POST) {
                    echo $_POST['email'];
                } ?>' />
            </section>
            <section>
                <label for="lastName">Nom</label>
                <input type="text" name="lastName" value="<?php if( $_POST ) { echo $_POST['lastName']; }?>"/>

                <label for="firstName">Prénom</label>
                <input type="text" name="firstName" value="<?php if( $_POST ) { echo $_POST['firstName']; }?>"/>

                <label for="sex">Sexe</label>
                <select name="sex">
                    <option value="m">Homme</option>
                    <option value="f">Femme</option>
                </select>

                <label for="birthDate">Date de naissance</label>
                <input type="date" name="birthDate" value="<?php if( $_POST ) { echo $_POST['birthDate']; }?>"/>

                <label for="address">Adresse</label>
                <input type="text" name="address" value="<?php if( $_POST ) { echo $_POST['address']; }?>"/>

                <label for="postalCode">Code postal</label>
                <input type="text" name="postalCode" value="<?php if( $_POST ) { echo $_POST['postalCode']; }?>"/>

                <label for="city">Ville</label>
                <input type="text" name="city" value="<?php if( $_POST ) { echo $_POST['city']; }?>"/>

                <label for="phoneNumber">Téléphone</label>
                <input type="text" name="phoneNumber" value="<?php if( $_POST ) { echo $_POST['phoneNumber']; }?>"/>
            </section>
            <input type="submit" name="enregistrer" value="S'enregistrer"/>
        </form>
    </section>
</div>
