<?php

namespace model;

class FlashMessageModel {

	private static $usernameFlash = 'FlashMessageModel::usernameFlash';
	private static $passwordFlash = 'FlashMessageModel::passwordFlash';
	private static $usernameValueFlash = 'FlashMessageModel::usernameValue';
	private static $credentialsFlash = 'FlashMessageModel::credentialsFlash';
	private static $welcomeFlash = 'FlashMessageModel::welcome';
	private static $byeFlash = 'FlashMessageModel::bye';
	private static $shortPasswordFlash = 'FlashMessageModel::shortPassword';
	private static $usernameMessage = 'Username is missing';
	private static $passwordMessage = 'Password is missing';
	private static $credentialsMessage = 'Wrong name or password';
	private static $welcomeMessage = 'Welcome';
	private static $byeMessage = 'Bye bye!';
	private static $shortPasswordMessage = 'Password has too few characters, at least 6 characters.';
	private static $notMatchingPasswordFlash = 'FlashMessageModel::notmatching';
	private static $notMatchingPasswordMessage = 'Passwords do not match.';
	private static $shortUsernameFlash = 'FlashMessageModel::shortUsername';
	private static $shortUsernameMessage = 'Username has too few characters, at least 3 characters.';

	public function setUsernameMessage() {
		$_SESSION[self::$usernameFlash] = self::$usernameMessage;
	}

	public function setPasswordMessage() {
		$_SESSION[self::$passwordFlash] = self::$passwordMessage;
	}

	public function setWrongCredentialsMessage() {
		$_SESSION[self::$credentialsFlash] = self::$credentialsMessage;
	}

	public function setShortPasswordMessage() {
		$_SESSION[self::$shortPasswordFlash] = self::$shortPasswordMessage;
	}

	public function getShortPasswordFlash() : string {
		$message = $_SESSION[self::$shortPasswordFlash];
		unset($_SESSION[self::$shortPasswordFlash]);
		return $message;
	}

	public function setNotMathingPasswordMessage() {
		$_SESSION[self::$notMatchingPasswordFlash] = self::$notMatchingPasswordMessage;
	}

	public function getNotMatchingPasswordFlash() : string {
		$message = $_SESSION[self::$notMatchingPasswordFlash];
		unset($_SESSION[self::$notMatchingPasswordFlash]);
		return $message;
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

	public function getShortUsernameFlash() : string {
		$message = $_SESSION[self::$shortUsernameFlash];
		unset($_SESSION[self::$shortUsernameFlash]);
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

	public function isWelcomeFlash() : bool {
		return isset($_SESSION[self::$welcomeFlash]);
	}

	public function isByeFlash() : bool {
		return isset($_SESSION[self::$byeFlash]);
	}

	public function isShortPasswordFlash() : bool {
		return isset($_SESSION[self::$shortPasswordFlash]);
	}

	public function isNotMatchingPasswordFlash() : bool {
		return isset($_SESSION[self::$notMatchingPasswordFlash]);
	}

	public function isShortUsernameFlash() : bool {
		return isset($_SESSION[self::$shortUsernameFlash]);
	}

	public function setShortUsernameMessage() {
		$_SESSION[self::$shortUsernameFlash] = self::$shortUsernameMessage;
	}


	public function setUsernameValueFlash(string $username) {
		$_SESSION[self::$usernameValueFlash] = $username;
	}

	public function getUsernameValueFlash() : string {
		$value = $_SESSION[self::$usernameValueFlash];
		unset($_SESSION[self::$usernameValueFlash]);
		return $value;
	}

	public function setWelcomeFlash() {
		$_SESSION[self::$welcomeFlash] = self::$welcomeMessage;
	}

	public function getWelcomeFlash() : string {
		$message = $_SESSION[self::$welcomeFlash];
		unset($_SESSION[self::$welcomeFlash]);
		return $message;
	}

	public function setByeFlash() {
		$_SESSION[self::$byeFlash] = self::$byeMessage;
	}

	public function getByeFlash() : string {
		$message = $_SESSION[self::$byeFlash];
		unset($_SESSION[self::$byeFlash]);
		return $message;
	}
}
