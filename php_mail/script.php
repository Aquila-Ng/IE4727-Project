<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Require the config.php file to use our Gmail account login details.
require 'static/php_mail/config.php';

// Require the path to the PHPMailer classes.
require 'static/php_mail/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'static/php_mail/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'static/php_mail/PHPMailer-master/PHPMailer-master/src/SMTP.php';

function sendMail($email, $subject, $message) {
    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Uncomment for debugging

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = MAILHOST;
    $mail->Username = USERNAME;
    $mail->Password = PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom(SEND_FROM, SEND_FROM_NAME);
    $mail->addAddress($email);
    $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);

    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = strip_tags($message);

    if (!$mail->send()) {
        return "Email not sent. Please try again";
    } else {
        return "success";
    }
}