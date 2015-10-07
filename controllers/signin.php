<?php

if( $_POST ) {
        if( isset($_POST['login']) && strlen($_POST['login']) >= 5  ) {
        $existingLogin = UserDAO::getByLogin($_POST['login']);
        var_dump($existingLogin);
        $login = $_POST['login'];
        $valid['login'] = true;
    } else {
        $valid['login'] = false;
    }

    if( isset($_POST['password']) && strlen($_POST['password']) >= 5  ) {
        $password = $_POST['password'];
        $valid['password'] = true;
    } else {
        $valid['password'] = false;
    }

    if( $_POST['email'] != NULL) {
        $mail = $_POST['email'];
        $valid['email'] = true;
    } else {
        $valid['email'] = false;
    }

    if( $valid['login'] && $valid['password'] ) {
        require_once MODELS_INC.'UserDAO.class.php';
        include('passwordHash.inc.php');
        $password = create_hash($password);
        $newUser = new User($login, $password, $_POST['firstName'], $_POST['lastName'], $_POST['sex'], $_POST['email'], $_POST['birthDate'], $_POST['address'], $_POST['postalCode'], $_POST['city'], $_POST['phoneNumber']);
        //var_dump($newUser);
        //UserDAO::create($newUser);
        //header('Location: connection');
    }

}


include(VIEWS_INC.'signin.php');

?>
