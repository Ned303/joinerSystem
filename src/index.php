<?php
	require 'vendor/autoload.php';

	session_abort();

	echo file_get_contents('views/login.html');

	if (isset($_POST["login"])) {
		$objUser = new User();
		$objUser->login($_POST["username"], hash('sha512', $_POST["password"]));
	}

	if (isset($_POST["forgot"])) {
		$objUser = new User();
		$objUser->forgotPass($_POST["email"]);
	}

	if (isset($_POST["newPass"])) {
		$objUser = new User();
		$objUser->changePass($_POST["ref"], hash('sha512', $_POST["confirmPassword"]));
	}

	if (isset($_POST["joiner"])) {
		$objEmp = new Employee();
		$objEmp->newJoiner($_POST["FirstName"], $_POST["Surname"], $_POST["JobTitle"], $_POST["Department"], $_POST["LineManager"], $_POST["StartDate"], $_POST["comments"]);
	}

	if (isset($_POST["mover"])) {
		$objEmp = new Employee();
		$objEmp->newMover($_POST["firstName"], $_POST["surname"], $_POST["currentDepartment"], $_POST["currentJobTitle"], $_POST["currentManager"], $_POST["newDepartment"], $_POST["newJobTitle"], $_POST["newManager"], $_POST["MoveDate"], $_POST["comments"]);
	}

	if (isset($_POST["leaver"])) {
		$objEmp = new Employee();
		$objEmp->newLeaver($_POST["FirstName"], $_POST["Surname"], $_POST["JobTitle"], $_POST["Department"], $_POST["LineManager"], $_POST["LeaveDate"], $_POST["comments"]);
	}
?>