<?php
require 'vendor/autoload.php';
require 'Database.php';

class User {
	public function login($username, $password){
		$sql = "SELECT userUsername, userPassword FROM users";

		$objDB = new Database();
		$result = $objDB->execute($sql);
		$dbResult = $result->current();

		if($dbResult == null || $dbResult['userPassword'] != $password) {
			echo '<center><p style="color:red">Login details are incorrect</p></center>';
		} else {
			$_SESSION['username'] = $username;
			header("Location:views/main.php");
		}
	}
}