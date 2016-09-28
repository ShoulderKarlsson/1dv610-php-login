<?php

namespace controller;
class RegisterController {
    private $registerView;
    private $dateTimeView;
    private $flashMessageModel;
    private $layoutView;
    public function __construct(\view\RegisterView $rv, \view\LayoutView $lv, \view\DateTimeView $dtv, \model\FlashMessageModel $fm) {
        $this->registerView = $rv;
        $this->dateTimeView = $dtv;
        $this->flashMessageModel = $fm;
        $this->layoutView = $lv;
    }

    public function presentRegister($isLoggedIn) {
        $this->layoutView->renderRegister($isLoggedIn, $this->registerView, $this->dateTimeView);
    }
}
