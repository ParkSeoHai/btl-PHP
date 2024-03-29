<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

function sendMail($email, $subject, $message) : bool {
    try {
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        // Hidden email and password

        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);

        $mail->setFrom('anhhai282003@gmail.com', 'Park Seo Hai');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();

        return true;
    } catch (Exception $e) {
        return false;
    }
}