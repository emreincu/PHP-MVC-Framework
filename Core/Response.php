<?php 

namespace Core;

/**
 * Set & Get Header and their status codes.
 */
class Response {

	/**
	 * @var array $statusCodes Status codes array.
	 */
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

	/**
	 * Set header
	 * 
	 * @param string $name Header name.
	 * @param mixed $value Header value.
	 * @return bool
	 */
	public static function setHeader($key, $value) {
		if(!headers_sent()){
            header($key . ': ' . $value);
            return true;
        }
        return false;
    }
	
	/**
	 * Get header
	 * 
	 * @param string $key Header key.
	 * @return array
	 */
	public static function getHeader($key) {
		$defaultHeaders 	= getallheaders();
		$customHeaders 	= headers_list();

		if(self::_arraySearchLike($key, $customHeaders) !== false) {
			$index 	= self::_arraySearchLike($key, $customHeaders);
			$header = explode(':', $customHeaders[$index]);
			return trim($header[1]);
		} elseif(array_key_exists($key, $defaultHeaders)) {
			return $defaultHeaders[$key];
		} else {
            $language = Language::getAPI(Cookie::get("language"));
			return $language->not_found_header_information;
		}
	}

	/**
	 * Set status
	 * 
	 * @param int $code Status code.
	 * @return http_response_code
	 */
	public static function setStatus($code) {
		return http_response_code($code);
	}

	/**
	 * Get status
	 * 
	 * @param int $code Status code.
	 * @return array
	 */
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

	/**
	 * Get header
	 * 
	 * @param string $key Header key.
	 * @return array
	 */
	private static function _arraySearchLike($element, $array) {
		foreach($array as $key => $value) {
			if(strpos($value, $element) !== false)
				return $key;
		}
		return false;
	}

	public function json($message, $status_code) {

	}

}