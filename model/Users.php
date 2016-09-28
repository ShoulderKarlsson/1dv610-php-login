<?php

namespace model;


require_once('SessionModel.php');
require_once('exceptions/NoSuchUserException.php');

class Users {


	private static $username = 'username';
	private static $password = 'password';


	private $users = array();
	private $userDAL;
	private $userCredentials;
	private $sessionModel;

	public function __construct(UserDAL $db, User $u) {
		$this->userDAL = $db;
		$this->userCredentials = $u;
		$this->getUsers();
	}

	public function tryToLoginUser(SessionModel $sessionModel) {


		// If the user tries to login when already logged in.
		// Not using message, keeping for logs.
		if ($sessionModel->isLoggedIn()) {
			throw new \error\AlreadyLoggedInException('Already logged in.');
		}

		// Not using message, keeping for logs
		if (empty($this->userCredentials->username)) {
			throw new \error\UsernameMissingException('Username is missing!');
		}

		// Not using message, keeping for logs
		if (empty($this->userCredentials->password)) {
			throw new \error\PasswordMissingException('Password is missing!');
		}

		// Not using message, keeping for logs.
		if ($this->searchForUser() === false) {
			throw new \error\NoSuchUserException('Wrong name or password');
		}


	}


	// Ask about this [Using array since saving in json ($user[self::$password / self::$username])]
	private function searchForUser() : bool {
		foreach ($this->users as $user) {
			if ($user[self::$username] === $this->userCredentials->username &&
				$user[self::$password] === $this->userCredentials->password) {
				return true;
			}
		}

		return false;
	}

	private function getUsers() {
		$this->users = $this->userDAL->collectUsers();
	}
}
