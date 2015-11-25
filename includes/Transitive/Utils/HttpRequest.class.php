<?php

namespace Transitive\Utils;

if (!function_exists('http_response_code')) {
	function http_response_code($newcode = NULL) {
		static $code = 200;
		if($newcode !== NULL) {
			header('X-PHP-Response-Code: '.$newcode, true, $newcode);
			if(!headers_sent())
				$code = $newcode;
		}
		return $code;
	}
}

abstract class HttpRequest {
	public static function http_response_message () {
		$code = http_response_code();
		if(isset(self::$httpCustomStatusMessages[$code]))
			return self::$httpCustomStatusMessages[$code];
		return self::$httpStatusMessages[$code];
	}

	private static $httpCustomStatusMessages = array(
		404 => 'Ressource not found'
	);

// http://gif.phpnet.org/frederic/programs/http_status_codes/
	private static $httpStatusMessages = array(
		100 => 'Continue',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'unused',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Authorization Required',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Time-out',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Large',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		418 => 'unused',
		419 => 'unused',
		420 => 'unused',
		421 => 'unused',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		425 => 'No code',
		426 => 'Upgrade Required',
		429 => 'Too Many Requests',
		500 => 'Internal Server Error',
		501 => 'Method Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Temporarily Unavailable',
		504 => 'Gateway Time-out',
		505 => 'HTTP Version Not Supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		508 => 'unused',
		509 => 'unused',
		510 => 'Not Extended'
	);
}