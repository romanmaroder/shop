<?php


namespace frontend\services\auth;


use common\repositories\UserRepository;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private MailerInterface $mailer;
    private UserRepository $users;


    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->users  = $users;
        $this->mailer = $mailer;
    }

    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->findByEmail($form->email);

        if (!$user->isActive()) {
            throw new \DomainException('User is not active.');
        }

        $user->requestPasswordReset();
        $this->users->save($user);

        $sent = $this
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            //->setFrom($this->supportEmail) The setting is in the file common\main-local.php
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }

    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users
            ->existsByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->findByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }
}