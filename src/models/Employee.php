<?php

session_start();

class Employee{
	public function newJoiner($name, $surname, $jobTitle, $department, $manager, $date, $comments){

	    $allAccess= array();

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

        while(!array_key_exists($dbResult['accessID'],$allAccess)){
            $dbResult = $result->current();
            $allAccess[$dbResult['accessID']] = array(
                'jobName' => $dbResult['jobName'],
                'accessName' => $dbResult['accessName'],
                'departmentName' => $dbResult['departmentName'],
                'departmentEmail' => $dbResult['departmentEmail'],
            );

            $result->next();
            $dbResult = $result->current();
        }

        $this->sendUserEmail('joiner', $name, $surname, reset($allAccess)['jobName'], $department, $manager, $date, $comments);

        $arrDepartment= array();

        foreach($allAccess as $access){
            $arrDepartment[$access['departmentName']] = array(
                'departmentEmail' => $access['departmentEmail'],
                'accessToGive' => array()
            );
        }

        foreach($allAccess as $access){
            foreach ($arrDepartment as $key => $department){
                if($access['departmentName'] == $key){
                    $arrDepartment[$key]['accessToGive'][] = $access['accessName'];
                }
            }
        }

        foreach($arrDepartment as $department){
            $EmailSubject = "New Joiner Submitted";
            $EmailBody = "<html>
				<h1>Joiner System</h1>
				<p>You have received this email because there has been a joiner request</p>
				<p>
				    <b>Name</b>: $name $surname<br>
				    Job Title: " . reset($allAccess)['jobName'] . "<br>
				    Department: $department<br>
				    Manager: $manager<br>
				    Date: $date<br>
				    Additional Comments:<br>
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

    public function newLeaver(){
        echo "A new leaver was submitted!!";
    }

    public function newMover(){
        echo "A new mover was submitted!!";
    }

    public function sendUserEmail($from, $name, $surname, $jobtitle, $department, $manager, $date, $comments){
        $userEmailSubject = "New Joiner Submitted";

        switch($from){
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
				    Name: $name $surname<br>
				    Job Title: " . $jobtitle . "<br>
				    Department: $department<br>
				    Manager: $manager<br>
				    $dateType Date: $date<br>
				    Additional Comments:<br>
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