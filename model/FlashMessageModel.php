<?php

namespace model;

class FlashMessageModel {
	private static $usernameMessage = 'Username is missing';
	private static $passwordMessage = 'Password is missing';
	private static $usernameFlash = 'FlashMessageModel::usernameFlash';
	private static $passwordFlash = 'FlashMessageModel::passwordFlash';
	private static $usernameValueFlash = 'FlashMessageModel::usernameValue';
	private static $credentialsFlash = 'FlashMessageModel::credentialsFlash';
	private static $credentialsMessage = 'Wrong username or password';

	public function setUsernameMessage() {
		$_SESSION[self::$usernameFlash] = self::$usernameMessage;
	}

	public function setPasswordMessage() {
		$_SESSION[self::$passwordFlash] = self::$passwordMessage;
	}

	public function setWrongCredentialsMessage() {
		$_SESSION[self::$credentialsFlash] = self::$credentialsMessage;
	}
	public function getUsernameFlash() : string {
		$message = $_SESSION[self::$usernameFlash];
		unset($_SESSION[self::$usernameFlash]);	
		return $message;
	}

	public function getPasswordFlash() : string {
		$message = $_SESSION[self::$passwordFlash];
		unset($_SESSION[self::$passwordFlash]);
		return $message;
	}

	public function getCredentialsFlash() : string {
		$message = $_SESSION[self::$credentialsFlash];
		unset($_SESSION[self::$credentialsFlash]);
		return $message;
	}

	public function isUsernameFlash() : bool {
		return isset($_SESSION[self::$usernameFlash]);
	}

	public function isPasswordFlash() : bool {
		return isset($_SESSION[self::$passwordFlash]);
	}

	public function isCredentialsFlash() : bool {
		return isset($_SESSION[self::$credentialsFlash]);
	}

	public function setUsernameValueFlash(string $username) {
		$_SESSION[self::$usernameValueFlash] = $username;
	}

	public function getUsernameValueFlash() : string {
		$value = $_SESSION[self::$usernameValueFlash];
		unset($_SESSION[self::$usernameValueFlash]);
		return $value;
	}
}