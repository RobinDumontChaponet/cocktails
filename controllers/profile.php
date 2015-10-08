<?php
if (isset($_SESSION['cocktailsUser'])) {
    require_once MODELS_INC.'UserDAO.class.php';
    $user = UserDAO::getByLogin($_SESSION['cocktailsUser']->getLogin());
} else  {
    header ('Location: signin');
}

if( $_POST ) {
    $modified = false;
    if ($_POST['firstName'] != $user->getFirstName()) {
        $user->setFirstName($_POST['firstName']);
        $modified = true;
    }
    if ($_POST['lastName'] != $user->getLastName()) {
        $user->setLastName($_POST['lastName']);
        $modified = true;
    }
    if ($_POST['sex'] != $user->getSex()) {
        $user->setSex($_POST['sex']);
        $modified = true;
    }
    if ($_POST['email'] != $user->getEmail()) {
        $user->setEmail($_POST['email']);
        $modified = true;
    }
    if ($_POST['birthDate'] != $user->getBirthDate()) {
        $user->setBirthDate($_POST['birthDate']);
        $modified = true;
    }
    if ($_POST['address'] != $user->getAddress()) {
        $user->setAddress($_POST['address']);
        $modified = true;
    }
    if ($_POST['postalCode'] != $user->getPostalCode()) {
        $user->setPostalCode($_POST['postalCode']);
        $modified = true;
    }
    if ($_POST['city'] != $user->getCity()) {
        $user->setCity($_POST['city']);
        $modified = true;
    }
    if ($_POST['phoneNumber'] != $user->getPhoneNumber()) {
        $user->setPhoneNumber($_POST['phoneNumber']);
        $modified = true;
    }
    if( $modified ) {
        UserDAO::update($user);
        header ('Location: profile');
    }
}

include(VIEWS_INC.'profile.php');

?>
