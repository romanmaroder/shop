<?php


namespace frontend\services\contact;


use frontend\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    private $mailer;

    /**
     * ContactService constructor.
     * @param $adminEmail
     * @param MailerInterface $mailer
     */
    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer     = $mailer;
    }

    public function send(ContactForm $form)
    {
        $sent = $this->mailer->compose()
            //->setFrom($this->supportEmail) The setting is in the file common\main-local.php
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error');
        }
    }


}