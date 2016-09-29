<?php

namespace model;


/**
 * Represents a 'catalog' of cookiepasswords.
 */
class Cookies {
	private $cookieDAL;
	private $storedCookies;

	public function __construct(CookieDAL $cd) {
		$this->cookieDAL = $cd;
		$this->getStoredCookies();
	}

	public function removeCookie() {
		// Remove the cookie from cookie-db
	}

	public function getCookie() : array {
		$this->cookieDAL->collectCookies(); 
	}

	public function saveCookie(\model\Cookie $c) {
		$c->cookiePassword = $this->generateRandomCookieString();
		$this->cookieDAL->saveCookie($c, $this->storedCookies);
	}

	public function isStored(string $cookiePW) : bool {
		foreach($this->storedCookies as $cookie) {
			if ($cookie['cookiePassword'] === $cookiePW && $cookie['time'] > time()) {
				return true;
			}
		}

		return false;
	}

	private function getStoredCookies() {
		$this->storedCookies = $this->cookieDAL->collectCookies();
	}

	private function generateRandomCookieString() : string {
		$tempString = password_hash('super_string_deluxe_o_y_e_a', PASSWORD_BCRYPT);
		$secret = '';

		for ($i=0; $i < 50; $i++) { 
			$secret .= rand(0, strlen($tempString) - 1);
		}

		return $secret;
	}


}