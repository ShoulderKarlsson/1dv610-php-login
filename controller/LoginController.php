<?php

namespace controller;

require_once('model/User.php');
require_once('model/Users.php');
require_once('model/UserDAL.php');
require_once('model/SessionModel.php');

class LoginController {
	private static $REDIRECT_PATH = 'Location: index.php';
	private $loginView;
	private $dateTimeView;
	private $newUser;
	private $layoutView;
	private $flashMessage;
	private $users;
	private $userDAL;

	public function __construct(\view\LoginView $loginView, 
								\view\DateTimeView $dateTimeView, 
								\view\LayoutView $layoutView, 
								\model\FlashMessageModel $flashMessage) {
		$this->loginView = $loginView;
		$this->dateTimeView = $dateTimeView;
		$this->layoutView = $layoutView;
		$this->flashMessage = $flashMessage;
	}

	public function login() {

		try {
			$this->sessionModel = new \model\SessionModel();
			$this->newUser = $this->loginView->getUserinformation();
			$this->userDAL = new \model\UserDAL();
			$this->users = new \model\Users($this->userDAL, $this->newUser);
			$this->users->tryToLoginUser($this->sessionModel);

			$this->sessionModel->login();
			header(self::$REDIRECT_PATH);

			return;
		} catch (\error\UsernameMissingException $e) {
			$this->flashMessage->setUsernameMessage();
			header(self::$REDIRECT_PATH);
		} catch(\error\PasswordMissingException $e) {
			$this->flashMessage->setUsernameValueFlash($this->newUser->username);
			$this->flashMessage->setPasswordMessage();
			header(self::$REDIRECT_PATH);
		} catch (\error\NoSuchUserException $e) {
			$this->flashMessage->setUsernameValueFlash($this->newUser->username);
			$this->flashMessage->setWrongCredentialsMessage();
			header(self::$REDIRECT_PATH);
		} catch (\error\AlreadyLoggedInException $e) {
			$this->layoutView->render(true, $this->loginView, $this->dateTimeView);
		}


		$this->layoutView->render(false, $this->loginView, $this->dateTimeView);
	}
}
