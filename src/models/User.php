<?php
require 'vendor/autoload.php';

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

	public function forgotPass($email){
		$objApp = new Application();
		$sLocalUrl = $objApp->getLocalUrl();

		$bIsUser = $this->checkUserExist($email);

		if($bIsUser){
			$sSubject = "Joiner System Password Reset";
			$sLink = "$sLocalUrl" . "/views/passConfirm.html?" . hash('sha512',$email);

			$sBody = "<html>
				<center>
					<h1>Joiner System</h1>
				<p>You have received this email because you have requested a password reset</p>
			
				<p>Click on the following <a href=\"$sLink\">link</a> to reset your password, or copy and paste the following link in your browser:</p>
				<p><a href = \"$sLink\">THE LINK</a></p>
				<p>The Joiner system Team</p>
				</center>
			</html>";

			$objEmail = new Email();
			$objEmail->sendNonDepartmentEmail($sSubject, $sBody, $email);

			header("Location:views/forgotConfirmation.html");
		}else{
			header("Location:views/forgotPass.html");
			echo "Not a user!";
		}
	}

	public function checkUserExist($sEmail){
		return false;
	}
}