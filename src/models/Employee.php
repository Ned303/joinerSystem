<?php

	session_start();

	class Employee
	{
		public function newJoiner($name, $surname, $jobTitle, $department, $manager, $date, $comments)
		{

			$allAccess = array();

			$sql = "SELECT jobName, accesslinks.accessID, accessName, departmentName, departmentEmail FROM jobroles
        INNER JOIN JobRoles_AccessLinkss
            ON JobRoles_AccessLinkss.jobID = jobroles.jobID
        INNER JOIN accesslinks
            ON accesslinks.accessID = JobRoles_AccessLinkss.accessID
        INNER JOIN departments
            ON departments.departmentID = accesslinks.departmentID
        WHERE jobroles.jobID = $jobTitle";

			$objDB = new Database();
			$result = $objDB->execute($sql);
			$dbResult = $result->current();

			while (!array_key_exists($dbResult['accessID'], $allAccess)) {
				$dbResult = $result->current();
				$allAccess[$dbResult['accessID']] = array(
					'jobName' => $dbResult['jobName'],
					'accessName' => $dbResult['accessName'],
					'departmentName' => $dbResult['departmentName'],
					'departmentEmail' => $dbResult['departmentEmail'],
				);

				$result->next();
			}

			$this->sendUserEmail('joiner', $name, $surname, reset($allAccess)['jobName'], $department, $manager, $date, $comments);

			$arrDepartment = array();

			foreach ($allAccess as $access) {
				$arrDepartment[$access['departmentName']] = array(
					'departmentEmail' => $access['departmentEmail'],
					'accessToGive' => array()
				);
			}

			foreach ($allAccess as $access) {
				foreach ($arrDepartment as $key => $department) {
					if ($access['departmentName'] == $key) {
						$arrDepartment[$key]['accessToGive'][] = $access['accessName'];
					}
				}
			}

			foreach ($arrDepartment as $department) {
				$EmailSubject = "New Joiner Submitted";
				$EmailBody = "<html>
				<h1>Joiner System</h1>
				<p>You have received this email because there has been a joiner request</p>
				<p>
				    <b>Name</b>: $name $surname<br>
				    <b>Job Title:</b> " . reset($allAccess)['jobName'] . "<br>
				    <b>Department:</b> $department<br>
				    <b>Manager:</b> $manager<br>
				    <b>Date:</b> $date<br>
				    <b>Additional Comments:</b><br>
				    $comments
				</p>
				<p>
				    <b>The following actions need to be taken by your department:<b><br>" . implode('<br>', $department['accessToGive']) . "</p>
				<p>Kind Regards<br>The Joiner system Team</p>
			</html>";
				$EMailRecipient = $department['departmentEmail'];

				$objEmail = new Email();
				$objEmail->sendEmail($EmailSubject, $EmailBody, $EMailRecipient);
			}

			header("Location:views/Joiners.php");
		}

		public function newLeaver($name, $surname, $jobTitle, $department, $manager, $date, $comments)
		{
			$allAccess = array();

			$sql = "SELECT jobName, accesslinks.accessID, accessName, departmentName, departmentEmail FROM jobroles
        INNER JOIN JobRoles_AccessLinkss
            ON JobRoles_AccessLinkss.jobID = jobroles.jobID
        INNER JOIN accesslinks
            ON accesslinks.accessID = JobRoles_AccessLinkss.accessID
        INNER JOIN departments
            ON departments.departmentID = accesslinks.departmentID
        WHERE jobroles.jobID = $jobTitle";

			$objDB = new Database();
			$result = $objDB->execute($sql);
			$dbResult = $result->current();

			while (!array_key_exists($dbResult['accessID'], $allAccess)) {
				$dbResult = $result->current();
				$allAccess[$dbResult['accessID']] = array(
					'jobName' => $dbResult['jobName'],
					'accessName' => $dbResult['accessName'],
					'departmentName' => $dbResult['departmentName'],
					'departmentEmail' => $dbResult['departmentEmail'],
				);

				$result->next();
			}

			$this->sendUserEmail('leaver', $name, $surname, reset($allAccess)['jobName'], $department, $manager, $date, $comments);

			$arrDepartment = array();

			foreach ($allAccess as $access) {
				$arrDepartment[$access['departmentName']] = array(
					'departmentEmail' => $access['departmentEmail'],
					'accessToGive' => array()
				);
			}

			foreach ($allAccess as $access) {
				foreach ($arrDepartment as $key => $department) {
					if ($access['departmentName'] == $key) {
						$arrDepartment[$key]['accessToGive'][] = $access['accessName'];
					}
				}
			}

			foreach ($arrDepartment as $department) {
				$EmailSubject = "New Leaver Submitted";
				$EmailBody = "<html>
				<h1>Joiner System</h1>
				<p>You have received this email because there has been a leaver request</p>
				<p>
				    <b>Name</b>: $name $surname<br>
				    <b>Job Title:</b> " . reset($allAccess)['jobName'] . "<br>
				    <b>Department:</b> $department<br>
				    <b>Manager:</b> $manager<br>
				    <b>Date:</b> $date<br>
				    <b>Additional Comments:</b><br>
				    $comments
				</p>
				<p>
				    <b>The following actions need to be taken by your department:<b><br>" . implode('<br>', $department['accessToGive']) . "</p>
				<p>Kind Regards<br>The Joiner system Team</p>
			</html>";
				$EMailRecipient = $department['departmentEmail'];

				$objEmail = new Email();
				$objEmail->sendEmail($EmailSubject, $EmailBody, $EMailRecipient);
			}

			header("Location:views/Leavers.php");
		}

		public function newMover($name, $surname, $curDepartment, $curJobTitle, $curManager, $newDepartment, $newJobTitle, $newManager, $moveDate, $comments)
		{
			$allAccess = array();

			$sql = "SELECT jobroles.jobID, jobName, accesslinks.accessID, accessName, departmentName, departmentEmail FROM jobroles
			INNER JOIN JobRoles_AccessLinkss
			  ON JobRoles_AccessLinkss.jobID = jobroles.jobID
			INNER JOIN accesslinks
			  ON accesslinks.accessID = JobRoles_AccessLinkss.accessID
			INNER JOIN departments
			  ON departments.departmentID = accesslinks.departmentID
			WHERE jobroles.jobID = $newJobTitle
			AND accesslinks.accessID NOT IN (
				SELECT accessID FROM JobRoles_AccessLinkss
				WHERE jobID = $curJobTitle
			)";

			$objDB = new Database();
			$result = $objDB->execute($sql);


			for ($i = 0; $i<$result->count();$i++) {
				$dbResult = $result->current();
				$allAccess[$dbResult['accessID']] = array(
					'jobName' => $dbResult['jobName'],
					'accessName' => $dbResult['accessName'],
					'departmentName' => $dbResult['departmentName'],
					'departmentEmail' => $dbResult['departmentEmail'],
				);
				if($dbResult['jobID'] == $curJobTitle) {
					$currentJobTitle = $dbResult['jobName'];
				}
				if($dbResult['jobID'] == $newJobTitle){
					$movingToJobTitle = $dbResult['jobName'];
				}
				$result->next();
			}

			$userEmailSubject = "New Mover Submitted";
			$userEmailBody = "<html>
				<h1>Joiner System</h1>
				<p>You have received this email because you have requested a mover with the following details:</p>			
				<p>
				    <b>Name:</b> $name $surname<br>
				    <b>Current Job Title:</b> $currentJobTitle . <br>
				    <b>Current Department:</b> $curDepartment<br>
				    <b>Current Manager:</b> $curManager<br>
				    <b>New Job Title:</b> $movingToJobTitle<br>
				    <b>New Department:</b> $newDepartment<br>
				    <b>New Manager:</b> $newManager<br>
				    <b>Move Date:</b> $moveDate<br>
				    <b>Additional Comments:</b><br>
				    $comments
				</p>
				<p>Kind Regards<br>The Joiner system Team</p>
			</html>";
			$userEMailRecipient = $_SESSION['email'];

			$objEmail = new Email();
			$objEmail->sendEmail($userEmailSubject, $userEmailBody, $userEMailRecipient);

			$arrDepartment = array();

			foreach ($allAccess as $access) {
				$arrDepartment[$access['departmentName']] = array(
					'departmentEmail' => $access['departmentEmail'],
					'accessToGive' => array()
				);
			}

			foreach ($allAccess as $access) {
				foreach ($arrDepartment as $key => $department) {
					if ($access['departmentName'] == $key) {
						$arrDepartment[$key]['accessToGive'][] = $access['accessName'];
					}
				}
			}

			foreach ($arrDepartment as $department) {
				$EmailSubject = "New Mover Submitted";
				$EmailBody = "<html>
				<h1>Joiner System</h1>
				<p>You have received this email because there has been a mover request</p>
				<p>
				    <b>Name:</b> $name $surname<br>
				    <b>Current Job Title:</b> $currentJobTitle . <br>
				    <b>Current Department:</b> $curDepartment<br>
				    <b>Current Manager:</b> $curManager<br>
				    <b>New Job Title:</b> $movingToJobTitle<br>
				    <b>New Department:</b> $newDepartment<br>
				    <b>New Manager:</b> $newManager<br>
				    <b>Move Date:</b> $moveDate<br>
				    <b>Additional Comments:</b><br>
				    $comments
				</p>
				<p>
				    <b>The following actions need to be taken by your department:<b><br>" . implode('<br>', $department['accessToGive']) . "</p>
				<p>Kind Regards<br>The Joiner system Team</p>
			</html>";
				$EMailRecipient = $department['departmentEmail'];

				$objEmail = new Email();
				$objEmail->sendEmail($EmailSubject, $EmailBody, $EMailRecipient);
			}

			header("Location:views/Movers.php");

		}

		public function sendUserEmail($from, $name, $surname, $jobtitle, $department, $manager, $date, $comments)
		{
			$userEmailSubject = "New " . ucfirst($from) . " Submitted";

			switch ($from) {
				case 'joiner':
					$dateType = 'Start';
					break;
				case 'mover':
					$dateType = 'Move';
					break;
				case 'leaver':
					$dateType = 'Leave';
					break;
				default:
					throw Exception("The method that this was called from is not set up");
			}

			$userEmailBody = "<html>
				<h1>Joiner System</h1>
				<p>You have received this email because you have requested a $from with the following details:</p>			
				<p>
				    <b>Name:</b> $name $surname<br>
				    <b>Job Title:</b> " . $jobtitle . "<br>
				    <b>Department:</b> $department<br>
				    <b>Manager:</b> $manager<br>
				    <b>$dateType Date:</b> $date<br>
				    <b>Additional Comments:</b><br>
				    $comments
				</p>
				<p>Kind Regards<br>The Joiner system Team</p>
			</html>";
			$userEMailRecipient = $_SESSION['email'];

			$objEmail = new Email();
			$objEmail->sendEmail($userEmailSubject, $userEmailBody, $userEMailRecipient);
		}
	}

?>