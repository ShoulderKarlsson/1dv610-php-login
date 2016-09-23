<?php

namespace model;

require_once('exceptions/PasswordMissingException.php');
require_once('exceptions/UsernameMissingException.php');

class User {
	private $username;
	private $password;

	public function __construct(string $username, string $password) {

		// Keeping exception message to make it easier to read.
		if (empty($username)) {
			throw new \error\UsernameMissingException();
		}

		// Keeping exception message to make it easier to read.
		if (empty($password)) {
			throw new \error\PasswordMissingException();
		}

		$this->username = $username;
		$this->password = $password;
	}

	public function getPassword() : string {
		return $this->password;
	}

	public function getUsername() : string {
		return $this->username;
	}
}