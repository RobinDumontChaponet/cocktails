<?php

if (!isset($_SESSION['cocktailsUser']))
	$request->redirect('signin');

require_once MODELS_INC.'UserDAO.class.php';
use Transitive\Utils\Validation as Validation;
$user = UserDAO::getByLogin($_SESSION['cocktailsUser']->getLogin());

$formValidation = null;
if( $_POST ) {
	$modified = false;
	Validation::trimForm(array('firstName', 'lastName', 'sex', 'email', 'birthDate', 'address', 'postalCode', 'city', 'phoneNumber'), $_POST);

	Validation::validateForm (array(
		'firstName' => function($value){ return (!Validation::contains_numeric($value))?true:'Un prénom n\'a pas de chiffres ...'; },
		'lastName' => function($value){ return (!Validation::contains_numeric($value))?true:'Un nom n\'a pas de chiffres ...'; },
		'city' => function($value){ return (!Validation::contains_numeric($value))?true:'Une ville n\'a pas de chiffres ...'; },
		'phoneNumber' => function($value){ return (( !empty($value) && Validation::is_valid_phoneNumber($value)) || $value == "" || empty($value))?true:'Numéro de téléphone non valide'; },
		'email' => function($value){ return (Validation::is_valid_email($value) || $value == "" || empty($value))?true:'Mail non valide'; }
		//'birthDate' => function($value){ return ($value >= )?true:'Soyez résonnable'; }
	), $_POST);


	if(Validation::isFormValid()) {
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
	    }
	}
}

$controller->data['user'] = &$user;

?>
