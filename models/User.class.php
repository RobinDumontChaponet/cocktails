<?php

class User {
	private $id;
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

	public function __construct ($id='', $login='', $password='', $firstName='', $lastName='', $sex='', $email='', $birthDate='', $address='', $postalCode='', $city='', $phoneNumber='') {
		$this->id=$id;
		$this->login=$login;
		$this->password=$password;
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

	public function getId () {
		return $this->id;
	}
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


	public function setId ($id) {
		$this->id=$id;
	}
	public function setLogin ($login) {
		$this->login=$login;
	}
	public function setPassword ($password) {
		$this->password=$password;
	}
	public function getFirstName ($firstName) {
		$this->firstName=$firstName;
	}
	public function getLastName ($lastName) {
		$this->lastName=$lastName;
	}
	public function getSex ($sex) {
		$this->sex=$sex;
	}
	public function getEmail ($email) {
		$this->email=$email;
	}
	public function getBirthDate ($birthDate) {
		$this->birthDate=$birthDate;
	}
	public function getAddress ($address) {
		$this->address=$address;
	}
	public function getPostalCode ($postalCode) {
		$this->postalCode=$postalCode;
	}
	public function getCity ($city) {
		$this->city=$city;
	}
	public function getPhoneNumber ($phoneNumber) {
		$this->phoneNumber=$phoneNumber;
	}

	public function __toString () {
		return 'User [ id: '.$this->id.'; login: '.$this->login.'; , $firstName:'.$this->firstName.'; $lastName:'.$this->lastName.'; $sex:'.$this->sex.'; $email:'.$this->email.'; $birthDate:'.$this->birthDate.'; $address:'.$this->address.'; $postalCode:'.$this->postalCode.'; $city:'.$this->city.'; $phoneNumber:'.$this->phoneNumber.' ]';
	}


	public function randomPassword( $length = 8 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
}
?>