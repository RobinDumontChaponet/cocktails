<?php

namespace Transitive\Utils;

abstract class Validation {
	private static $formValidation;
	private static $formValidity;

	public static function validateForm ($formElements, $values) {
		self::$formValidation = array();
		self::$formValidity = true;

		if(isset($formElements)) {
			foreach($formElements as $name => $element)
				if(isset($values[$name]) && (gettype($element)=='object' && get_class($element)=='Closure') && (self::$formValidation[$name] = $element($values[$name]))!==true) {
					self::$formValidation[$name] = '<p class="error">'.self::$formValidation[$name].'</p>';
					self::$formValidity = false;
				}
		}
	}

	public static function trimForm ($formElements, &$values) {
		if(isset($formElements)) {
			foreach($formElements as $elementName)
				if(isset($values[$elementName]))
					$values[$elementName] = trim($values[$elementName]);
		}
	}

	public static function isFormValid () {
		return self::$formValidity;
	}


	public static function isValid ($formElementName) {
		return (isset(self::$formValidation[$formElementName]))?self::$formValidation[$formElementName]:null;
	}

	public static function invalidMessage ($formElementName) {
		return (($message = self::isValid($formElementName))!==true)?$message:'';
	}

	public static function is_valid_phoneNumber ($number) {
		return (!preg_match('/^([+]?\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i', preg_replace('/ /', '', $number)))?false:true;
	}

	public static function is_valid_email ($str) {
	    return (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $str))?false:true;
	}

	public static function contains_numeric ($str) {
		return preg_match('/[0-9]+/', $str);
	}

	public static function contains ($needles, $str) {
		return strlen($str) != strcspn($str, $needles);
	}

	public static function format_date ($str) {
		if(strtotime($str)!==false)
			return date('Y-m-d', strtotime($str));

		return false;
	}

	public static function is_within ($number, $low, $high) {
		return $number>$low && $number <=$high;
	}

	public static function is_port_number ($number) {
		return self::is_within ($number, 0, 65535);
	}

	public static function is_valid_SQL_date ($date) {
		if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $matches))
			if (checkdate($matches[2], $matches[3], $matches[1]))
				return true;

		return false;
	}
}

?>