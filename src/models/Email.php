<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Email {
    public function sendEmail( $sSubject, $sBody, $sDepartment ) {
    	//Get the email details from the config
		$objApplication = new Application();
		$arrEmailDetails = $objApplication->getEmailConf();

		try {
			$mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $arrEmailDetails["host"];
            $mail->SMTPAuth = true;
            $mail->Username = $arrEmailDetails["username"];
            $mail->Password = $arrEmailDetails["password"];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
        
            //Recipients
            $mail->setFrom($arrEmailDetails["from"]["address"], $arrEmailDetails["from"]["name"]);
            $mail->addAddress($arrEmailDetails[$sDepartment]["email"], $arrEmailDetails[$sDepartment]["name"]);
        
            //Content
            $mail->isHTML(true);
            $mail->Subject = $sSubject;
            $mail->Body = $sBody;
        
            $mail->send();
        } catch (phpmailerException $e) {
            echo "An error occurred: " . $e->errorMessage();;
        }
    }

	public function sendNonDepartmentEmail( $sSubject, $sBody, $sRecipient ) {
		//Get the email details from the config
		$objApplication = new Application();
		$arrEmailDetails = $objApplication->getEmailConf();

		try {
			$mail = new PHPMailer(true);
			//Server settings
			$mail->SMTPDebug = 0;
			$mail->isSMTP();
			$mail->Host = $arrEmailDetails["host"];
			$mail->SMTPAuth = true;
			$mail->Username = $arrEmailDetails["username"];
			$mail->Password = $arrEmailDetails["password"];
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			//Recipients
			$mail->setFrom($arrEmailDetails["from"]["address"], $arrEmailDetails["from"]["name"]);
			$mail->addAddress($sRecipient, $sRecipient);

			//Content
			$mail->isHTML(true);
			$mail->Subject = $sSubject;
			$mail->Body = $sBody;

			$mail->send();
		} catch (phpmailerException $e) {
			echo "An error occurred: " . $e->errorMessage();;
		}
	}
}
?>