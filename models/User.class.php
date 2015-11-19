<?php

class User {

	// Variables
	private $login;
	private $password;
	private $firstName;
	private $lastName;
	private $sex;
	private $email;
	private $birthDate;
	private $address;
	private $postalCode;
	private $city;
	private $phoneNumber;

	// Constructors
	public function __construct ($login, $password='', $firstName='', $lastName='', $sex='', $email='', $birthDate='', $address='', $postalCode='', $city='', $phoneNumber='') {
		$this->login=$login;
		$this->password=(empty($password))?self::randomPassword():$password;
		$this->firstName=$firstName;
		$this->lastName=$lastName;
		$this->sex=$sex;
		$this->email=$email;
		$this->birthDate=$birthDate;
		$this->address=$address;
		$this->postalCode=$postalCode;
		$this->city=$city;
		$this->phoneNumber=$phoneNumber;
	}

	// Getters
	public function getLogin () {
		return $this->login;
	}
	public function getPassword () {
		return $this->password;
	}
	public function getFirstName () {
		return $this->firstName;
	}
	public function getLastName () {
		return $this->lastName;
	}
	public function getSex () {
		return $this->sex;
	}
	public function getEmail () {
		return $this->email;
	}
	public function getBirthDate () {
		return $this->birthDate;
	}
	public function getAddress () {
		return $this->address;
	}
	public function getPostalCode () {
		return $this->postalCode;
	}
	public function getCity () {
		return $this->city;
	}
	public function getPhoneNumber () {
		return $this->phoneNumber;
	}

	// Setters
	public function setLogin ($login) {
		$this->login=$login;
	}
	public function setPassword ($password) {
		$this->password=$password;
	}
	public function setFirstName ($firstName) {
		$this->firstName=$firstName;
	}
	public function setLastName ($lastName) {
		$this->lastName=$lastName;
	}
	public function setSex ($sex) {
		$this->sex=$sex;
	}
	public function setEmail ($email) {
		$this->email=$email;
	}
	public function setBirthDate ($birthDate) {
		$this->birthDate=$birthDate;
	}
	public function setAddress ($address) {
		$this->address=$address;
	}
	public function setPostalCode ($postalCode) {
		$this->postalCode=$postalCode;
	}
	public function setCity ($city) {
		$this->city=$city;
	}
	public function setPhoneNumber ($phoneNumber) {
		$this->phoneNumber=$phoneNumber;
	}

	// Functions
	public function __toString () {
		return 'User [ login: '.$this->login.'; , $firstName:'.$this->firstName.'; $lastName:'.$this->lastName.'; $sex:'.$this->sex.'; $email:'.$this->email.'; $birthDate:'.$this->birthDate.'; $address:'.$this->address.'; $postalCode:'.$this->postalCode.'; $city:'.$this->city.'; $phoneNumber:'.$this->phoneNumber.' ]';
	}
}
?>
