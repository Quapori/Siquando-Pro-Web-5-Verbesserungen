<?php

class NGMail
{

    /**
     *
     * Name of sender
     * @var string
     */
    public $fromName = '';

    /**
     *
     * E-Mail-Address of sender
     * @var string
     */
    public $fromMail = '';

    /**
     *
     * E-Mail-Adress to reply to
     * @var string
     */
    public $replyTo = '';

    /**
     *
     * Adress to send to
     * @var string
     */
    public $sendTo = '';

    /**
     *
     * Message body
     * @var string
     */
    public $html = '';

    /**
     *
     * Message subject
     * @var string
     */
    public $subject = '';

    /**
     * @var PHPMailer
     */
    private $mail;

    /**
     *
     * Attach a file
     * @param string $filename
     * @param string $type
     */
    public function addAttachment($filename, $alternativeFilename = '', $type = 'application/octet-stream')
    {
        $this->mail->addAttachment($filename, $alternativeFilename, \PHPMailer\PHPMailer\PHPMailer::ENCODING_BASE64, $type);
    }

    /**
     *
     * Attach a file
     * @param string $filename
     * @param string $type
     */
    public function addAttachmentContent($content, $filename, $type = 'application/octet-stream')
    {
        $this->mail->addStringAttachment($content, $filename, \PHPMailer\PHPMailer\PHPMailer::ENCODING_BASE64, $type);
    }

    /**
     *
     * Send the mail
     */
    public function send()
    {

        try {
            if ($this->fromMail!=='') $this->mail->setFrom($this->fromMail, $this->fromName);

            $this->mail->clearAddresses();
            $this->mail->addAddress($this->sendTo);

            if ($this->replyTo === '') {
                if ($this->fromMail!=='') $this->mail->addReplyTo($this->fromMail);
            } else {
                $this->mail->addReplyTo($this->replyTo);
            }

            $this->mail->Subject = $this->subject;

            $this->mail->Body = $this->html;
            $this->mail->AltBody = strip_tags($this->html);

            $this->mail->send();
        }
        catch (Exception $ex)
        {
            if (NGConfig::DebugMode) {
                throw $ex;
            }
        }
    }

    function __construct()
    {
        include_once realpath(dirname(__FILE__) . '/../phpmailer/phpmailer.php');
        include_once realpath(dirname(__FILE__) . '/../phpmailer/smtp.php');
        include_once realpath(dirname(__FILE__) . '/../phpmailer/exception.php');

        $this->mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        $this->mail->CharSet = \PHPMailer\PHPMailer\PHPMailer::CHARSET_UTF8;

        if (NGConfig::MailUseSMTP) {
            $this->mail->isSMTP();
            $this->mail->Host = NGConfig::MailSMTPHost;
            $this->mail->Port = NGConfig::MailSMTPPort;


            if (NGConfig::MailSMTPAuth) {
                $this->mail->SMTPAuth = true;
                $this->mail->Username = NGConfig::MailSMTPUserName;
                $this->mail->Password = NGConfig::MailSMTPPassword;

                if (NGConfig::MailSMTPSecure === 'SSL') $this->mail->SMTPSecure = 'ssl';
                if (NGConfig::MailSMTPSecure === 'TLS') $this->mail->SMTPSecure = 'tls';
            }
        }
    }
}