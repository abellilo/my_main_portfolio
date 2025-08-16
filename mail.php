<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try 
{
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.abelayinde.com.ng';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@abelayinde.com.ng';    //SMTP username
    $mail->Password   = '7n6I[&Aa4=K{TOAK';                         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@abelayinde.com.ng', 'Abel Ayinde');
    $mail->addAddress('abel.ayinde@gmail.com', 'Valuable Customer');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Compliant From Customer';
    $mail->Body    = '<p>Hi Valuable Customer</p>
    <p><strong>Subject: </strong>
    <br>Here are the details:</p>
    <p><strong>Message: </strong></p>
    <p>Date & Time: .</p>
    <p>Abel Ayinde Support Team</p>
    <p>Thank you.</p>
    <p>Best Regards</p>
    <br>
    <center><small>Copyright &copy; 2025, Abel Ayinde. All rights reserved.</small></center>
    <center><small>You are receiving this email because it has to be treated by a you</small></center>';

    $mail->AltBody = 'User User-Not-registered just visited the site.';

    $mail->send();

}
catch (Exception $e) 
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>