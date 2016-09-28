<?php

namespace controller;
class RegisterController {
    private $registerView;
    private $dateTimeView;
    private $flashMessageModel;
    private $layoutView;
    private $newUser;
    public function __construct(\view\RegisterView $rv, \view\LayoutView $lv, \view\DateTimeView $dtv, \model\FlashMessageModel $fm) {
        $this->registerView = $rv;
        $this->dateTimeView = $dtv;
        $this->flashMessageModel = $fm;
        $this->layoutView = $lv;
    }

    public function presentRegister($isLoggedIn) {
        $this->layoutView->renderRegister($isLoggedIn, $this->registerView, $this->dateTimeView);
    }

    public function register() {
        /**
         * Hämta informationen från POST REQUEST.
         * Kolla så längd på lösenord och användarnamn är korrekt
         * Kolla så lösenorden stämmer överrens
         * Använd den class som tillhandahåller alla användare
         * och sök ifall användarnamnet är upptaget.
         */

        // Collecting info from POST REQUEST
        $this->newUser = $this->registerView->getNewUsercredentials();
        $this->userDAL = new \model\UserDAL();
        $this->users = new \model\Users($this->userDAL, $this->newUser);

        try {
            $this->users->tryToRegisterUser();
        } catch (\error\ShortPasswordException $e) {
            $this->flashMessageModel->setShortPasswordMessage();
            $this->flashMessageModel->setUsernameValueFlash($this->newUser->username);
            $this->redirect();
            return;

        } catch (\error\NotMatchingPasswordException $e) {
            $this->flashMessageModel->setNotMathingPasswordMessage();
            $this->flashMessageModel->setUsernameValueFlash($this->newUser->username);
            $this->redirect();
            return;
        } catch (\error\ShortUsernameException $e) {
            $this->flashMessageModel->setShortUsernameMessage();
            $this->flashMessageModel->setUsernameValueFlash($this->newUser->username);
            $this->redirect();
            return;

        } catch (\error\BusyUsernameException $e) {
            $this->flashMessageModel->setBusyUsernameMessage();
            $this->flashMessageModel->setUsernameValueFlash($this->newUser->username);
            $this->redirect();
            return;

        } catch (\error\ InvalidCharactersException $e) {
            $this->flashMessageModel->setInvalidCharactersMessage();
            $this->flashMessageModel->setUsernameValueFlash(strip_tags($this->newUser->username));
            $this->redirect();
            return;
        }

        $this->users->addNewUser();
        $this->flashMessageModel->setUsernameValueFlash($this->newUser->username);
        $this->flashMessageModel->setNewRegisterMessage();
        header('Location: /');
        // $this->flashMessageModel->setNewRegisterMessage();
        // $this->flashMessageModel->setUsernameValueFlash($this->newUser->username);
        //
        //
        // header('Location: /');
    }

    private function redirect() {
        header('Location: ?register');
    }
}
