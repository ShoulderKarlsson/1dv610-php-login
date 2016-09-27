<?php

namespace controller;

require_once("view/LoginView.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");
require_once("controller/LoginController.php");
require_once('model/FlashMessageModel.php');
require_once('model/SessionModel.php');


class MainController {
	private $loginView;
	private $dateTime;
	private $layoutView;
	private $loginController;
	private $flashMessage;
	private $sessionModel;

	public function __construct() {
		$this->flashMessage = new \model\FlashMessageModel();
		$this->loginView = new \view\LoginView($this->flashMessage);
		$this->dateTime = new \view\DateTimeView();
		$this->layoutView = new \view\LayoutView();
		$this->sessionModel = new \model\sessionModel();

		$this->loginController = new \controller\LoginController($this->loginView, $this->dateTime, $this->layoutView, $this->flashMessage);
	}

	public function init() {

		if ($this->loginView->wantsToLogin()) {
			$this->loginController->login();
			
		} else if ($this->loginView->wantsToLogout()) {
			
		} else {
			$this->layoutView->render($this->sessionModel->isLoggedIn(), $this->loginView, $this->dateTime);
		}
	}
}