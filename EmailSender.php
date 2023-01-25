<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'path/to/vendor/autoload.php';

class EmailSender {

    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);

        // Server settings
        $this->mailer->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $this->mailer->isSMTP();                                            // Send using SMTP
        $this->mailer->Host       = 'smtp.example.com';                    // Set the SMTP server to send through
        $this->mailer->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mailer->Username   = 'username';                     // SMTP username
        $this->mailer->Password   = 'password';                               // SMTP password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $this->mailer->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $this->mailer->setFrom('sender@example.com', 'Sender Name');
        $this->mailer->addAddress('receiver@example.com', 'Receiver Name');     // Add a recipient
    }

    public function addCC(string $cc, string $name = ""): void
    {
        $this->mailer->addCC($cc, $name);
    }

    public function addBCC(string $bcc, string $name = ""): void
    {
        $this->mailer->addBCC($bcc, $name);
    }

    public function setSubject(string $subject): void
    {
        $this->mailer->Subject = $subject;
    }

    public function setMessage(string $message): void
    {
        $this->mailer->Body = $message;
    }

    public function send(): bool
    {
        return $this->mailer->send();
    }
}
