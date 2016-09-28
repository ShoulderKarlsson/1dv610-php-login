<?php

namespace model;

require_once('exceptions/PasswordMissingException.php');
require_once('exceptions/UsernameMissingException.php');

class User {

	public $username;
	public $password;

	public function __construct(string $username, string $password) {
		$this->username = $username;
		$this->password = $password;
	}
}
