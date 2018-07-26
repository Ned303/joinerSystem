<?php
	require 'models/Email.php';

    $objEmail = new Email();
    $objEmail->sendEmail('This is a test email',
		'The body of your test email',
		'devs');
?>