<?php 

namespace Core;

class Response {

	public static $statusCodes = [
		100 => 'Continue',
		101 => 'Switching Protocols',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => '(Unused)',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported'
	];

	public static function setHeader($key, $value) {
		if(!headers_sent()){
            header($key . ': ' . $value);
            return true;
        }
        return false;
    }
    
	public static function getHeader($key) {
		$defaultHeaders 	= getallheaders();
		$customHeaders 	= headers_list();

		if(self::arraySearchLike($key, $customHeaders) !== false) {
			$index 	= self::arraySearchLike($key, $customHeaders);
			$header = explode(':', $customHeaders[$index]);
			return trim($header[1]);
		} elseif(array_key_exists($key, $defaultHeaders)) {
			return $defaultHeaders[$key];
		} else {
            $language = Language::getAPI(Cookie::get("language"));
			return $language->not_found_header_information;
		}
	}

	private static function arraySearchLike($element, $array) {
		foreach($array as $key => $value) {
			if(strpos($value, $element) !== false)
				return $key;
		}
		return false;
	}

	public static function setStatus($code) {
		return http_response_code($code);
	}

	public static function getStatus($code = null) {
		if(is_null($code))
			$statusCode = http_response_code();
		else
			$statusCode = $code;

		return [
			'code'	=> $statusCode,
			'text'	=> self::$statusCodes[$statusCode]
		];
	}

}