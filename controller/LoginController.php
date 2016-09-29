<?php

namespace controller;

require_once('model/User.php');
require_once('model/Users.php');
require_once('model/UserDAL.php');
require_once('model/SessionModel.php');

class LoginController {
	private $loginView;
	private $dateTimeView;
	private $newUser;
	private $layoutView;
	private $flashMessage;
	private $users;
	private $userDAL;
	private $sessionModel;

	public function __construct(\view\LoginView $loginView,
								\view\DateTimeView $dateTimeView,
								\view\LayoutView $layoutView,
								\model\FlashMessageModel $flashMessage) {
		$this->loginView = $loginView;
		$this->dateTimeView = $dateTimeView;
		$this->layoutView = $layoutView;
		$this->flashMessage = $flashMessage;
		$this->sessionModel = new \model\SessionModel();
	}

	public function login() {

		try {
			$this->newUser = $this->loginView->getUserinformation();
			$this->userDAL = new \model\UserDAL();
			$this->users = new \model\Users($this->userDAL, $this->newUser);
			$this->users->tryToLoginUser($this->sessionModel);
			$this->sessionModel->login();

			// if ($this->loginView->wantsToStoreSession()) {
				
			// }



			$this->flashMessage->setWelcomeFlash();
			return header('Location: '.$_SERVER['PHP_SELF']);

		} catch (\error\UsernameMissingException $e) {
			$this->flashMessage->setUsernameMessage();
			header('Location: '.$_SERVER['PHP_SELF']);

		} catch(\error\PasswordMissingException $e) {
			$this->flashMessage->setUsernameValueFlash($this->newUser->username);
			$this->flashMessage->setPasswordMessage();
			header('Location: '.$_SERVER['PHP_SELF']);

		} catch (\error\NoSuchUserException $e) {
			$this->flashMessage->setUsernameValueFlash($this->newUser->username);
			$this->flashMessage->setWrongCredentialsMessage();
			header('Location: '.$_SERVER['PHP_SELF']);
		} catch (\error\AlreadyLoggedInException $e) {
			$this->layoutView->render(true, $this->loginView, $this->dateTimeView);
		}
	}

	public function logout() {

		if ($this->sessionModel->isLoggedIn()) {
			$this->sessionModel->logout();
			$this->flashMessage->setByeFlash();
		}

		header('Location: '.$_SERVER['PHP_SELF']);
	}
}
