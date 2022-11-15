<?php

namespace Mail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    private string $host;
    private string $name;
    private string $username;
    private string $password;
    private string $addressee;
    private string $addressee_name;
    private string $subject;
    private string $body;
    private int $port;

    public function __construct($addressee, $addressee_name, $subject, $body)
    {
        $settings = parse_ini_file('.ini');
        $this -> host = $settings['MAIL_HOST'];
        $this -> port = $settings['MAIL_PORT'];
        $this -> username = $settings['MAIL_USERNAME'];
        $this -> password = $settings['MAIL_PASSWORD'];
        $this -> name = $settings['MAIL_FROM_NAME'];
        $this -> addressee = $addressee;
        $this -> addressee_name = $addressee_name;
        $this -> subject = $subject;
        $this -> body = $body;
    }

    public function send(): bool|string
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail -> SMTPDebug = SMTP::DEBUG_OFF;                                //Enable verbose debug output
            $mail -> isSMTP();                                                   //Send using SMTP
            $mail -> Host = $this -> host;                                       //Set the SMTP server to send through
            $mail -> SMTPAuth = true;                                            //Enable SMTP authentication
            $mail -> Username = $this -> username;                               //SMTP username
            $mail -> Password = $this -> password;                               //SMTP password
            $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                //Enable implicit TLS encryption
            $mail -> Port = $this -> port;                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = Libraries::ENCRYPTION_STARTTLS`

            //Recipients
            $mail -> setFrom('sebas35747@gmail.com', $this -> name);      //Add a recipient
            $mail -> addAddress($this -> addressee, $this -> addressee_name);    //Name is optional

            //Content
            $mail -> isHTML();                                                   //Set email format to HTML
            $mail -> Subject = $this -> subject;
            $mail -> Body = $this -> body;

            $mail -> send();
            return true;
        } catch (Exception) {
            return $mail -> ErrorInfo;
        }
    }
}
