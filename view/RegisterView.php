<?php

namespace view;

class RegisterView {
    private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';
    private $message = '';
    private $username = '';
    private static $register_get = 'register';

    public function wantsToAccsessRegister() : bool {
        return isset($_GET[self::$register_get]);
    }

    // public function wantsToRegister() : bool {
    //
    // }
















    public function response() {
        return '
            <form method="post" action="?register" enctype="multipart/form-data">
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$messageId . '">' . $this->message . '</p>
                    <label for="' . self::$name .'">Username : </label>
                    <input type="text" value="' . $this->username . '" size="20" name="' . self::$name . '" id="' . self::$name . '"/>
                    <br>
                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" size="20" name="' . self::$password . '" id="' . self::$password . '" />
                    <br>
                    <label for ="' . self::$passwordRepeat . '">Repeat password :</label>
                    <input type="password" name="' . self::$passwordRepeat . '" id="' . self::$passwordRepeat . '" />
                    <br>
                    <input type="submit" size="20" name="DoRegistration" id="submit" value="Register" />
                </fieldset>
            </form>
        ';
    }
}
