<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class JobRoles{
	public function getJobRoles( $companyID ) {
        /*$sql = "SELECT userUsername, userPassword, userName, userSurname, isAdmin, companyID FROM users";

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
            header("Location:views/main.php");
        }*/

        return array('SomeJob','MyRandomJob','CommonJob','Jobless');
	}
}
?>