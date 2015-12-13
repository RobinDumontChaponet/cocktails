<?php

require_once MODELS_INC.'UserDAO.class.php';
use Transitive\Utils\Passwords as Passwords;
use Transitive\Utils\Validation as Validation;

if(isset($_SESSION['cocktailsUser']))
	$request->redirect('profile');

if($_POST) {
	$modified = false;
	Validation::trimForm(array('firstName', 'lastName', 'sex', 'email', 'birthDate', 'address', 'postalCode', 'city', 'phoneNumber'), $_POST);

	Validation::validateForm (array(
		'login' => function($value) { return (!UserDAO::getByLogin($_POST['login']))?true:'Un utilisateur possède déjà ce nom'; },
		'firstName' => function($value){ return (!Validation::contains_numeric($value))?true:'Un prénom n\'a pas de chiffres ...'; },
		'lastName' => function($value){ return (!Validation::contains_numeric($value))?true:'Un nom n\'a pas de chiffres ...'; },
		'city' => function($value){ return (!Validation::contains_numeric($value))?true:'Une ville n\'a pas de chiffres ...'; },
		'phoneNumber' => function($value){ return (( !empty($value) && Validation::is_valid_phoneNumber($value)) || $value == "" || empty($value))?true:'Numéro de téléphone non valide'; },
		'email' => function($value){ return (Validation::is_valid_email($value) || $value == "" || empty($value))?true:'Mail non valide'; }
	), $_POST);

	if(Validation::isFormValid()) {
		$_POST['birthDate'] = $_POST['yBirthDate'].'-'.$_POST['mBirthDate'].'-'.$_POST['dBirthDate'];
		$password = Passwords::create_hash($_POST['password']);
		$newUser = new User($_POST['login'], $password, $_POST['firstName'], $_POST['lastName'], $_POST['sex'], $_POST['email'], $_POST['birthDate'], $_POST['address'], $_POST['postalCode'], $_POST['city'], $_POST['phoneNumber']);
		UserDAO::create($newUser);
        $request->redirect('login');
	}
}

?>
