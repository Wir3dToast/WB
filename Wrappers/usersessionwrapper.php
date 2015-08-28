
<?php

class UserSessionWrapper {

	/*
	Fields:

	1) loggedinBool: a boolean to determine if a user is already logged in
	*/

	public function __construct() {
		session_start(); 		
	}

	public function isLoggedIn() {
		return isset($_SESSION["loggedInBool"]);
	} 



}

?>