<?php
	require 'models/User.php';

	echo file_get_contents('views/login.html');

	if(isset($_POST["login"]))
	{
		$objUser = new User();
		$objUser->login($_POST["username"], hash('sha512',$_POST["password"]));
	}

	if(isset($_POST["forgot"]))
	{
		echo "DONT FORGET YOUR PASSWORD AGAIN!!!!";
	}
?>