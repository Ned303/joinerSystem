<?php
    require 'vendor/autoload.php';

    session_abort();

	echo file_get_contents('views/login.html');

	if(isset($_POST["login"]))
	{
		$objUser = new User();
		$objUser->login($_POST["username"], hash('sha512',$_POST["password"]));
	}

	if(isset($_POST["forgot"]))
	{
		$objUser = new User();
		$objUser->forgotPass($_POST["email"]);
	}

	if(isset($_POST["newPass"]))
	{
		$objUser = new User();
		$objUser->changePass($_POST["ref"], hash('sha512',$_POST["confirmPassword"]));
	}
?>