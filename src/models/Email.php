<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use Zend\Log\Logger;

	class Email
	{
		public function sendEmail($sSubject, $sBody, $sRecipient)
		{
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
			} catch (Exception $e) {
				$objLog = new Log();
				$logger = $objLog->getErrorLog();

				$logger->log(Logger::ERR, 'An error occurred with sending the email: ' . $e->errorMessage());

				header("Location:views/error.html");
				die();
			}
		}
	}

?>