<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

date_default_timezone_set('Africa/Lagos');    

// ----- date converter function
function formatDateWithSuffix($dateString) 
{
    $date = new DateTime($dateString);
    $day = (int)$date->format('j');

    // Get ordinal suffix
    if ($day % 10 == 1 && $day != 11) {
        $suffix = 'st';
    } elseif ($day % 10 == 2 && $day != 12) {
        $suffix = 'nd';
    } elseif ($day % 10 == 3 && $day != 13) {
        $suffix = 'rd';
    } else {
        $suffix = 'th';
    }

    // Format date with suffix
    return $day . $suffix . ' ' . $date->format('F, Y');
}

$time_of_reg = date('H:i:s');
$date_of_reg = date('Y-m-d');
$formated_date = formatDateWithSuffix($date_of_reg);
$formattedTime = date("h:i A", strtotime($time_of_reg));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $full_name  = htmlspecialchars($_POST['full_name']);
        $email_address = htmlspecialchars($_POST['email_address']);
        $mobile_number = htmlspecialchars($_POST['mobile_number']);
        $email_subject = htmlspecialchars($_POST['email_subject']);
        $message = htmlspecialchars($_POST['message']);

        try 
        {
            //Server settings
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
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
            $mail->Body    = '<p>Hi Staff</p>
            <p><strong>Subject: </strong> '.$email_subject.'
            <br>Here are the details:</p>
            <p><strong>Full Name: </strong> '.$full_name.'</p>
            <p><strong>Customer Email Address: </strong> '.$email_address.'</p>
            <p><strong>Customer Phone Number: </strong> '.$mobile_number.'</p>
            <p><strong>Message: </strong> '.$message.'</p>
            <p><strong>Date & Time: </strong> '.$formated_date.' & '.$formattedTime.'.</p>
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

        echo "✅ $full_name Thank you! Your message has been successfully sent. 📩 We’ll get back to you shortly.";
    }
?>