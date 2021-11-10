<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../../common/Common.php';

class Mail
{
    static function send($toMail, $toMailName, $ccMail, $subjectMail, $bodyMail)
    {
        // passing true in constructor enables exceptions in PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = Common::$_MAIL_SERVER_ADDRESS;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;
            $mail->Username = Common::$_MAIL_SERVER_USER; //  email
            $mail->Password = Common::$_MAIL_SERVER_PASS; // password

            // Sender and recipient settings
            $mail->setFrom(Common::$_MAIL_SERVER_USER, Common::$_MAIL_SERVER_EMAIL_DISPLAY);
            $mail->addAddress($toMail, $toMailName);
            if (!empty($ccMail)) {
                $mail->addCC($ccMail);
                $mail->addCC($toMail);
            }
            // $mail->addReplyTo('hien2010@gmail.com', 'Sender Name'); // to set the reply to
            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = $subjectMail;
            $mail->Body = $bodyMail;
            // $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
            $mail->send();
            return 0;
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            return 1;
        }
    }
}
?>
