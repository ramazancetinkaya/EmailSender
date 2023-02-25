<?php

/**
 * This class represents an Email Sender that can send emails using the SMTP protocol.
 * It uses PHPMailer library for sending emails and supports both plaintext and HTML email messages.
 */
class EmailSender {
    
    /**
     * The email address of the sender.
     * @var string
     */
    private string $from;
    
    /**
     * The email address(es) of the recipient(s). Can be a single email address or multiple email addresses separated by commas.
     * @var string
     */
    private string $to;
    
    /**
     * The subject of the email.
     * @var string
     */
    private string $subject;
    
    /**
     * The message body of the email.
     * @var string
     */
    private string $message;
    
    /**
     * The SMTP server hostname or IP address.
     * @var string
     */
    private string $smtpHost;
    
    /**
     * The SMTP server port number.
     * @var int
     */
    private int $smtpPort;
    
    /**
     * The username for SMTP authentication.
     * @var string
     */
    private string $smtpUsername;
    
    /**
     * The password for SMTP authentication.
     * @var string
     */
    private string $smtpPassword;
    
    /**
     * The constructor for the EmailSender class.
     * @param string $from The email address of the sender.
     * @param string $to The email address(es) of the recipient(s).
     * @param string $subject The subject of the email.
     * @param string $message The message body of the email.
     * @param string $smtpHost The SMTP server hostname or IP address.
     * @param int $smtpPort The SMTP server port number.
     * @param string $smtpUsername The username for SMTP authentication.
     * @param string $smtpPassword The password for SMTP authentication.
     */
    public function __construct(string $from, string $to, string $subject, string $message, string $smtpHost, int $smtpPort, string $smtpUsername = '', string $smtpPassword = '') {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->smtpHost = $smtpHost;
        $this->smtpPort = $smtpPort;
        $this->smtpUsername = $smtpUsername;
        $this->smtpPassword = $smtpPassword;
    }
    
    /**
     * Sends the email using the PHPMailer library and the SMTP protocol.
     * @return bool Returns true if the email was sent successfully, false otherwise.
     * @throws Exception Throws an exception if there was an error sending the email.
     */
    public function send() : bool {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                                       //  Enable verbose debug output
            $mail->isSMTP();                                                            //  Send using SMTP
            $mail->Host       = $this->smtpHost;                                        //  Set the SMTP server to send through
            $mail->SMTPAuth   = !empty($this->smtpUsername);                            //  Enable SMTP authentication
            $mail->Username   = $this->smtpUsername;                                    //  SMTP username
            $mail->Password   = $this->smtpPassword;                                    //  SMTP password
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;     //  Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = $this->smtpPort;                                        //  TCP port to connect to

            //Recipients
            $mail->setFrom($this->from);
            $toAddresses = explode(',', $this->to);
            foreach ($toAddresses as $toAddress) {
                $mail->addAddress(trim($toAddress)); // Name is optional
            }
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->message;
            $mail->AltBody = strip_tags($this->message);

            $mail->send();
            return true;
        } catch (Exception $e) {
            throw new Exception('Error sending email: ' . $mail->ErrorInfo);
        }
    }
}
