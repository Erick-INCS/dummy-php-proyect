<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	
	function send_mail($to, $subject, $body){
		include('../conexion_mail.php');
		
		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';
		
		$mail = new PHPMailer(true);

		try {
			//Server settings
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->SMTPDebug = 2;
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = $mail_conf['smtp_host'];
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = $mail_conf['addr'];
			$mail->Password   = $mail_conf['pass'];
			$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			// //Recipients
			$mail->setFrom($mail_conf['addr'], $mail_conf['app_name']);
			// $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
			if (isset($mail_conf['forced_recp'])) {
				$mail->addAddress($mail_conf['forced_recp']);
			} else {
				$mail->addAddress($to);
			}
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			// //Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			// //Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $body;
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
?>
