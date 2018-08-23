<?php

class User {
	public function login($username, $password){
		$sql = "SELECT userUsername, userPassword, userEmail, userName, userSurname, isAdmin, companyID FROM users";

		$objDB = new Database();
		$result = $objDB->execute($sql);
		$dbResult = $result->current();

		if($dbResult == null || $dbResult['userPassword'] != $password) {
			echo '<center><p style="color:red">Login details are incorrect</p></center>';
		} else {
			session_start();
			$_SESSION['name'] = $dbResult['userName'];
			$_SESSION['admin'] = $dbResult['isAdmin'];
			$_SESSION['company'] = $dbResult['companyID'];
			$_SESSION['email'] = $dbResult['userEmail'];
			header("Location:views/main.php");
		}
	}

	public function forgotPass($email){
		$objApp = new Application();
		$sLocalUrl = $objApp->getLocalUrl();

		$bIsUser = $this->checkUserExist($email);

		if($bIsUser){
			$sSubject = "Joiner System Password Reset";
			$sLink = "$sLocalUrl" . "/views/passConfirm.php?ref=" . hash('sha512',$email);

			$sBody = "<html>
				<center>
					<h1>Joiner System</h1>
				<p>You have received this email because you have requested a password reset</p>
			
				<p>Click on the following <a href=\"$sLink\">link</a> to reset your password, or copy and paste the following link in your browser:</p>
				<p><a href = \"$sLink\">$sLink</a></p>
				<p>Kind Regards<br>The Joiner system Team</p>
				</center>
			</html>";

			$objEmail = new Email();
			$objEmail->sendEmail($sSubject, $sBody, $email);

			header("Location:views/forgotConfirmation.html");
		}else{
			echo '<center><p style="color:red">You are not a registered user!</p></center>';
		}
	}

	public function checkUserExist($sEmail){
		$sql = "SELECT usersID FROM users WHERE userEmail = '" . $sEmail . "'";

		$objDB = new Database();
		$result = $objDB->execute($sql);
		$dbResult = $result->current();

		if($dbResult == null) {
			return false;
		} else {
			return true;
		}
	}

	public function changePass($reference, $newPassword) {
		$sql = "SELECT usersID, userEmail FROM users";
		$objDB = new Database();
		$result = $objDB->execute($sql);

		$userId = null;

		while($userId == null) {
			$entry = $result->current();
			if(hash('sha512',$entry['userEmail']) == $reference){
				$userId = $entry['usersID'];
			}else{
				$result->next();
			}
		}

		$sql = "UPDATE users SET userPassword = '" . $newPassword . "' WHERE usersID = " . $userId;
		$objDB = new Database();
		$objDB->execute($sql);
	}
}