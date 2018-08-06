<?php

require 'vendor/autoload.php';
require 'Database.php';

class User {
	public function login($username, $password){
		echo "Username: $username<br>Password: $password";

		$sql = "SELECT userUsername, userPassword FROM users";

		$objDB = new Database();
		$result = $objDB->execute($sql);

		var_dump($result->next());
	}
}