<?php

namespace Core;

use Core\Mail\PHPMailer;
use Core\Mail\SMTP;

class Mail extends PHPMailer {
	private $config;

	function __construct() {
		parent::__construct();

		$this->isSMTP();
		$this->SMTPAuth	= true;
		$this->isHTML(true);
		$this->Host = SMTP_SERVER;
		$this->Username = SMTP_USER;
		$this->Password = SMTP_PASSWORD;
		$this->Port =  SMTP_PORT;
		$this->CharSet =  SMTP_CHARSET;
	}

	public function init($config) {
		if(array_key_exists('charset', $config))
			$this->CharSet 	= $config['charset'];

		if(array_key_exists('server', $config))
			$this->Host = $config['server'];

		if(array_key_exists('port', $config))
			$this->Port = $config['port'];
		
		if(array_key_exists('username', $config))
			$this->Username = $config['username'];

		if(array_key_exists('password', $config))
			$this->Password = $config['password'];

		if(array_key_exists('is_html', $config))
			$this->isHTML($config['is_html']);
	}

	public function from($email, $name = null) {
		$this->From = $email;
		$this->AddReplyTo($email, $name);

		if(!is_null($name))
			$this->FromName = $name;
	}

	public function to($email, $name = null) {
		$this->AddAddress($email, $name);
	}

	public function subject($subject) {
		$this->Subject = $subject;
	}

	public function message($message) {
		$this->Body = $message;
	}

	function __destruct() {
		parent::__destruct();
	}
}