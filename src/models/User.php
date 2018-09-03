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

		public function forgotPass($email, $adminRedirect = null)
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

				if($adminRedirect){
					header("Location:views/Admin.php");
				} else {
					header("Location:views/forgotConfirmation.html");
				}
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

		public function getAllUsersForCompany($companyId) {
            $allUsers = array();

            $sql = "SELECT usersID, userUsername, userEmail, userName, userSurname, isAdmin FROM users WHERE companyID = $companyId";

            $objDB = new Database();
            $result = $objDB->execute($sql);
            $dbResult = $result->current();

            if ($dbResult == null) {
                throw Exception("There are no users set up for your company with id $companyId");
            } else {
                $dbResult = $result->current();

                while (!array_key_exists($dbResult['usersID'], $allUsers)) {
                    $dbResult = $result->current();
                    $allUsers[$dbResult['usersID']] = array(
                        'userUsername' => $dbResult['userUsername'],
                        'userEmail' => $dbResult['userEmail'],
                        'userName' => $dbResult['userName'],
                        'userSurname' => $dbResult['userSurname'],
                        'isAdmin' => $dbResult['isAdmin'],
                    );

                    $result->next();
                    $dbResult = $result->current();
                }
            }

            return $allUsers;
        }

        public function addUser($username, $name, $surname, $email, $admin, $companyID ) {
		    if($admin == "on") {
                $admin = 1;
            } else {
		        $admin = 0;
            }

            $randomString = hash('sha512', bin2hex(openssl_random_pseudo_bytes(10)));

            $sql = "INSERT INTO users (userUsername, userEmail, userName, userSurname, userPassword, passwordKey, isAdmin, companyID)
                    VALUES('$username', '$email', '$name', '$surname', '$randomString', '$randomString', $admin, $companyID)";

            $objDB = new Database();
            $objDB->execute($sql);

            $objApp = new Application();
            $sLocalUrl = $objApp->getLocalUrl();

            $sSubject = "You have been added to Joiner System";
            $sLink = "$sLocalUrl" . "/views/passConfirm.php?ref=" . $randomString;

            $sBody = "<html>
				<center>
					<h1>Joiner System</h1>
				<p>You have received this email because you were set up on the Joiner System</p>
			
				<p>Click on the following <a href=\"$sLink\">link</a> to set your password, or copy and paste the following link in your browser:</p>
				<p><a href = \"$sLink\">$sLink</a></p>
				<p>Kind Regards<br>The Joiner system Team</p>
				</center>
			</html>";

            $objEmail = new Email();
            $objEmail->sendEmail($sSubject, $sBody, $email);

            header("Location:views/Admin.php");
        }

        public function editUser ($userID, $username, $name, $surname, $email, $admin) {
			if($admin == "on") {
				$admin = 1;
			} else {
				$admin = 0;
			}

			$sql = "UPDATE users
					SET userUsername = '$username',
					userEmail = '$email',
					userName = '$name',
					userSurname = '$surname',
					isAdmin = $admin
					WHERE usersID = $userID";

			$objDB = new Database();
			$objDB->execute($sql);

			header("Location:views/Admin.php");
		}

		public function removeUser($userId) {
			$sql = "DELETE FROM users WHERE usersID = $userId";

			$objDB = new Database();
			$objDB->execute($sql);

			header("Location:views/Admin.php");
		}
	}