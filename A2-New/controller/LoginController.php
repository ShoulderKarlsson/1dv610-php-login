<?php

namespace controller;

require_once('model/User.php');

class LoginController {
	private $loginView;
	private $dateTimeView;
	private $newUser;
	private $layoutView;
	private $flashMessage;

	public function __construct(\view\LoginView $loginView, \view\DateTimeView $dateTimeView, \view\LayoutView $layoutView, \model\FlashMessageModel $flashMessage) {
		$this->loginView = $loginView;
		$this->dateTimeView = $dateTimeView;
		$this->layoutView = $layoutView;
		$this->flashMessage = $flashMessage;
	}

	public function login() {
		try {
			$this->newUser = $this->loginView->getUserinformation();
			
			return;
		} catch (\error\UsernameMissingException $e) {
			$this->loginView->setUsernameFlash($this->flashMessage);
		} catch(\error\PasswordMissingException $e) {
			$this->loginView->setPasswordFlash($this->flashMessage);

		} finally {
			header('Location: index.php'); // Maby need to move this to each catch.
		}


		$this->layoutView->render(false, $this->loginView, $this->dateTimeView);
	}
}