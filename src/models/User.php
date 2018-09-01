<?php

	class User
	{
		public function login($username, $password)
		{
			$sql = "SELECT userUsername, userPassword, userEmail, userName, userSurname, isAdmin, companyID FROM users WHERE userUsername = '$username'";

			$objDB = new Database();
			$result = $objDB->execute($sql);
			$dbResult = $result->current();

			if ($dbResult == null || $dbResult['userPassword'] != $password) {
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

		public function forgotPass($email)
		{
			$objApp = new Application();
			$sLocalUrl = $objApp->getLocalUrl();

			$passwordKey = $this->getPasswordKey($email);

			if ($passwordKey) {
				$sSubject = "Joiner System Password Reset";
				$sLink = "$sLocalUrl" . "/views/passConfirm.php?ref=" . $passwordKey;

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
			} else {
				echo '<center><p style="color:red">You are not a registered user!</p></center>';
			}
		}

		public function getPasswordKey($sEmail)
		{
			$sql = "SELECT passwordKey FROM users WHERE userEmail = '" . $sEmail . "'";

			$objDB = new Database();
			$result = $objDB->execute($sql);
			$dbResult = $result->current();

			if ($dbResult == null) {
				return false;
			} else {
				return $dbResult["passwordKey"];
			}
		}

		public function changePass($reference, $newPassword)
		{
			$sql = "SELECT usersID, userEmail FROM users WHERE passwordKey = \"$reference\"";
			$objDB = new Database();
			$result = $objDB->execute($sql);

			$entry = $result->current();

			if ($entry == null) {
				header("Location:views/error.html");
			} else {
				$newKey = hash('sha512', $newPassword);
				$sql = "UPDATE users SET userPassword = '" . $newPassword . "', passwordKey = '" . $newKey . "' WHERE usersID = " . $entry["usersID"];
				$objDB = new Database();
				$objDB->execute($sql);
			}
		}
	}