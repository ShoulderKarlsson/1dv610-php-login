<?php

namespace controller;

require_once("view/LoginView.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");
require_once('view/RegisterView.php');
require_once("controller/LoginController.php");
require_once('controller/RegisterController.php');
require_once('model/FlashMessageModel.php');
require_once('model/SessionModel.php');


class MainController {
	private $loginView;
	private $dateTime;
	private $layoutView;
	private $loginController;
	private $flashMessage;
	private $sessionModel;
	private $registerView;
	private $registerController;

	public function __construct() {
		$this->flashMessage = new \model\FlashMessageModel();
		$this->dateTime = new \view\DateTimeView();
		$this->layoutView = new \view\LayoutView();
		$this->sessionModel = new \model\sessionModel();
		$this->loginView = new \view\LoginView($this->flashMessage);
		$this->registerView = new \view\RegisterView($this->flashMessage);
		$this->registerController = new \controller\RegisterController($this->registerView, $this->layoutView, $this->dateTime, $this->flashMessage);
		$this->loginController = new \controller\LoginController($this->loginView, $this->dateTime, $this->layoutView, $this->flashMessage);
	}

	public function init() {

		if ($this->loginView->wantsToLogin()) {
			return $this->loginController->login();

		} else if ($this->loginView->wantsToLogout()) {
			return $this->loginController->logout();

		} else if ($this->registerView->wantsToRegister()) {
			return $this->registerController->register();

		} else if ($this->registerView->wantsToAccsessRegister()) {
			if ($this->sessionModel->isLoggedIn()) {
				header('Location: '. $_SERVER['PHP_SELF']);
			}

			$this->registerController->presentRegister($this->sessionModel->isLoggedIn());

		} else {
			return $this->layoutView->render($this->sessionModel->isLoggedIn(), $this->loginView, $this->dateTime);
		}
	}
}
