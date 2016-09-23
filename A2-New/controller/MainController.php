<?php

namespace controller;

require_once("view/LoginView.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");
require_once("controller/LoginController.php");
require_once('model/FlashMessageModel.php');


class MainController {
	private $loginView;
	private $dateTime;
	private $layoutView;
	private $loginController;
	private $flashMessage;

	public function __construct() {
		$this->flashMessage = new \model\FlashMessageModel();
		$this->loginView = new \view\LoginView($this->flashMessage);
		$this->dateTime = new \view\DateTimeView();
		$this->layoutView = new \view\LayoutView();

		$this->loginController = new \controller\LoginController($this->loginView, $this->dateTime, $this->layoutView, $this->flashMessage);
	}

	public function init() {

		if ($this->loginView->wantsToLogin()) {
			$this->loginController->login();
			
		} else if ($this->loginView->wantsToLogout()) {

		} else {
			$this->layoutView->render(false, $this->loginView, $this->dateTime);
		}
	}
}