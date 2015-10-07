<!--meta title="Inscription"-->

<div>
    <section>
        <form method="post">
            <label for="login">Nom d'utilisateur</label>
            <input type="text" name="login" id="login" value='<?php if ($_POST) {
                echo $_POST['login'];
            } ?>' />

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" />

            <label name="mail">E-mail</label>
            <input type="email" name="mail" id="mail" placeholder="exemple@exemple.com" value='<?php if ($_POST) {
                echo $_POST['mail'];
            } ?>' />

            <label name="mailConfirmation">Confirmation adresse Email</label>
            <input type="email" name="mailConfirmation" id="mailConfirmation" placeholder="exemple@exemple.com" value='<?php if ($_POST) {
                echo $_POST['mailConfirmation'];
            } ?>' />

            <input type="submit" name="enregistrer" value="S'enregistrer"/>
        </form>
    </section>
</div>
