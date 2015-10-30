<?php

namespace Transitive\Utils;

use Transitive\Utils\Urls;

abstract class Mails {
	public static function send ($from, $name, $subject, $othersubject, $msg) {
		$error=array();

		if(isset($msg)) {
			// *********************Sanitization**********************************
			$msg=filter_var($msg, FILTER_UNSAFE_RAW);

			$from=htmlspecialchars(filter_var($from, FILTER_SANITIZE_EMAIL));
			$name=htmlspecialchars(filter_var($name, FILTER_SANITIZE_STRING));
			$subject=htmlspecialchars(filter_var($subject, FILTER_SANITIZE_STRING));

			// *********************FormValidation********************************
			if(trim($subject)=='' || $subject=='objet') $error[]='Vous avez oublié de préciser l\'object de votre message!</span>';
			if(trim($subject)=='autre' && (trim($othersubject)=='' || $othersubject=='objet')) $error[]='Vous avez oublié de préciser l\'object de votre message!</span>';
			if(trim($msg)=='' || $msg=='message...') $error[]='Vous avez oublié d\'écrire votre message!';
			if(trim($name)=='' || $name=='nom') $error[]='Vous avez oublié d\'indiquer votre nom!';
			if(trim($from)=='') $error[]='Vous avez oublié d\'indiquer votre adresse e-mail!';
			if(!filter_var ($from, FILTER_VALIDATE_EMAIL)) $error[]='Vous avez fourni une adresse e-mail invalide!';

			if($subject=='autre')
				$subject=$subject.' - '.$othersubject;
			else
				$subject=$subject;


			// *********************ConstructMessage*****************************
			$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head>
		<title>L\'écritoire moderne | Contact :</title>
		<link rel="stylesheet" type="text/css" href="http://www.colouring-tour.org/style/reset.min.css">
		<link rel="stylesheet" type="text/css" href="http://tmp.colouring-tour.org/style/mail.css">
		</head><body>
		<div id="wrapper">
		<h1>Colouring-tour | Contact</h1>
		<h2>'.$subject.'</h2><h3>de : '.$name.' &lt;'.$from.'&gt;</h3><hr />';
			$message.='<div>'.$msg.'</div><hr />
		</body></html>';


			// *********************SENDING(or not sending, that's the question)***
			if(empty($error)){
				$header ='MIME-Version: 1.0' . "\r\n";
				$header.='Content-type: text/html; charset=utf-8' . "\r\n";
				$header.='from: "'.$name.'" <'.$from.'>';

				// contact@colouring-tour.org
				$send=mail("contact@colouring-tour.org", 'Contact colouring-tour.org : '.$subject, stripslashes($message), $header);
				if($send===true)
					return true;
				else
					return false;
			} else
				return $error;
		}
	}
}

?>