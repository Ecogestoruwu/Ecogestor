<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jodonghee123@gmail.com';
    $mail->Password = 'ifao pzmp fcup smla';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('jodonghee123@gmail.com', 'Your Name');
    $mail->addAddress('djo@udistrital.edu.co', 'Recipient Name');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body    = 'This is a test email sent using <b>PHPMailer</b>.';
    $mail->AltBody = 'This is the plain text version of the email content.';

    $mail->send();
    echo 'Email has been sent successfully';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>