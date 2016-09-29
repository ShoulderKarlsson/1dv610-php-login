<?php

namespace controller;

require_once('model/User.php');
require_once('model/Users.php');
require_once('model/UserDAL.php');
require_once('model/SessionModel.php');
require_once('model/Cookies.php');
require_once('model/CookieDAL.php');


class LoginController {
	private $loginView;
	private $dateTimeView;
	private $newUser;
	private $layoutView;
	private $flashMessage;
	private $users;
	private $userDAL;
	private $cookieDAL;
	private $sessionModel;
	private $cookies;

	public function __construct(\view\LoginView $loginView,
								\view\DateTimeView $dateTimeView,
								\view\LayoutView $layoutView,
								\model\FlashMessageModel $flashMessage) {
		$this->loginView = $loginView;
		$this->dateTimeView = $dateTimeView;
		$this->layoutView = $layoutView;
		$this->flashMessage = $flashMessage;
		$this->sessionModel = new \model\SessionModel();
		$this->cookieDAL = new \model\CookieDAL();
		$this->cookies = new \model\Cookies($this->cookieDAL);
	}

	public function login() {

		$this->newUser = $this->loginView->getUserinformation();
		$this->userDAL = new \model\UserDAL();
		$this->users = new \model\Users($this->userDAL, $this->newUser);
		
		try {
			// $this->newUser = $this->loginView->getUserinformation();
			// $this->userDAL = new \model\UserDAL();
			// $this->users = new \model\Users($this->userDAL, $this->newUser);
			
			$this->users->tryToLoginUser($this->sessionModel);

			if ($this->loginView->wantsToStoreSession()) {
				$this->setCookie();
				$this->flashMessage->setCookieWelcomeFlash();

			} else {
				$this->flashMessage->setWelcomeFlash();
			}


			// $this->sessionModel->login();
			// $this->flashMessage->setWelcomeFlash();
			// return header('Location: '.$_SERVER['PHP_SELF']);

		} catch (\error\UsernameMissingException $e) {
			$this->flashMessage->setUsernameMessage();
			// header('Location: '.$_SERVER['PHP_SELF']);

			return header('Location: '.$_SERVER['PHP_SELF']);

		} catch(\error\PasswordMissingException $e) {
			$this->flashMessage->setUsernameValueFlash($this->newUser->username);
			$this->flashMessage->setPasswordMessage();
			// header('Location: '.$_SERVER['PHP_SELF']);
			return header('Location: '.$_SERVER['PHP_SELF']);


		} catch (\error\NoSuchUserException $e) {
			$this->flashMessage->setUsernameValueFlash($this->newUser->username);
			$this->flashMessage->setWrongCredentialsMessage();
			// header('Location: '.$_SERVER['PHP_SELF']);
			return header('Location: '.$_SERVER['PHP_SELF']);

		} catch (\error\AlreadyLoggedInException $e) {
			return $this->layoutView->render(true, $this->loginView, $this->dateTimeView);
		}

		$this->sessionModel->login();
		return header('Location: '.$_SERVER['PHP_SELF']);
	}

	public function logout() {

		if ($this->sessionModel->isLoggedIn()) {
			$this->sessionModel->logout();
			$this->flashMessage->setByeFlash();
		}

		if ($this->loginView->isCookieSet()) {
			$this->loginView->removeCookies();
		}

		header('Location: '.$_SERVER['PHP_SELF']);
	}

	public function tryLoginWithCookies() {
		$cookiePW = $this->loginView->getCookiePassword();

		if ($this->cookies->isStored($cookiePW) && $this->sessionModel->isLoggedIn() === false) {
			$this->flashMessage->setWelcomeBackFlash();
			$this->sessionModel->login();
			header('Location: '.$_SERVER['PHP_SELF']);
		} else {
			$this->layoutView->render($this->sessionModel->isLoggedIn(), $this->loginView, $this->dateTimeView);
		}
	}

	private function setCookie() {
		$cookie = $this->loginView->getCookieInfo();
		$this->cookies->saveCookie($cookie);
		$this->loginView->setClientCookie($cookie);
	}
}
