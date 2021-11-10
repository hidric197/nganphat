<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../../common/Common.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

// try {
//     // Server settings
//     $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';
//     $mail->SMTPAuth = true;
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//     $mail->Port = 587;

//     $mail->Username = 'example@gmail.com'; // YOUR gmail email
//     $mail->Password = 'YOUR_GMAIL_PASSWORD'; // YOUR gmail password

//     // Sender and recipient settings
//     $mail->setFrom('example@gmail.com', 'Sender Name');
//     $mail->addAddress('phppot@example.com', 'Receiver Name');
//     $mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

//     // Setting the email content
//     $mail->IsHTML(true);
//     $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
//     $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
//     $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

//     $mail->send();
//     echo "Email message sent.";
// } catch (Exception $e) {
//     echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
// }

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'hien.works';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 2525;
    
    $mail->Username = 'mail@hien.works'; // YOUR gmail email
    $mail->Password = 'Khang@0604'; // YOUR gmail password
    
    // Sender and recipient settings
//     $mail->setFrom('nganphat.ltd@gmail.com', 'NGÂN PHÁT');
    $mail->setFrom('mail@hien.works', 'NGÂN PHÁT');
    $mail->addAddress('hien2010@gmail.com', 'Tên Khách Hàng');
    $mail->addCC('dinhthehien1983@gmail.com');
//     $mail->addReplyTo('hien2010@gmail.com', 'Sender Name'); // to set the reply to
    
    
    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Send email using Gmail SMTP and OK";
    $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
    
    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}

?>
