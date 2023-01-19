<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';



if ($_POST) {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        // $mail->SMTPDebug  = 2;
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'anjime2006@gmail.com';
        $mail->Password   = 'ckwdlryzckzgznvb';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('noreply@myportfolio.com', 'My Portfolio');
        $mail->addAddress("m.daffa342@gmail.com",$email, $name);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message Found | My Portfolio';
        ob_start();
        include('email_template.php');
        $mail->Body    = ob_get_contents();
        ob_end_clean();

        $mail->send();

        header("Location: index.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
