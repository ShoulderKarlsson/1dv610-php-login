<?php

namespace model;

class UserDAL {

	private static $FILE_NAME = 'db/accounts.json';

	/**
	 * ########################################
	 * This class will comunicate with the 'DB'
	 * ########################################
	 *
	 *
	 * 
	 * Collect all users
	 * Search for specific username
	 * Add user
	 */
	

	/*
	public function addUser() {	}
	 */

	public function collectUsers() : array {
		$f_open = fopen(self::$FILE_NAME, 'r');
		$f_read = fread($f_open, filesize(self::$FILE_NAME));
		return json_decode($f_read, true);
	}
}